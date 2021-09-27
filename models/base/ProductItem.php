<?php

namespace app\models\base;

use Yii;
use app\models\Partner;
use app\models\ProductParent;


/**
 * This is the base model class for table "product_item".
 *
 * @property integer $id
 * @property integer $partner_category
 * @property string $name
 * @property string $temp
 * @property string $description
 * @property integer $people_number
 * @property integer $number_of_agent
 * @property integer $quantity
 * @property integer $periode
 * @property double $price
 * @property string $currencies_symbol
 * @property string $languages
 * @property string $picture
 * @property string $checkbox
 * @property integer $status
 * @property integer $product_id
 * @property double $distance;
 *
 * @property \app\models\ProductParent $product
 * @property \app\models\PartnerCategory $partnerCategory
 */
class ProductItem extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public $vegan;
    public $Vegetarian;
    public $Organic;
    public $Gluten_free;
    public $Halal;
    public $Cacher;
    public $Without_porc;
    public $image;
 

    public function rules()
    {
        return
            [
                [['vegan', 'Vegetarian', 'Organic', 'Gluten_free', 'Halal', 'Cacher', 'Without_porc', 'image', 'partner_category'], 'safe'],
               
                [['name', 'temp', 'description', 'people_number',  'quantity', 'periode', 'price', 'currencies_symbol', 'languages', 'status', 'product_id'], 'required'],
               
                [['picture'], 'safe'],
            
                [['people_number', 'number_of_agent', 'quantity', 'periode', 'status', 'product_id'], 'integer'],
                [['price'], 'number'],
                [['name', 'temp', 'currencies_symbol', 'languages', 'image', 'checkbox'], 'string', 'max' => 255]
            ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_item';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'partner_category' => 'Partner Category',
            'name' => 'Name',
            'temp' => 'Temp',
            'description' => 'Description',
            'people_number' => 'People Number',
            'number_of_agent' => 'Number Of Agent',
            'quantity' => 'Quantity',
            'periode' => 'Periode',
            'price' => 'Price',
            'price_day' => 'Price Day',
            'price_night' => 'Price Night',
            'currencies_symbol' => 'Currencies Symbol',
            'languages' => 'Languages',
            'picture' => 'Picture',
            'checkbox' => 'Checkbox',
            'status' => 'Status',
            'product_id' => 'Product ID',
        ];
    }

        /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(\app\models\ProductParent::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartnerCategory()
    {
        return $this->hasOne(\app\models\PartnerCategory::className(), ['id' => 'partner_category']);
    }

    /**
     * @inheritdoc
     * @return \app\models\ProductItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ProductItemQuery(get_called_class());
    }

    
    public function detail($id)
    {
        //Search the product Parent of a productItem
        $model = ProductParent::find()->where(['id' => $id])->one();
        $model_Partner = Partner::find()->where(['id' => $model->partner_id])->one();
        $model_array = array();
        $model_array[0] = $model;
        $model_array[1] = $model_Partner;
        return $model_array;
    }
    public function totalPrice($description, $category, $price, $qte_form, $qte_search, $peopleNumber,$dissponibility,$subCategory)
    {
    
        $counter=0;
        $checkIfpassed=0;
        $checkIfpassed2=0;
        $priceReservation=0;
        $duration5=0;
        $diffBetweenCOAndPOIncrement=-5;$diffBetweenCOAndPCIncrement=-5;
        $diffBetweenCOAndPOIncrement =  -5;
        global  $priceReservation;
        $ClosedClientAmSignNegative=0;
        $ChosedClientAmSignNegative=0;
        $timestamp = strtotime( $_SESSION['depart']);
        $dayDepart = date('l', $timestamp);
        $timestamp = strtotime( $_SESSION['arriver']);
        $dayArriver = date('l', $timestamp);
        if ($category == 1) {
          
         
            $subCategory="Cinema";
            //cleansing subCategory
            if(!is_string($subCategory)){
                $subCategory=$subCategory+1;
                switch ($subCategory) {
                     case 0:
                         $subCategory='Banquet\Dinner';
                         break;
                     case 1:
                         $subCategory='Conference';
                         break;
                     case 2:
                         $subCategory='Cinema';
                         break;
                     case 3:
                         $subCategory='Dinatoire';
                         break;
                     case 4:
                         $subCategory='Meeting';
                         break;
                     case 5:
                         $subCategory='Theater';
                         break;
                     case 6:
                         $subCategory='Other';
                         break;
                     
                     default:
                         # code...
                         break;
                 }
            }
              //Ouverture Partner
              $timeStartChosedByClient = new \DateTime( $_SESSION['heure_depart']);
              $timeStartChosedByClient = $timeStartChosedByClient->format('H:i');
              //Fermuture Partner
              $timeClosedChosedByClient = new \DateTime($_SESSION['heure_fermuture']);
              $timeClosedChosedByClient = $timeClosedChosedByClient->format(' H:i');
              //Ouverture Client

              //Fermuture Client
              //Traitement de seperation
              $timeStartChosedByClient=explode(":", $timeStartChosedByClient);
              $timeClosedChosedByClient=explode(":", $timeClosedChosedByClient);
              //Condition d'acumulation
              if($timeStartChosedByClient[0]<12){
                  if($timeStartChosedByClient[0]=="00"){
                      $timeStartChosedByClient[0]=$timeStartChosedByClient[0]+24;
                  } 
                  if( $timeStartChosedByClient[0]=="01"
                  or $timeStartChosedByClient[0]=="02" or $timeStartChosedByClient[0]=="03" 
                  or $timeStartChosedByClient[0]=="04" or $timeStartChosedByClient[0]=="05"
                  or $timeStartChosedByClient[0]=="06" or $timeStartChosedByClient[0]=="07"
                  or $timeStartChosedByClient[0]=="08" or $timeStartChosedByClient[0]=="09"
                  or $timeStartChosedByClient[0]=="10" or $timeStartChosedByClient[0]=="11"
                  ){
                      //$timeStartChosedByClient[0]=$timeStartChosedByClient[0]+24;
                      $ChosedClientAmSignNegative=1;
                  }
              }
              if($timeClosedChosedByClient[0]<12){
                     if($timeClosedChosedByClient[0]=="00"){
                         $timeClosedChosedByClient[0]=$timeClosedChosedByClient[0]+24;
                     } 
                    // echo $timeClosedChosedByClient[0].'sss';
                     if( $timeClosedChosedByClient[0]=="01"
                     or $timeClosedChosedByClient[0]=="02" or $timeClosedChosedByClient[0]=="03" 
                     or $timeClosedChosedByClient[0]=="04" or $timeClosedChosedByClient[0]=="05"
                     or $timeClosedChosedByClient[0]=="06" or $timeClosedChosedByClient[0]=="07"
                     or $timeClosedChosedByClient[0]=="08" or $timeClosedChosedByClient[0]=="09"
                     or $timeClosedChosedByClient[0]=="10" or $timeClosedChosedByClient[0]=="11"
                     ){
                     //    $timeClosedChosedByClient[0]=$timeClosedChosedByClient[0]+24;
                         $ClosedClientAmSignNegative=1;
                     }
                 }
              //Joiture de chaque date 
              $timeStartChosedByClient=$timeStartChosedByClient[0].":".$timeStartChosedByClient[1];
              $timeClosedChosedByClient=$timeClosedChosedByClient[0].":".$timeClosedChosedByClient[1];
              //
         
            $duration2=  strtotime($timeClosedChosedByClient)-strtotime($timeStartChosedByClient);
            $duration2 =  $duration2/3600;
            $duration4 =  $duration2;


    //Calculating the final price
              $price = $priceReservation*$qte_search ; 
              $price =(round($price , 2));
              $priceReservation=0;     
                
}    
        else if ($category == 3) {

            return ($price * round($qte_search / $peopleNumber));
        }
        return $price;
    }
}
