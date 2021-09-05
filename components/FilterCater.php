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
use app\components\Distance;

class FilterCater extends Component
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
    public function __construct($price, $active, $config = [])
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
        if (!empty($this->request->get('filter'))) {
            $this->filteraf = $this->request->get('filter');
        }
        $this->array_partner_filtered_by_address1 = array();
        parent::__construct($config);
    }

    //This is the methode that will be fire
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

        //Getting the distance for the Cater


        $this->array_partner_filtered_by_address1 = array();
        $array_partner_filtered_by_address = $distance->getDistance2($addressFrom, $addressTo, "K");
        $this->array_partner_filtered_by_address2 = $array_partner_filtered_by_address;
        foreach ($array_partner_filtered_by_address  as $array_partner_filtered_by_address) {
            $this->array_partner_filtered_by_address1[] = $array_partner_filtered_by_address['partner_id'];
            // $array_partner_filtered_by_address = $array_partner_filtered_by_address['partner_id'];
        }
        //partie de correction pour la date
        $this->array_partner = array();
        $this->array_partner = $this->correction_date($this->model);
        //partie pour construction du tableau de partner_id
        $query = $this->getPartnerId();
        $query = $this->SortProducts($query);
        $value = $this->sendingDataToSiteController($query);
        return ($value);
    }
    //This methode is used for getting the date and cleansing it 
    public function correction_date($model)
    {
        $date = array();
        $date = explode(" - ", $model->date_depart);
        $date_depart = $date[0];
        $date_arriver = $date[1];
        //changer time for depart
        $date_depart[11] = 0;
        $date_depart[12] = 0;
        $date_depart[16] = ":";
        $date_depart[17] = 0;
        $date_depart[18] = 0;
        ///changin the time of the arriver date
        $date_arriver[11] = 0;
        $date_arriver[12] = 0;
        $date_arriver[16] = ":";
        $date_arriver[17] = 0;
        $date_arriver[18] = 0;
        $event_partner_date = TblEvents::find()
            ->andWhere(['between', 'start', $date_depart, $date_arriver])
            ->andWhere(['=', 'title', 'Available'])
            ->all();

        $this->array_partner = [];
        foreach ($event_partner_date as $partner) {
            $this->array_partner[] = $partner->partner_id;
        }

        return $this->array_partner;
    }
    //This methode is used for getting all the partner Id
    public function getPartnerId()
    {
        if (!empty($this->array_partner_filtered_by_address1)) {
            $this->result = $this->array_partner_filtered_by_address1;
            $this->result = array_intersect($this->array_partner, $this->array_partner_filtered_by_address1);
        }
        //les variables li nahtajhom
        $request = Yii::$app->request;
        $Kindoffood = array();
        $Meal = array();
        $Sort = array();
        $Temp = array();
        $Diet = array();
        $Distance = array();
        if (!empty($request->get('Distance'))) {

            $array = $request->get('Distance');
            $Distance = explode(",", $array);
        }
        if (!empty($request->get('Kindoffood'))) {
            $array = $request->get('Kindoffood');
            $Kindoffood = explode(",", $array);
        }
        if (!empty($request->get('Meal'))) {
            $array = $request->get('Meal');
            $Meal = explode(",", $array);
        }
        if (!empty($request->get('Sort'))) {
            $array = $request->get('Sort');
            $Sort = explode(",", $array);
        }
        if (!empty($request->get('Temp'))) {
            $array = $request->get('Temp');
            $Temp = explode(",", $array);
        }
        if (!empty($request->get('Diet'))) {
            $array = $request->get('Diet');
            $Diet = explode(",", $array);
        }
        $product_parent = ProductParent::find()
            ->andwhere(['partner_id' => $this->result])
            ->andwhere(['partner_category' => 3])
            ->all();
        $product_parent_id = array();
        foreach ($product_parent as $p) {
            $product_parent_id[] = $p->id;
        }
        //les conditions
        if ($this->price == 0 || $this->price == 1) {
            $query = [];
            if ($this->price == 0 || $this->price == 1) {
                $query = ProductItem::find()
                    ->andFilterWhere(['partner_category' => 3])
                    ->andWhere(['product_id' => $product_parent_id])
                    ->all();
            }
        }
        // P 1
        if (!empty($Kindoffood)) {

            $product_parent = ProductParent::find()
                ->where(['kind_of_food' => $Kindoffood])
                ->andWhere(['partner_category' => 3])
                ->all();
            $product_parent_id = array();
            foreach ($product_parent as $p) {

                $product_parent_id[] = $p->id;
            }

            $query = ProductItem::find()
                ->Where(['partner_category' => 3])
                ->Where(['product_id' => $product_parent_id])
                ->all();
            if (empty($product_parent)) {
                $query = array();
            }
        }

        //P 2 
        if (!empty($Sort)) {
            $query = ProductItem::find()
                ->andFilterWhere(['partner_category' => 3])
                ->andWhere(['description' => $Sort])
                ->andWhere(['product_id' => $product_parent_id])
                ->all();
        }
        //P 3
        if (!empty($Temp)) {

            $query = ProductItem::find()
                ->andFilterWhere(['partner_category' => 3])
                ->andFilterWhere(['temp' => $Temp])
                ->andWhere(['product_id' => $product_parent_id])
                ->all();
        }
        //P 4
        if (!empty($Meal)) {
            //thinking about a way to extract the other optiontable and add them to the array
            //think how can you add product id to the other section
            $Meal=json_encode($Meal,true);
            $expression1 = new \yii\db\Expression("JSON_CONTAINS(`name`,'$Meal')");
            $query = ProductItem::find()
                ->andFilterWhere(['partner_category' => 3])
                ->andWhere(['product_id' => $product_parent_id])
                ->andWhere($expression1)
                ->all();
        }
        //P 1-2
        if (!empty($Meal) && !empty($Sort)) {
            //thinking about a way to extract the other optiontable and add them to the array
            //think how can you add product id to the other section
            //query
            $Meal=json_encode($Meal,true);
            $expression1 = new \yii\db\Expression("JSON_CONTAINS(`name`,'$Meal')");
            $query = ProductItem::find()
                ->andFilterWhere(['partner_category' => 3])
                ->andWhere(['product_id' => $product_parent_id])
                ->andWhere($expression1)
                ->andWhere(['description' => $Sort])
                ->all();
        }
        //P 1-3
        if (!empty($Meal) && !empty($Temp)) {
            //thinking about a way to extract the other optiontable and add them to the array
            //think how can you add product id to the other section
            $Meal=json_encode($Meal,true);
            $expression1 = new \yii\db\Expression("JSON_CONTAINS(`name`,'$Meal')");
            //query
            $query = ProductItem::find()
                ->andFilterWhere(['partner_category' => 3])
                ->andWhere(['product_id' => $product_parent_id])
                ->andWhere($expression1)
                ->andFilterWhere(['temp' => $Temp])
                ->all();
        }
        //P 1-4
        if (!empty($Meal) && !empty($Kindoffood)) {
            //thinking about a way to extract the other optiontable and add them to the array
            //think how can you add product id to the other section
            $Meal=json_encode($Meal,true);
            $expression1 = new \yii\db\Expression("JSON_CONTAINS(`name`,'$Meal')");
            $product_parent = ProductParent::find()->andWhere(['partner_category' => 3, 'kind_of_food' => $Kindoffood])->all();
            foreach ($product_parent as $p) {
                $product_parent_id[] = $p->id;
            }
            //query
            $query = ProductItem::find()
                ->andWhere(['partner_category' => 3])
                ->andWhere(['product_id' => $product_parent_id])
                ->andWhere($expression1)
                ->all();
        }
        //P 2-3
        if (!empty($Sort) && !empty($Temp)) {
            //thinking about a way to extract the other optiontable and add them to the array
            //think how can you add product id to the other section

            //query
            $query = ProductItem::find()
                ->andFilterWhere(['partner_category' => 3])
                ->andWhere(['product_id' => $product_parent_id])
                ->andWhere(['description' => $Sort])
                ->andFilterWhere(['temp' => $Temp])
                ->all();
        }

        //P 2-4
        if (!empty($Sort) && !empty($Kindoffood)) {
            //thinking about a way to extract the other optiontable and add them to the array
            //think how can you add product id to the other section

            $product_parent = ProductParent::find()->andWhere(['partner_category' => 3, 'kind_of_food' => $Kindoffood])->all();
            foreach ($product_parent as $p) {
                $product_parent_id[] = $p->id;
            }
            //query
            $query = ProductItem::find()
                ->andWhere(['partner_category' => 3])
                ->andWhere(['product_id' => $product_parent_id])
                ->andWhere(['description' => $Sort])
                ->all();
        }
        //P 3-4
        if (!empty($Temp) && !empty($Kindoffood)) {
            //thinking about a way to extract the other optiontable and add them to the array
            //think how can you add product id to the other section

            $product_parent = ProductParent::find()->andWhere(['partner_category' => 3, 'kind_of_food' => $Kindoffood])->all();
            foreach ($product_parent as $p) {
                $product_parent_id[] = $p->id;
            }
            //query
            $query = ProductItem::find()
                ->andWhere(['partner_category' => 3])
                ->andWhere(['product_id' => $product_parent_id])
                ->andFilterWhere(['temp' => $Temp])
                ->all();
        }

        //P 1-2-3
        if (!empty($Meal) && !empty($Sort) && !empty($Temp)) {
            //thinking about a way to extract the other optiontable and add them to the array
            //think how can you add product id to the other section
            $Meal=json_encode($Meal,true);
            $expression1 = new \yii\db\Expression("JSON_CONTAINS(`name`,'$Meal')");
            //query
            $query = ProductItem::find()
                ->andFilterWhere(['partner_category' => 3])
                ->andWhere(['product_id' => $product_parent_id])
                ->andWhere($expression1)
                ->andWhere(['description' => $Sort])
                ->andFilterWhere(['temp' => $Temp])
                ->all();
        }
        //P 1-2-4
        if (!empty($Meal) && !empty($Sort) && !empty($Kindoffood)) {
            //thinking about a way to extract the other optiontable and add them to the array
            //think how can you add product id to the other section
            $Meal=json_encode($Meal,true);
            $expression1 = new \yii\db\Expression("JSON_CONTAINS(`name`,'$Meal')");
            $product_parent = ProductParent::find()->andWhere(['partner_category' => 3, 'kind_of_food' => $Kindoffood])->all();
            foreach ($product_parent as $p) {
                $product_parent_id[] = $p->id;
            }
            //query
            $query = ProductItem::find()
                ->andWhere(['partner_category' => 3])
                ->andWhere(['product_id' => $product_parent_id])
                ->andWhere($expression1)
                ->andWhere(['description' => $Sort])
                ->all();
        }
        //P 1-3-4
        if (!empty($Meal) && !empty($Temp) && !empty($Kindoffood)) {
            //thinking about a way to extract the other optiontable and add them to the array
            //think how can you add product id to the other section
            $Meal=json_encode($Meal,true);
            $expression1 = new \yii\db\Expression("JSON_CONTAINS(`name`,'$Meal')");
            $product_parent = ProductParent::find()->andWhere(['partner_category' => 3, 'kind_of_food' => $Kindoffood])->all();
            foreach ($product_parent as $p) {
                $product_parent_id[] = $p->id;
            }
            //query
            $query = ProductItem::find()
                ->andWhere(['partner_category' => 3])
                ->andWhere(['product_id' => $product_parent_id])
                ->andWhere($expression1)
                ->andFilterWhere(['temp' => $Temp])
                ->all();
        }
        //P 2-3-4
        if (!empty($Sort) && !empty($Temp) && !empty($Kindoffood)) {
            //thinking about a way to extract the other optiontable and add them to the array
            //think how can you add product id to the other section
            $product_parent = ProductParent::find()->andWhere(['partner_category' => 3, 'kind_of_food' => $Kindoffood])->all();
            foreach ($product_parent as $p) {
                $product_parent_id[] = $p->id;
            }
            //query
 
            $query = ProductItem::find()
                ->andWhere(['partner_category' => 3])
                ->andWhere(['product_id' => $product_parent_id])
                ->andWhere(['description' => $Sort])
                ->andFilterWhere(['temp' => $Temp])
                ->all();
        }
        //P 1-2-3-4
        if (!empty($Meal) && !empty($Sort) && !empty($Temp) && !empty($Kindoffood)) {
            //thinking about a way to extract the other optiontable and add them to the array
            //think how can you add product id to the other section
            $product_parent = ProductParent::find()->andWhere(['partner_category' => 3, 'kind_of_food' => $Kindoffood])->all();
            foreach ($product_parent as $p) {
                $product_parent_id[] = $p->id;
            }
            $Meal=json_encode($Meal,true);
            $expression1 = new \yii\db\Expression("JSON_CONTAINS(`name`,'$Meal')");
           
            //query
            $query = ProductItem::find()
                ->andWhere(['partner_category' => 3])
                ->andWhere(['product_id' => $product_parent_id])
                ->andWhere($expression1)
                ->andFilterWhere(['temp' => $Temp])
                ->andWhere(['description' => $Sort])
                ->all();
        }
        //P5-with the combinaison with the other
        $query1 = array();
        $previous_id = -1;
        foreach ($query as $q) {
            if (!empty($Diet)) {
                foreach ($Diet as $a) {
                    if (is_array(json_decode($q->checkbox, true))) {
                        $array = json_decode($q->checkbox, true);

                        if (array_key_exists($a, $array))

                            if ($array[$a] == $a) {
                                if ($q->id != $previous_id) {
                                    $previous_id = $q->id;
                                    $query1[] = $q;
                                }
                            }
                    }
                }
            }
        }
        $counter = 0;
        $query = $this->compareDistanceBetweenOriginalPartnerAndTheAdressFilledByClient($query, $this->array_partner_filtered_by_address2);
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

                    if ($q->distance >= $distance_beging[$counter] && $q->distance < $distance_ending[$counter]) {
                        $query1[] = $q;
                    }
                }
        }
        if (!empty($Distance) || !empty($Diet)) {
            $query = array();
            $query = $query1;
        }

        if (empty($this->result))
            $query = array();
        return $query;
    }
    //This Methode is used for  comparing the orginal address of partner with the client and adding the price of delivery
    public function compareDistanceBetweenOriginalPartnerAndTheAdressFilledByClient($query, $array_partner_filtered_by_address2)
    {
        foreach ($query as $q) {
            foreach ($array_partner_filtered_by_address2 as $element) {
                if (in_array($q->product_id, $element['product_id'])) {
                 //   $q->price = $q->price + $element['price'];
                    $q->distance = $element['distance'];
                }
            }
        }

        return $query;
    }
    //This Methode is used for sorting the Products by their distance
    //This Methode is used for sorting the Products by their distance
    public function SortProducts($query)
    {
        for ($i = 0; $i < sizeof($query); $i++) {
            $min = $i;
            for ($j = $i + 1; $j < sizeof($query); $j++) {
                if ($query[$j]->distance < $query[$min]->distance) {

                    $min = $j;
                    $temp = $query[$i];
                    $query[$i] = $query[$min];
                    $query[$min] = $temp;
                }
            }
        }
        return $query;
    }
    public function sendingDataToSiteController($query)
    {

        if (!empty($query)) {

            $pages = new Pagination(['totalCount' => count($query)]);

            $searchModel = new ProductItemSearch();
            $dataProvider = new ArrayDataProvider([
                'allModels'  => $query,
                'pagination' => [
                    'pageSize' => 3,

                ],
            ]);
            //
            $category = (int)$this->model->category;
            //creating the return array
            $value = array();
            //assigning the return array
            array_push($value, $this->model);
            array_push($value, $this->value_category_serached);
            array_push($value, $dataProvider);
            array_push($value, $pages);
            array_push($value, $searchModel);
            array_push($value, $this->active);
            array_push($value, $category);

            return ($value);
        }
        if (empty($query)) {
            // die();
            $query = array();
            $pages = new Pagination(['totalCount' => count($query)]);
            $searchModel = new ProductItemSearch();
            $dataProvider = new ArrayDataProvider([
                'allModels'  => $query,
                'pagination' => [
                    'pageSize' => 3,
                ],
            ]);
            $category = (int)$this->model->category;
            $value = array();
            array_push($value, $this->model);
            array_push($value, $this->value_category_serached);
            array_push($value, $dataProvider);
            array_push($value, $pages);
            array_push($value, $searchModel);
            if (empty($this->active))
                array_push($value, 0);
            else
                array_push($value, $this->active);
            array_push($value, $category);


            // die();
            return ($value);
        }
        $pages = new Pagination(['totalCount' => count($query)]);

        $searchModel = new ProductItemSearch();
        $dataProvider = new ArrayDataProvider([
            'allModels'  => $query,

            'pagination' => [
                'pageSize' => 3,

            ],
        ]);

        $category = (int)$this->model->category;
        //creating the return array
        $value = array();
        //assigning the return array
        array_push($value, $this->model);
        array_push($value, $this->value_category_serached);
        array_push($value, $dataProvider);
        array_push($value, $pages);
        array_push($value, $searchModel);
        array_push($value, $this->active);
        array_push($value, $category);

        return ($value);
    }
}
