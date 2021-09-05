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

class FilterSecurity extends FilterCater
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
        $Typeofevent = array();
        $Typeofagent = array();
        $Numberofagent = array();
        $Pricebyhour = array();
        $hour = array();
        $Distance = array();
        if (!empty($request->get('Distance'))) {

            $array = $request->get('Distance');
            $Distance = explode(",", $array);
        }
        if (!empty($request->get('Typeofevent'))) {
            $array = $request->get('Typeofevent');
            $Typeofevent = explode(",", $array);
        }
        if (!empty($request->get('Typeofagent'))) {
            $array = $request->get('Typeofagent');
            $Typeofagent = explode(",", $array);
        }
        if (!empty($request->get('Numberofagent'))) {
            $array = $request->get('Numberofagent');
            $Numberofagent = explode(",", $array);
        }
        if (!empty($request->get('hour'))) {
            $array = $request->get('hour');
            $hour = explode(",", $array);
        }

        if (!empty($request->get('Pricebyhour'))) {
            $array = $request->get('Pricebyhour');
            $Pricebyhour = explode(",", $array);
        }

        /*gettinng the appropriate products that verify the followin conditions:
    must have an array of the partner within the aproved time and address and belong to the
    apropriate partner_category*/
        $product_parent = ProductParent::find()
            ->andwhere(['partner_id' => $this->result])
            ->andwhere(['partner_category' => 6])
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
                    ->andFilterWhere(['partner_category' => 6])
                    ->andWhere(['product_id' => $product_parent_id])
                    ->all();
            }
        }
        //All possible combinaison
        $precedant = 0;
        $query1 = array();
        $query2 = new \stdClass();
        foreach ($query as $q) {
            /*
here is all the possible combinaison
            1  
            2
            3
            4
            5
            1-2
            1-3
            1-4
            1-5
            2-3
            2-4
            2-5
            3-4
            3-5
            4-5
            1-2-3
            1-2-4
            1-2-5
            1-3-4
            1-3-5
            1-4-5
            2-3-4
            2-3-5
            2-4-5
            1-2-3-4
            1-2-3-5
            1-2-4-5
            1-2-3-4-5
*/
            //1
            if (!empty($Typeofevent)) {
                $Typeofevent=json_encode($Typeofevent,true);
                $expression1 = new \yii\db\Expression("JSON_CONTAINS(`name`,'$Typeofevent')");

                $query = ProductItem::find()
                    ->andFilterWhere(['partner_category' => 6])
                    ->andWhere($expression1)
                    ->andWhere(['product_id' => $product_parent_id])
                    ->all();
            }
            //2
            if (!empty($Typeofagent)){
                $Typeofagent=json_encode($Typeofagent,true);
                $expression1 = new \yii\db\Expression("JSON_CONTAINS(`temp`,'$Typeofagent')");
                
                    $query = ProductItem::find()
                        ->andFilterWhere(['partner_category' => 6])
                        ->andWhere($expression1)
                        ->andWhere(['product_id' => $product_parent_id])
                        ->all();
            }
            //3      
            if (!empty($Numberofagent)) {
                $query = ProductItem::find()
                    ->andFilterWhere(['partner_category' => 6])
                    ->andWhere(['number_of_agent' => $Numberofagent])
                    ->andWhere(['product_id' => $product_parent_id])
                    ->all();
            }
            //4
            if (!empty($Pricebyhour)) {
                $query1 = ProductItem::find()
                    //  ->where(['and', "price>=$price_beging[0]", "price>=$price_ending[$ending]"])
                    ->andWhere(['partner_category' => 6])
                    ->andWhere(['product_id' => $product_parent_id])
                    ->all();
                //transforming price into two array
                $price_beging = array();
                $price_ending = array();
                foreach ($Pricebyhour as $p) {
                    $piece = explode("to", $p);
                    $price_beging[] = $piece[0];
                    $price_ending[] = $piece[1];
                    $length = count($price_ending);
                }
                //Our Filtering by Price Hour
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
            }
            //5
            if (!empty($hour)) {
                $beging = array();
                $ending = array();
                $query1 = ProductItem::find()
                    //  ->where(['and', "price>=$price_beging[0]", "price>=$price_ending[$ending]"])
                    ->andWhere(['partner_category' => 6])
                    ->andWhere(['product_id' => $product_parent_id])
                    ->all();
                foreach ($hour as $p) {
                    $piece = explode("to", $p);
                    $beging[] = $piece[0];
                    $ending[] = $piece[1];
                    $length = count($ending);
                }
                //Our Filtering  Hour
                $query = array();
                foreach ($query1 as $q) {
                    for ($i = 0; $i < $length; $i++) {
                        if ($q->periode >= $beging[$i] && $q->periode <= $ending[$i]) {

                            $query[] = $q;
                        }
                    }
                }
            }
            //adding cases 2 case
            //1-2
            if (!empty($Typeofevent) && !empty($Typeofagent)) {
                
                $Typeofevent=json_encode($Typeofevent,true);
                $expression1 = new \yii\db\Expression("JSON_CONTAINS(`name`,'$Typeofevent')");
                $Typeofagent=json_encode($Typeofevent,true);
                $expression2 = new \yii\db\Expression("JSON_CONTAINS(`temp`,'$Typeofagent')");
          
                $query = ProductItem::find()
                    ->andFilterWhere(['partner_category' => 6])
                    ->andWhere($expression1 and $expression2 )
                    ->andWhere(['product_id' => $product_parent_id])
                    ->all();
            }
            //1-3
            if (!empty($Typeofevent) && !empty($Numberofagent)) {
                $Typeofevent=json_encode($Typeofevent,true);
                $expression1 = new \yii\db\Expression("JSON_CONTAINS(`name`,'$Typeofevent')");
               
                $query = ProductItem::find()
                    ->andFilterWhere(['partner_category' => 6])
                    ->andWhere($expression1)
                    ->andWhere(['number_of_agent' => $Numberofagent])
                    ->andWhere(['product_id' => $product_parent_id])
                    ->all();
            }
            //1-4
            if (!empty($Typeofevent) && !empty($Pricebyhour)) {
                //Intiliazing price 
                $price_beging = array();
                $price_ending = array();
                foreach ($Pricebyhour as $p) {
                    $piece = explode("to", $p);
                    $price_beging[] = $piece[0];
                    $price_ending[] = $piece[1];
                    $length = count($price_ending);
                }
                ////////////////////////////////
                $Typeofevent=json_encode($Typeofevent,true);
                $expression1 = new \yii\db\Expression("JSON_CONTAINS(`name`,'$Typeofevent')");
               
                $query = ProductItem::find()
                    ->andFilterWhere(['partner_category' => 6])
                    ->andWhere($expression1)
                    ->andWhere(['product_id' => $product_parent_id])
                    //  ->andFilterWhere(['between', 'price', $price_beging[0], $price_ending[$length - 1]])
                    ->all();
                //Price filter
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
            }
            //1-5
            if (!empty($Typeofevent) && !empty($hour)) {
                //Intiliazing price 
                $beging = array();
                $ending = array();
                foreach ($hour as $p) {
                    $piece = explode("to", $p);
                    $beging[] = $piece[0];
                    $ending[] = $piece[1];
                    $length = count($ending);
                }
                ////////////////////////////////
                $Typeofevent=json_encode($Typeofevent,true);
                $expression1 = new \yii\db\Expression("JSON_CONTAINS(`name`,'$Typeofevent')");
                
                $query1 = ProductItem::find()
                    ->andFilterWhere(['partner_category' => 6])
                    ->andWhere($expression1)
                    ->andWhere(['product_id' => $product_parent_id])
                    // ->andFilterWhere(['between', 'periode', $beging[0], $ending[$length - 1]])
                    ->all();
                //Our Filtering  Hour
                $query = array();
                foreach ($query1 as $q) {
                    for ($i = 0; $i < $length; $i++) {
                        if ($q->periode >= $price_beging[$i] && $q->periode <= $price_ending[$i]) {

                            $query[] = $q;
                        }
                    }
                }
            }
            //2-3
            if (!empty($Numberofagent) && !empty($Typeofagent)) {
                $Typeofagent=json_encode($Typeofagent,true);
                $expression1 = new \yii\db\Expression("JSON_CONTAINS(`temp`,'$Typeofagent')");
               
                $query = ProductItem::find()
                    ->andFilterWhere(['partner_category' => 6])
                    ->andWhere($expression1)
                    ->andWhere(['number_of_agent' => $Numberofagent])
                    ->andWhere(['product_id' => $product_parent_id])
                    ->all();
            }
            //2-4
            if (!empty($Pricebyhour) && !empty($Typeofagent)) {
                $Typeofagent=json_encode($Typeofagent,true);
                $expression1 = new \yii\db\Expression("JSON_CONTAINS(`temp`,'$Typeofagent')");
                
                $price_beging = array();
                $price_ending = array();
                foreach ($Pricebyhour as $p) {
                    $piece = explode("to", $p);
                    $price_beging[] = $piece[0];
                    $price_ending[] = $piece[1];
                    $length = count($price_ending);
                }
                //
                $query = ProductItem::find()
                    ->andFilterWhere(['partner_category' => 6])
                    ->andWhere($expression1)
                    ->andWhere(['product_id' => $product_parent_id])
                    //  ->andFilterWhere(['between', 'price', $price_beging[0], $price_ending[$length - 1]])
                    ->all();
                //Price filter
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
            }
            //2-5
            if (!empty($hour) && !empty($Typeofagent)) {
                $beging = array();
                $ending = array();
                foreach ($hour as $p) {
                    $piece = explode("to", $p);
                    $beging[] = $piece[0];
                    $ending[] = $piece[1];
                    $length = count($ending);
                }
                //
                $Typeofagent=json_encode($Typeofagent,true);
                $expression1 = new \yii\db\Expression("JSON_CONTAINS(`temp`,'$Typeofagent')");
                $query1 = ProductItem::find()
                    ->andFilterWhere(['partner_category' => 6])
                    ->andWhere($expression1)
                    ->andWhere(['product_id' => $product_parent_id])
                    // ->andFilterWhere(['between', 'periode', $beging[0], $ending[$length - 1]])
                    ->all();
                //Our Filtering  Hour
                $query = array();
                foreach ($query1 as $q) {
                    for ($i = 0; $i < $length; $i++) {
                        if ($q->periode >= $price_beging[$i] && $q->periode <= $price_ending[$i]) {

                            $query[] = $q;
                        }
                    }
                }
            }


            //3-4
            if (!empty($Pricebyhour) && !empty($Numberofagent)) {
                $price_beging = array();
                $price_ending = array();
                foreach ($Pricebyhour as $p) {
                    $piece = explode("to", $p);
                    $price_beging[] = $piece[0];
                    $price_ending[] = $piece[1];
                    $length = count($price_ending);
                }
                //
                $query = ProductItem::find()
                    ->andFilterWhere(['partner_category' => 6])
                    ->andWhere(['number_of_agent' => $Numberofagent])
                    ->andWhere(['product_id' => $product_parent_id])
                    // ->andFilterWhere(['between', 'price', $price_beging[0], $price_ending[$length - 1]])
                    ->all();
                //price by hour filter
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
            }
            //3-5
            if (!empty($hour) && !empty($Numberofagent)) {
                $beging = array();
                $ending = array();
                foreach ($hour as $p) {
                    $piece = explode("to", $p);
                    $beging[] = $piece[0];
                    $ending[] = $piece[1];
                    $length = count($ending);
                }
                //
                /*  $query = ProductItem::find()
                    ->andFilterWhere(['partner_category' => 6])
                    ->andWhere(['number_of_agent' => $Numberofagent])
                    ->andWhere(['product_id' => $product_parent_id])
                    ->orWhere(['>=', 'periode', $beging])
                    ->orWhere(['<=', 'periode', $ending])
                    //->andFilterWhere(['between', 'periode', $beging[0], $ending[$length - 1]])
                    ->all();*/
                //Our Filtering  Hour
                $query = array();
                foreach ($query1 as $q) {
                    for ($i = 0; $i < $length; $i++) {
                        if ($q->periode >= $beging[$i] && $q->periode <= $ending[$i]) {

                            $query[] = $q;
                        }
                    }
                }
            }
            //4-5          
            if (!empty($hour) && !empty($Pricebyhour)) {

                $query1 = ProductItem::find()
                    ->andFilterWhere(['partner_category' => 6])
                    ->andWhere(['product_id' => $product_parent_id])
                    ->all();
                //Our Filtering  Hour
                $query = array();
                foreach ($query1 as $q) {
                    for ($i = 0; $i < $length; $i++) {
                        if ($q->periode >= $price_beging[$i] && $q->periode <= $price_ending[$i]) {

                            $query[] = $q;
                        }
                    }
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
            }
            //combinaison composée de 3 case a cocher
            //1-2-3
            if (!empty($Typeofevent) && !empty($Typeofagent) && !empty($Numberofagent)) {
                $Typeofagent=json_encode($Typeofagent,true);
                $expression1 = new \yii\db\Expression("JSON_CONTAINS(`temp`,'$Typeofagent')");
                $Typeofevent=json_encode($Typeofevent,true);
                $expression2 = new \yii\db\Expression("JSON_CONTAINS(`name`,'$Typeofevent')");
           
                $query = ProductItem::find()
                    ->andFilterWhere(['partner_category' => 6])
                    ->andWhere($expression1)
                    ->andWhere($expression2)
                    ->andWhere(['number_of_agent' => $Numberofagent])
                    ->andWhere(['product_id' => $product_parent_id])
                    ->all();
            }
            //1-2-4
            if (!empty($Typeofevent) && !empty($Typeofagent) && !empty($Pricebyhour)) {
                $price_beging = array();
                $price_ending = array();
                foreach ($Pricebyhour as $p) {
                    $piece = explode("to", $p);
                    $price_beging[] = $piece[0];
                    $price_ending[] = $piece[1];
                    $length = count($price_ending);
                }$Typeofagent=json_encode($Typeofagent,true);
                $expression1 = new \yii\db\Expression("JSON_CONTAINS(`temp`,'$Typeofagent')");
                $Typeofevent=json_encode($Typeofevent,true);
                $expression2 = new \yii\db\Expression("JSON_CONTAINS(`name`,'$Typeofevent')");
           
                $query = ProductItem::find()
                    ->andFilterWhere(['partner_category' => 6])
                    ->andWhere($expression1)
                    ->andWhere($expression2)
                    ->andWhere(['number_of_agent' => $Numberofagent])
                    //->andFilterWhere(['between', 'price', $price_beging[0], $price_ending[$length - 1]])
                    ->all();
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
            }
            //1-2-5
            if (!empty($Typeofevent) && !empty($Typeofagent) && !empty($hour)) {
                $beging = array();
                $ending = array();
                foreach ($hour as $p) {
                    $piece = explode("to", $p);
                    $beging[] = $piece[0];
                    $ending[] = $piece[1];
                    $length = count($ending);
                }
                $Typeofagent=json_encode($Typeofagent,true);
                $expression1 = new \yii\db\Expression("JSON_CONTAINS(`temp`,'$Typeofagent')");
                $Typeofevent=json_encode($Typeofevent,true);
                $expression2 = new \yii\db\Expression("JSON_CONTAINS(`name`,'$Typeofevent')");
           
                $query = ProductItem::find()
                    ->andFilterWhere(['partner_category' => 6])
                    ->andWhere($expression1)
                    ->andWhere($expression2)
                    ->andWhere(['product_id' => $product_parent_id])
                    // ->andFilterWhere(['between', 'periode', $beging[0], $ending[$length - 1]])
                    ->all();
                //Our Filtering  Hour
                $query = array();
                foreach ($query1 as $q) {
                    for ($i = 0; $i < $length; $i++) {
                        if ($q->periode >= $price_beging[$i] && $q->periode <= $price_ending[$i]) {

                            $query[] = $q;
                        }
                    }
                }
            }
            //Combinaison 3 partie 2
            //1-3-4
            if (!empty($Typeofevent) && !empty($Numberofagent) && !empty($Pricebyhour)) {
                $price_beging = array();
                $price_ending = array();
                foreach ($Pricebyhour as $p) {
                    $piece = explode("to", $p);
                    $price_beging[] = $piece[0];
                    $price_ending[] = $piece[1];
                    $length = count($price_ending);
                }

                $Typeofevent=json_encode($Typeofevent,true);
                $expression2 = new \yii\db\Expression("JSON_CONTAINS(`name`,'$Typeofevent')");
           
                $query = ProductItem::find()
                    ->andFilterWhere(['partner_category' => 6])
                    ->andWhere($expression2)
                    ->andWhere(['number_of_agent' => $Numberofagent])
                    ->andWhere(['product_id' => $product_parent_id])
                    //->andFilterWhere(['between', 'price', $price_beging[0], $price_ending[$length - 1]])
                    ->all();
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
            }
            //1-3-5
            if (!empty($Typeofevent) && !empty($Numberofagent) && !empty($hour)) {
                //priode
                $beging = array();
                $ending = array();
                foreach ($hour as $p) {
                    $piece = explode("to", $p);
                    $beging[] = $piece[0];
                    $ending[] = $piece[1];
                    $length = count($ending);
                }
                //price
                $price_beging = array();
                $price_ending = array();
                foreach ($Pricebyhour as $p) {
                    $piece = explode("to", $p);
                    $price_beging[] = $piece[0];
                    $price_ending[] = $piece[1];
                    $length = count($price_ending);
                }
               
                $Typeofevent=json_encode($Typeofevent,true);
                $expression2 = new \yii\db\Expression("JSON_CONTAINS(`name`,'$Typeofevent')");
           
                $query = ProductItem::find()
                    ->andFilterWhere(['partner_category' => 6])
                    ->andWhere($expression2)
                    ->andWhere(['temp' => $Typeofagent])
                    ->andWhere(['product_id' => $product_parent_id])
                    //    ->andFilterWhere(['between', 'periode', $beging[0], $ending[$length - 1]])
                    ->all();
                //Our Filtering  Hour
                $query = array();
                foreach ($query1 as $q) {
                    for ($i = 0; $i < $length; $i++) {
                        if ($q->periode >= $price_beging[$i] && $q->periode <= $price_ending[$i]) {

                            $query[] = $q;
                        }
                    }
                }
            }
            //1-4-5
            if (!empty($Typeofevent) && !empty($Pricebyhour) && !empty($hour)) {
                //priode
                $beging = array();
                $ending = array();
                foreach ($hour as $p) {
                    $piece = explode("to", $p);
                    $beging[] = $piece[0];
                    $ending[] = $piece[1];
                    $length = count($ending);
                }
                //price
                $price_beging = array();
                $price_ending = array();
                foreach ($Pricebyhour as $p) {
                    $piece = explode("to", $p);
                    $price_beging[] = $piece[0];
                    $price_ending[] = $piece[1];
                    $length = count($price_ending);
                }
               
                $Typeofevent=json_encode($Typeofevent,true);
                $expression2 = new \yii\db\Expression("JSON_CONTAINS(`name`,'$Typeofevent')");
           
                $query = ProductItem::find()
                    ->andFilterWhere(['partner_category' => 6])
                    ->andWhere($expression2)
                    ->andFilterWhere(['between', 'periode', $beging[0], $ending[$length - 1]])
                    ->andFilterWhere(['between', 'price', $price_beging[0], $price_ending[$length - 1]])
                    ->andWhere(['product_id' => $product_parent_id])
                    ->all();
                //Our Filtering  Hour
                $query = array();
                foreach ($query1 as $q) {
                    for ($i = 0; $i < $length; $i++) {
                        if ($q->periode >= $price_beging[$i] && $q->periode <= $price_ending[$i]) {

                            $query[] = $q;
                        }
                    }
                }
            }
            //2-3-4
            if (!empty($Typeofagent) && !empty($Numberofagent) && !empty($hour)) {
                //price
                $price_beging = array();
                $price_ending = array();
                foreach ($Pricebyhour as $p) {
                    $piece = explode("to", $p);
                    $price_beging[] = $piece[0];
                    $price_ending[] = $piece[1];
                    $length = count($price_ending);
                }
                $Typeofagent=json_encode($Typeofagent,true);
                $expression1 = new \yii\db\Expression("JSON_CONTAINS(`temp`,'$Typeofagent')");
                
           
                $query = ProductItem::find()
                    ->andFilterWhere(['partner_category' => 6])
                    ->andWhere($expression1)
                   
                    ->andWhere(['number_of_agent' => $Numberofagent])
                    ->andWhere(['product_id' => $product_parent_id])
                    // ->andFilterWhere(['between', 'periode', $beging[0], $ending[$length - 1]])
                    ->all();
                //Our Filtering  Hour
                $query = array();
                foreach ($query1 as $q) {
                    for ($i = 0; $i < $length; $i++) {
                        if ($q->periode >= $price_beging[$i] && $q->periode <= $price_ending[$i]) {

                            $query[] = $q;
                        }
                    }
                }
            }
            //2-3-5
            if (!empty($Typeofagent) && !empty($Numberofagent) && !empty($Pricebyhour)) {
                //price
                $price_beging = array();
                $price_ending = array();
                foreach ($Pricebyhour as $p) {
                    $piece = explode("to", $p);
                    $price_beging[] = $piece[0];
                    $price_ending[] = $piece[1];
                    $length = count($price_ending);
                }

                $Typeofagent=json_encode($Typeofagent,true);
                $expression1 = new \yii\db\Expression("JSON_CONTAINS(`temp`,'$Typeofagent')");
               
           
                $query = ProductItem::find()
                    ->andFilterWhere(['partner_category' => 6])
                    ->andWhere($expression1)
                    ->andWhere(['number_of_agent' => $Numberofagent])
                    ->andWhere(['product_id' => $product_parent_id])
                    //   ->andFilterWhere(['between', 'price', $price_beging[0], $price_ending[$length - 1]])
                    ->all();
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
            }

            //2-4-5
            if (!empty($Typeofagent) && !empty($Pricebyhour) && !empty($hour)) {
                //priode
                $beging = array();
                $ending = array();
                foreach ($hour as $p) {
                    $piece = explode("to", $p);
                    $beging[] = $piece[0];
                    $ending[] = $piece[1];
                    $length = count($ending);
                }
                //price
                $price_beging = array();
                $price_ending = array();
                foreach ($Pricebyhour as $p) {
                    $piece = explode("to", $p);
                    $price_beging[] = $piece[0];
                    $price_ending[] = $piece[1];
                    $length = count($price_ending);
                }
                $Typeofagent=json_encode($Typeofagent,true);
                $expression1 = new \yii\db\Expression("JSON_CONTAINS(`temp`,'$Typeofagent')");
               
           
                $query = ProductItem::find()
                    ->andFilterWhere(['partner_category' => 6])
                    ->andWhere($expression1)
                    ->andWhere(['product_id' => $product_parent_id])
                    //->andFilterWhere(['between', 'periode', $beging[0], $ending[$length - 1]])
                    // ->andFilterWhere(['between', 'price', $price_beging[0], $price_ending[$length - 1]])
                    ->all();
                //Our Filtering  Hour
                $query2 = array();
                foreach ($query1 as $q) {
                    for ($i = 0; $i < $length; $i++) {
                        if ($q->periode >= $price_beging[$i] && $q->periode <= $price_ending[$i]) {

                            $query2[] = $q;
                        }
                    }
                }
                $query = array();
                foreach ($query2 as $q) {
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
            }
            //3-4-5
            if (!empty($Numberofagent) && !empty($Pricebyhour) && !empty($hour)) {
                //priode
                $beging = array();
                $ending = array();
                foreach ($hour as $p) {
                    $piece = explode("to", $p);
                    $beging[] = $piece[0];
                    $ending[] = $piece[1];
                    $length = count($ending);
                }
                //price
                $price_beging = array();
                $price_ending = array();
                foreach ($Pricebyhour as $p) {
                    $piece = explode("to", $p);
                    $price_beging[] = $piece[0];
                    $price_ending[] = $piece[1];
                    $length = count($price_ending);
                }
                $query1 = ProductItem::find()
                    ->andFilterWhere(['partner_category' => 6])
                    ->andWhere(['number_of_agent' => $Numberofagent])
                    ->andWhere(['product_id' => $product_parent_id])
                    //  ->andFilterWhere(['between', 'periode', $beging[0], $ending[$length - 1]])
                    //  ->andFilterWhere(['between', 'price', $price_beging[0], $price_ending[$length - 1]])
                    ->all();
                //Our Filtering  Hour
                $query2 = array();
                foreach ($query1 as $q) {
                    for ($i = 0; $i < $length; $i++) {
                        if ($q->periode >= $beging[$i] && $q->periode <= $ending[$i]) {

                            $query2[] = $q;
                        }
                    }
                }
                $query = array();
                foreach ($query2 as $q) {
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
            }
            //combainson  de 4

            //1-2-3-4

            if (!empty($Typeofevent) && !empty($Typeofagent) && !empty($Numberofagent) && !empty($hour)) {
                $beging = array();
                $ending = array();
                foreach ($hour as $p) {
                    $piece = explode("to", $p);
                    $beging[] = $piece[0];
                    $ending[] = $piece[1];
                    $length = count($ending);
                }

                $Typeofagent=json_encode($Typeofagent,true);
                $expression1 = new \yii\db\Expression("JSON_CONTAINS(`temp`,'$Typeofagent')");
                $Typeofevent=json_encode($Typeofevent,true);
                $expression2 = new \yii\db\Expression("JSON_CONTAINS(`name`,'$Typeofevent')");
           
                $query = ProductItem::find()
                    ->andFilterWhere(['partner_category' => 6])
                    ->andWhere($expression1)
                    ->andWhere($expression2)
                    ->andWhere(['number_of_agent' => $Numberofagent])
                    ->andWhere(['product_id' => $product_parent_id])
                    //  ->andFilterWhere(['between', 'periode', $beging[0], $ending[$length - 1]])
                    ->all();
                //Our Filtering  Hour
                $query = array();
                foreach ($query1 as $q) {
                    for ($i = 0; $i < $length; $i++) {
                        if ($q->periode >= $price_beging[$i] && $q->periode <= $price_ending[$i]) {

                            $query[] = $q;
                        }
                    }
                }
            }
            //1-2-3-5
            if (!empty($Typeofevent) && !empty($Typeofagent) && !empty($Numberofagent) && !empty($Pricebyhour)) {
                $price_beging = array();
                $price_ending = array();
                foreach ($Pricebyhour as $p) {
                    $piece = explode("to", $p);
                    $price_beging[] = $piece[0];
                    $price_ending[] = $piece[1];
                    $length = count($price_ending);
                }
                $Typeofagent=json_encode($Typeofagent,true);
                $expression1 = new \yii\db\Expression("JSON_CONTAINS(`temp`,'$Typeofagent')");
                $Typeofevent=json_encode($Typeofevent,true);
                $expression2 = new \yii\db\Expression("JSON_CONTAINS(`name`,'$Typeofevent')");
           
                $query = ProductItem::find()
                    ->andFilterWhere(['partner_category' => 6])
                    ->andWhere($expression1)
                    ->andWhere($expression2)
                    ->andWhere(['number_of_agent' => $Numberofagent])
                    ->andWhere(['product_id' => $product_parent_id])
                    //->andFilterWhere(['between', 'price', $price_beging[0], $price_ending[$length - 1]])
                    ->all();

                //Our Filtering  Price
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
            }
            //1-3-4-5
            if (!empty($Typeofevent) && !empty($Numberofagent) && !empty($hour) && !empty($Pricebyhour)) {
                //spliting the hour array into two ranges
                $beging = array();
                $ending = array();
                foreach ($hour as $p) {
                    $piece = explode("to", $p);
                    $beging[] = $piece[0];
                    $ending[] = $piece[1];
                    $length = count($ending);
                }
                //spliting the Price inhour array into two ranges
                $price_beging = array();
                $price_ending = array();
                foreach ($Pricebyhour as $p) {
                    $piece = explode("to", $p);
                    $price_beging[] = $piece[0];
                    $price_ending[] = $piece[1];
                    $length = count($price_ending);
                }

              
                $Typeofevent=json_encode($Typeofevent,true);
                $expression2 = new \yii\db\Expression("JSON_CONTAINS(`name`,'$Typeofevent')");
           
                $query = ProductItem::find()
                    ->andFilterWhere(['partner_category' => 6])
               
                    ->andWhere($expression2)
                    ->andWhere(['number_of_agent' => $Numberofagent])
                    ->andWhere(['product_id' => $product_parent_id])
                    // ->andFilterWhere(['between', 'periode', $beging[0], $ending[$length - 1]])
                    // ->andFilterWhere(['between', 'price', $price_beging[0], $price_ending[$length - 1]])
                    ->all();
                //Our Filtering  Hour
                $query2 = array();
                foreach ($query1 as $q) {
                    for ($i = 0; $i < $length; $i++) {
                        if ($q->periode >= $price_beging[$i] && $q->periode <= $price_ending[$i]) {

                            $query2[] = $q;
                        }
                    }
                }
                $query = array();
                foreach ($query2 as $q) {
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
            }
            //combinaison de 5
            //1-2-3-4-5
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
}
