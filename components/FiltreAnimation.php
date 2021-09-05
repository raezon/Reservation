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

class FiltreAnimation extends FilterCater
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

        $Distance = array();
        if (!empty($request->get('Distance'))) {

            $array = $request->get('Distance');
            $Distance = explode(",", $array);
        }
        /*gettinng the appropriate products that verify the followin conditions:
    must have an array of the partner within the aproved time and address and belong to the
    apropriate partner_category*/
        $product_parent = ProductParent::find()
            ->andwhere(['partner_id' => $this->result])
            ->andwhere(['partner_category' => 5])
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
                    ->andFilterWhere(['partner_category' => 5])
                    ->andWhere(['product_id' => $product_parent_id])
                    ->all();
            }
        }
        //All possible combinaison
        $precedant = 0;
        $query1 = array();

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
        if (!empty($Distance)) {
            $query = array();
            $query = $query1;
        }
        if (empty($this->result))
            $query = array();
        return $query;
    }
}
