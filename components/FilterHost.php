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
use app\components\FilterCater;

class FilterHost extends FilterCater
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
        parent::__construct($price, $active, $config);
    }
    public function getPartnerId()
    {
        if (!empty($this->array_partner_filtered_by_address1)) {
            $this->result = $this->array_partner_filtered_by_address1;
            //$result = array_intersect($array_partner, $array_partner_filtered_by_address1);
        }
        // My filter Attributes
        $request = Yii::$app->request;
        $host_number = array();
        $spoken_languages = array();
        $Pricebyhour = array();
        $hour = array();
        $Distance = array();
        if (!empty($request->get('Distance'))) {

            $array = $request->get('Distance');
            $Distance = explode(",", $array);
        }
        if (!empty($request->get('host_number'))) {
            $array = $request->get('host_number');
            $host_number = explode(",", $array);
        }
        if (!empty($request->get('spoken_languages'))) {
            $array = $request->get('spoken_languages');
            $spoken_languages = explode(",", $array);
        }
        if (!empty($request->get('price_hour'))) {
            $array = $request->get('price_hour');
            $Pricebyhour = explode(",", $array);
        }
        if (!empty($request->get('hour'))) {
            $array = $request->get('hour');
            $hour = explode(",", $array);
        }
        /*gettinng the appropriate products that verify the followin conditions:
    must have an array of the partner within the aproved time and address and belong to the
    apropriate partner_category*/
        $product_parent = ProductParent::find()
            ->andwhere(['partner_id' => $this->result])
            ->andwhere(['partner_category' => 7])
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
                    ->andFilterWhere(['partner_category' => 7])
                    ->andWhere(['product_id' => $product_parent_id])
                    ->all();
            }
        }
        //All possible combinaison
        $query1 = $query;
        //P 1
        if (!empty($host_number)) {
            $query = ProductItem::find()
                ->andFilterWhere(['partner_category' => 7])
                ->andFilterWhere(['quantity' => $host_number])
                ->andWhere(['product_id' => $product_parent_id])
                ->all();
        }
        //P 2
        if (!empty($Pricebyhour)) {
            //transforming price into two array
            $price_beging = array();
            $price_ending = array();
            foreach ($Pricebyhour as $p) {
                $piece = explode("to", $p);
                $price_beging[] = $piece[0];
                $price_ending[] = $piece[1];
                $length = count($price_ending);
            }
            $query = array();
            foreach ($query1 as $q) {
                for ($i = 0; $i < $length; $i++) {
                    foreach ($this->array_partner_filtered_by_address2 as $element) {
                        if (in_array($q->product_id, $element['product_id'])) {
                            $price = $q->price;
                            if ($price >= $price_beging[$i] && $price <= $price_ending[$i]) {
                                $query[] = $q;
                            }
                        }
                    }
                }
            }

            if (!empty($Pricebyhour) && !empty($host_number)) {
                $beging = array();
                $ending = array();
                foreach ($hour as $p) {
                    $piece = explode("to", $p);
                    $beging[] = $piece[0];
                    $ending[] = $piece[1];
                    $length = count($ending);
                }
                $query2 = array();
                foreach ($query1 as $q) {
                    for ($i = 0; $i < $length; $i++) {
                        foreach ($this->array_partner_filtered_by_address2 as $element) {
                            if (in_array($q->product_id, $element['product_id'])) {
                                $price = $q->price;
                                if (array_key_exists($i, $price_beging))
                                    if ($price >= $price_beging[$i] && $price <= $price_ending[$i]) {
                                        $query2[] = $q;
                                    }
                            }
                        }
                    }
                }
                //Our Filtering  Hour
                $query = array();
                foreach ($query2 as $q) {
                    for ($i = 0; $i < $length; $i++) {
                        if ($q->periode >= $beging[$i] && $q->periode <= $ending[$i]) {

                            $query[] = $q;
                        }
                    }
                }
            }
        }
        //P 3
        if (!empty($hour)) {
            //transforming price into two array
            $price_beging = array();
            $price_ending = array();
            foreach ($hour as $p) {
                $piece = explode("to", $p);
                $beging[] = $piece[0];
                $ending[] = $piece[1];
                $length = count($ending);
            }

            $query1 = ProductItem::find()
                ->andFilterWhere(['partner_category' => 7])
                ->andWhere(['product_id' => $product_parent_id])
                //   ->andWhere(['>=', 'periode', 1])
                //    ->andWhere(['<=', 'periode', 3])
                //->andFilterWhere(['between', 'periode', $beging[0], $ending[$length - 1]])
                ->all();
            $query = array();
            foreach ($query1 as $q) {
                for ($i = 0; $i < $length; $i++) {
                    if ($q->periode >= $beging[$i] && $q->periode <= $ending[$i]) {
                        $query[] = $q;
                    }
                }
            }
        }
        // P 1-2
        if (!empty($host_number) && !empty($Pricebyhour)) {
            //split Price into a range of price for doing our research
            $price_beging = array();
            $price_ending = array();
            foreach ($Pricebyhour as $p) {
                $piece = explode("to", $p);

                $price_beging[] = $piece[0];
                $price_ending[] = $piece[1];
                $length = count($price_ending);
            }
            // Execution of the querry
            $query = ProductItem::find()
                ->andFilterWhere(['partner_category' => 7])
                ->andWhere(['product_id' => $product_parent_id])
                ->andFilterWhere(['quantity' => $host_number])
                ->all();
            $query = ProductItem::find()
                ->andFilterWhere(['partner_category' => 7])
                ->andWhere(['product_id' => $product_parent_id])

                //  ->andFilterWhere(['between', 'price', $price_beging[0], $price_ending[$length - 1]])
                ->all();
            $query2 = $query;
            foreach ($query2 as $q) {
                for ($i = 0; $i < $length; $i++) {
                    foreach ($this->array_partner_filtered_by_address2 as $element) {
                        if (in_array($q->product_id, $element['product_id'])) {
                            $price = $q->price;
                            if (array_key_exists($i, $price_beging))
                                if ($price >= $price_beging[$i] && $price <= $price_ending[$i]) {
                                    $query[] = $q;
                                }
                        }
                    }
                }
            }
        }
        // P 1-3
        if (!empty($host_number) && !empty($hour)) {
            //split hour into a range of price for doing our research
            $price_beging = array();
            $price_ending = array();
            foreach ($hour as $p) {
                $piece = explode("to", $p);
                $price_beging[] = $piece[0];
                $price_ending[] = $piece[1];
                $length = count($price_ending);
            }
            // Execution of the querry
            $query = ProductItem::find()
                ->andFilterWhere(['partner_category' => 7])
                ->andFilterWhere(['quantity' => $host_number])
                ->andWhere(['product_id' => $product_parent_id])
                // ->andFilterWhere(['between', 'periode', $price_beging[0], $price_ending[$length - 1]])
                ->all();
            $query2 = $query;
            foreach ($query2 as $q) {
                for ($i = 0; $i < $length; $i++) {
                    if ($q->periode >= $beging[$i] && $q->periode <= $ending[$i]) {
                        $query[] = $q;
                    }
                }
            }
        }
        // P 1-2-3
        if (!empty($host_number) && !empty($hour) && !empty($Pricebyhour)) {
            //split hour into a range of price for doing our research
            $price_beging = array();
            $price_ending = array();
            foreach ($Pricebyhour as $p) {
                $piece = explode("to", $p);
                $price_beging[] = $piece[0];
                $price_ending[] = $piece[1];
                $length = count($price_ending);
            }
            //split hour into a range of price for doing our research
            $beging = array();
            $ending = array();
            foreach ($hour as $p) {
                $piece = explode("to", $p);
                $beging[] = $piece[0];
                $ending[] = $piece[1];
                $length = count($ending);
            }

            // Execution of the querry
            $query = ProductItem::find()
                ->andFilterWhere(['partner_category' => 7])
                ->andFilterWhere(['quantity' => $host_number])
                ->andWhere(['product_id' => $product_parent_id])
                ->andFilterWhere(['between', 'price', $price_beging[0], $price_ending[$length - 1]])
                ->andFilterWhere(['between', 'periode', $beging[0], $ending[$length - 1]])
                ->all();
        }
        //P 4 and combinaison with the rest 
        $query1 = array();
        foreach ($query as $q) {
            if (!empty($spoken_languages)) {
                foreach ($spoken_languages as $a) {
                    if (is_array(json_decode($q->languages, true))) {
                        $array = json_decode($q->languages, true);
                        if (array_key_exists($a, $array))
                            if ($array[$a] == $a) {
                                if (!in_array($q, $query1))
                                    $query1[] = $q;
                            }
                    }
                }
            }
        }
        $counter = 0;
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

                    if ($q->distance >= $distance_beging[$counter] && $q->distance < $distance_ending[$counter]) {
                        $query1[] = $q;
                    }
                }
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
