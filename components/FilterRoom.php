<?php

namespace app\components;

use Yii;
use yii\base\Component;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\partner\RegistrationForm;
use app\models\User;
use app\models\Partner;
use app\models\Product;
use app\models\ProductParent;
use app\models\ProductItem;
use app\models\ProductItemSearch;
use app\models\base\TblEvents;
use app\modules\survey\models\SurveyStat;
use app\models\PartnerCategorySurveys;
use app\models\Surveys;
use app\models\base\QuestionsList;
use app\models\base\Questions;
use app\models\base\QuestionsPartner;
use app\models\AccountNotification;
use app\models\Notificationsuser;
use yii\data\ActiveDataProvider;
use app\models\Reservation;
use app\models\Payment;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii\data\ArrayDataProvider;
use yii\web\Session;
use app\models\Other;
use yii\data\Sort;
use yii\db\Expression;
use app\components\Distance;
use app\components\Filter;

class FilterRoom extends Filter
{
    public $price;
    public $type_of_room;
    public $space_for_rent;
    public $accepts;
    public $facilities;
    public $transport;
    public $parking;
    public $active;
    public $value_category_serached;
    public $model;
    public $result;
    public $request;
    public $array_partner_filtered_by_address2;
    public $array_partner_filtered_by_address1;
    public $filteraf;
    public $array_partner;
    public function  __construct($price, $type_of_room, $space_for_rent, $accepts, $facilities, $transport, $parking, $active, $config = [])
    {
        //part setting session 
        $this->request = Yii::$app->request;
        $_SESSION['active'] = $active;
        $this->model =  new \app\models\forms\SearchForm();
        $this->model->category = $_SESSION['category'] + 1;
        $this->model->date_depart = $_SESSION['date_depart'];
        $this->model->date_arriver = $_SESSION['date_arriver'];
        $this->model->place = $_SESSION['place'];
        $this->model->nbr_persson = $_SESSION['nbr_persson'];
        $this->value_category_serached = $this->model->category;
        $this->value_category_serached = $this->value_category_serached . "";
        $this->filteraf = 1;
        $this->array_partner_filtered_by_address1 = array();
        parent::__construct($price, $type_of_room, $space_for_rent, $accepts, $facilities, $transport, $parking, $active, $config);
    }
    public function filtrer()
    {

        $array_partner_filtered_by_address = array();
        $partner_getting_address = (new \yii\db\Query())
            ->select(['id', 'address', 'city', 'country', 'latitude', 'longitude', 'DeliveryAndDeplacement'])
            ->from('partner')
            ->limit(100)
            ->all();
        $addressFrom = $partner_getting_address;
        $addressTo = $_SESSION['place'];
        //$addressTo=implode($addressTo);
        $array_partner_filtered_by_address = array();

        $distance = new Distance();
        //here i need to change my conditions

        // if (($this->filteraf == 1)) {


        $array_partner_filtered_by_address = $distance->getDistance1($addressFrom, $addressTo, "K");
        $this->array_partner_filtered_by_address2 = $array_partner_filtered_by_address;
        foreach ($array_partner_filtered_by_address  as $array_partner_filtered_by_address) {
            $this->array_partner_filtered_by_address1[] = $array_partner_filtered_by_address['partner_id'];
            // $array_partner_filtered_by_address = $array_partner_filtered_by_address['partner_id'];
        }
        //  }
        //other 
        /*else {

            $this->array_partner_filtered_by_address1 = array();
            $array_partner_filtered_by_address = $distance->getDistance2($addressFrom, $addressTo, "K");
            $this->array_partner_filtered_by_address2 = $array_partner_filtered_by_address;
            foreach ($array_partner_filtered_by_address  as $array_partner_filtered_by_address) {
                $this->array_partner_filtered_by_address1[] = $array_partner_filtered_by_address['partner_id'];
                // $array_partner_filtered_by_address = $array_partner_filtered_by_address['partner_id'];
            }
        }*/
        //partie de correction pour la date
        $this->array_partner = array();
        $this->array_partner = $this->correction_date($this->model);
        //partie pour construction du tableau de partner_id
        $query = $this->getPartnerId();
        if ($this->value_category_serached == 0)

            $query = $this->compareDistanceBetweenOriginalPartnerAndTheAdressFilledByClient($query, $this->array_partner_filtered_by_address2);

        $query = $this->SortProducts($query);
        $value = $this->sendingDataToSiteController($query);
        return ($value);
    }
    public function getPartnerId()
    {
        if (!empty($this->array_partner_filtered_by_address1)) {
            $this->result = $this->array_partner_filtered_by_address1;
            $this->result = array_intersect($this->array_partner, $this->array_partner_filtered_by_address1);
        }
        // My filter Attributes
        $request = Yii::$app->request;
        $result = array();
        $Distance = array();
        if (!empty($request->get('Distance'))) {

            $array = $request->get('Distance');
            $Distance = explode(",", $array);
        }
        if (!empty($request->get('type_of_room'))) {


            $array = $request->get('type_of_room');
            $type_of_room = explode(",", $array);
        }
        if (!empty($request->get('filter'))) {
            $filteraf = $request->get('filter');
            //echo  $filteraf;
        }
        if (!empty($request->get('space_for_rent'))) {
            $array = $request->get('space_for_rent');
            $space_for_rent = explode(",", $array);

            // print_r($space_for_rent);
        }
        if (!empty($request->get('accepts'))) {
            $array = $request->get('accepts');
            $accepts = explode(",", $array);

            // print_r($space_for_rent);
        }
        if (!empty($request->get('facilities'))) {
            $array = $request->get('facilities');
            $facilities = explode(",", $array);

            // print_r($space_for_rent);
        }
        if (!empty($request->get('parking'))) {
            $array = $request->get('parking');
            $parking = explode(",", $array);

            // print_r($space_for_rent);
        }
        if (!empty($request->get('transport'))) {
            $array = $request->get('transport');
            $transport = explode(",", $array);

            // print_r($space_for_rent);
        }
        if (!empty($request->get('price_array'))) {
            $array = $request->get('price_array');
            $price_array = explode(",", $array);
        }
        /*gettinng the appropriate products that verify the followin conditions:
    must have an array of the partner within the aproved time and address and belong to the
    apropriate partner_category*/
        $product_parent = ProductParent::find()
            ->andWhere(['partner_id' => $this->result])
            ->andWhere(['partner_category' => 1])
            ->all();
        $product_parent_id = array();
        foreach ($product_parent as $p) {
            $product_parent_id[] = $p->id;
        }

        //Condition when checkbox is off
        if ($this->price == 0 || $this->price == 1) {

            $query = [];
            if ($this->price == 0 || $this->price == 1) {
                $query = ProductItem::find()
                    ->andFilterWhere(['partner_category' => 1])
                    ->andWhere(['product_id' => $product_parent_id])
                    ->all();
            }
        }

        //All possible combinaison
        //P 1
        if (!empty($type_of_room)){
          
            $type_of_room=json_encode($type_of_room,true);
            $expression1 = new \yii\db\Expression("JSON_CONTAINS(`temp`,'$type_of_room')");
            $query = ProductItem::find()
            ->andFilterWhere(['partner_category' => 1])
            ->andWhere($expression1)
            ->all();
        }
        //P 2
        if (!empty($space_for_rent)){
            $space_for_rent=json_encode($space_for_rent,true);
            $expression2 = new \yii\db\Expression("JSON_CONTAINS(`description`,'$space_for_rent')");
            $query = ProductItem::find()
                ->andFilterWhere(['partner_category' => 1])
                ->andWhere($expression2)
                ->all();
        }
        //P 1-2
        if (!empty($space_for_rent) && !empty($type_of_room)){
            $expression1 = new \yii\db\Expression("JSON_CONTAINS(`temp`,'$type_of_room')");
            $expression2 = new \yii\db\Expression("JSON_CONTAINS(`description`,'$space_for_rent')");
            $query = ProductItem::find()
            ->andFilterWhere(['partner_category' => 1])
            ->andWhere($expression1)
            ->andWhere($expression2)
            ->all();
            
        }
          
        //assign the query on variable query1 to filter with other json value
        $query1 = $query;
        $index = 0;
        if ((!empty($accepts)) || (!empty($facilities))) {
            $query = array();
        }

        if ((!isset($transport)) || (!isset($parking))) {

            $query = array();
        }
        $previous_id1 = -1;
        $previous_id2 = -1;
        $previous_id3 = -1;
        $previous_id4 = -1;

        foreach ($query1 as $q) {

            //Accepts
            if (!empty($accepts))
                foreach ($accepts as $a) {
                    if (is_array(json_decode($q->product_type, true))) {
                        $array = json_decode($q->product_type, true);
                        if (array_key_exists($a, $array[0]))
                            if ($array[0][$a] == $a) {
                                if ($q->id != $previous_id1) {
                                    $previous_id1 = $q->id;
                                    $query[] = $q;
                                }
                            }
                    }
                }
            //facilities
            if (!empty($facilities))
                foreach ($facilities as $f) {
                    if (is_array(json_decode($q->product_type, true))) {
                        $array = json_decode($q->product_type, true);
                        // print_r(key($myObj));
                        // print_r( $array[0][key($myObj)]);


                        if ($array[0][$f] == $f) {

                            if ($q->id != $previous_id2) {
                                $previous_id2 = $q->id;
                                $query[] = $q;
                            }
                        }
                    }
                }

            //transport
            if (!empty($transport))
                if (is_array(json_decode($q->product_type, true))) {
                    $array = json_decode($q->product_type, true);

                    for ($i = 0; $i < 11; $i++)
                        if (array_key_exists($i, $array[0]))
                            if ($array[0][$i]["services_transport"]["Transportation_name"] != "") {

                                if ($q->id != $previous_id3) {
                                    $previous_id3 = $q->id;
                                    $query[] = $q;
                                }
                            }
                }
            //parking
            if (!empty($parking))
                if (is_array(json_decode($q->product_type, true))) {
                    $array = json_decode($q->product_type, true);
                    if (array_key_exists($i, $array[0])) {
                        if ($array[0][$i]["Parking_lot"]["name"] != "0") {
                            if ($q->id != $previous_id4) {
                                $previous_id4 = $q->id;
                                $query[] = $q;
                            }
                        }
                    }
                }
        }

        //filter on the other
        $counter = 0;
        $query1 = array();
        $query = $this->compareDistanceBetweenOriginalPartnerAndTheAdressFilledByClient($query, $this->array_partner_filtered_by_address2);
        //filter Distance
        if (!empty($Distance)) {
            //transforming price into two array
            $price_beging = array();
            $price_ending = array();
            foreach ($Distance as $p) {
                $piece = explode("to", $p);
                $distance_beging[] = $piece[0];
                $distance_ending[] = $piece[1];
                $length = count($price_ending);
            }

            foreach ($query as $q)
                for ($counter = 0; $counter < count($distance_beging); $counter++) {

                    if ($q->distance >= $distance_beging[$counter] && $q->distance <= $distance_ending[$counter]) {
                        $q->distance = $q->distance;
                        $query1[] = $q;
                    }
                }
        }
        if (!empty($query1)) {

            $query = $this->compareDistanceBetweenOriginalPartnerAndTheAdressFilledByClient($query1, $this->array_partner_filtered_by_address2);
        } else {

            $query = $this->compareDistanceBetweenOriginalPartnerAndTheAdressFilledByClient($query, $this->array_partner_filtered_by_address2);
        }




        if (!empty($Distance) || !empty($spoken_languages)) {

            $query = array();
            $query = $query1;
        }

        if (empty($this->result))
            $query = array();

        return $query;
    }
}
