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
    public $Arabic;
    public $Frensh;
    public $English;
    public $Deutsh;
    public $Japenesse;
    public $image;
    public $caution;
    public $distance;

    public function rules()
    {
        return
            [
                [['vegan', 'Vegetarian', 'Organic', 'Gluten_free', 'Halal', 'Cacher', 'Without_porc', 'image', 'caution', 'partner_category', 'extra', 'distance'], 'safe'],
                [['Arabic', 'Frensh', 'English', 'Deutsh', 'Japenesse'], 'safe'],
                [['name', 'temp', 'description', 'people_number', 'number_of_agent', 'quantity', 'periode', 'price', 'currencies_symbol', 'languages', 'picture', 'checkbox', 'status', 'product_id'], 'required'],
                [['people_number', 'number_of_agent', 'quantity', 'periode', 'status', 'product_id'], 'integer'],
                [['price'], 'number'],
                [['name', 'temp', 'currencies_symbol', 'languages', 'picture', 'image', 'checkbox'], 'string', 'max' => 255]
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
          
            $dissponibility=json_decode($dissponibility,true);
            $dayOvertureFermuture=$dissponibility[8];
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

            foreach($dayOvertureFermuture as $day){
                
            if (array_key_exists($subCategory,$day))
            {
              
                $ClosedPartnerAmSignNegative=0;
                $ClosedPartnerOPAmSignNegative=0;
                //Partie cleansing date
                //Ouverture Partner
                $timeOuverturePartner = new \DateTime( $day['From']);
                $timeOuverturePartner = $timeOuverturePartner->format('H:i');
                //Fermuture Partner
                $timeClosedPartner = new \DateTime($day['To']);
                $timeClosedPartner = $timeClosedPartner->format(' H:i');
                //Ouverture Client

                //Fermuture Client
                //Traitement de seperation
                $timeOuverturePartner=explode(":", $timeOuverturePartner);
                $timeClosedPartner=explode(":", $timeClosedPartner);
                //Condition d'acumulation
                if($timeOuverturePartner[0]<12){
                    if($timeOuverturePartner[0]=="00"){
                        $timeOuverturePartner[0]=$timeOuverturePartner[0]+24;
                    }
                    if( $timeOuverturePartner[0]=="01"
                    or $timeOuverturePartner[0]=="02" or $timeOuverturePartner[0]=="03" 
                    or $timeOuverturePartner[0]=="04" or $timeOuverturePartner[0]=="05"
                    or $timeOuverturePartner[0]=="06" or $timeOuverturePartner[0]=="07"
                    or $timeOuverturePartner[0]=="08" or $timeOuverturePartner[0]=="09"
                    or $timeOuverturePartner[0]=="10" or $timeOuverturePartner[0]=="11"
                    ){
                      //  $timeOuverturePartner[0]=$timeOuverturePartner[0]+24;
                      $ClosedPartnerOPAmSignNegative=1;
                    }
                    
                }
                if($timeClosedPartner[0]<12){
                       if($timeClosedPartner[0]=="00"){
                           $timeClosedPartner[0]=$timeClosedPartner[0]+24;
                       } if( $timeClosedPartner[0]=="01"
                       or $timeClosedPartner[0]=="02" or $timeClosedPartner[0]=="03" 
                       or $timeClosedPartner[0]=="04" or $timeClosedPartner[0]=="05"
                       or $timeClosedPartner[0]=="06" or $timeClosedPartner[0]=="07"
                       or $timeClosedPartner[0]=="08" or $timeClosedPartner[0]=="09"
                       or $timeClosedPartner[0]=="10" or $timeClosedPartner[0]=="11"
                       ){
                       //    $timeClosedPartner[0]=$timeClosedPartner[0]+24;
                           $ClosedPartnerAmSignNegative=1;
                       }
                   }
                  
                //Joiture de chaque date 
                $timeOuverturePartner=$timeOuverturePartner[0].":".$timeOuverturePartner[1];
                $timeClosedPartner=$timeClosedPartner[0].":".$timeClosedPartner[1];
                
                
                //Partie transformation
                $diffBetweenCOAndPO =  (strtotime($timeStartChosedByClient)-strtotime($timeOuverturePartner))/3600;
                
                $diffBetweenPcAndCO =  (strtotime($timeClosedPartner)-strtotime($timeStartChosedByClient))/3600;
                if($ClosedClientAmSignNegative==1 && $ClosedPartnerOPAmSignNegative==0){

                    $diffBetweenCCAndPO = -1*((strtotime($timeClosedChosedByClient)-strtotime($timeClosedPartner))/3600)+24;
                  //  echo $diffBetweenCCAndPC.'ll';
                }else{
                    
                    $diffBetweenCCAndPO =  (strtotime($timeClosedChosedByClient)-strtotime($timeOuverturePartner))/3600;

                }
                
                $diffBetweenPCAndCC =  (strtotime($timeClosedPartner)-strtotime($timeClosedChosedByClient))/3600;
               // echo $ClosedClientAmSignNegative.'ddd';
                //echo $ClosedClientAmSignNegative.'ddd';
               // echo $timeClosedChosedByClient.'depart';
               
                if($ClosedClientAmSignNegative==0 && $ClosedPartnerAmSignNegative==1){

                    $diffBetweenCCAndPC = -1*((strtotime($timeClosedChosedByClient)-strtotime($timeClosedPartner))/3600);
                  //  echo $diffBetweenCCAndPC.'ll';
                }else{
                    
                    $diffBetweenCCAndPC =  (strtotime($timeClosedChosedByClient)-strtotime($timeClosedPartner))/3600;
                    //echo $diffBetweenCCAndPC.'result';
                }
                
                
                $duration=  strtotime($timeClosedPartner)-strtotime($timeOuverturePartner);
                $duration3=  (strtotime($timeOuverturePartner)-strtotime($timeClosedChosedByClient))/(3600*24);
                $duration3=explode(".", $duration3);
                $duration =  $duration/3600;
                $duration4=explode(".", $duration);
                $duration5=$duration4;
                if($duration3[0]<=-1 && $counter==0){
                    $duration3[0]=$duration3[0]*-1;
                    $counter++;
                }
               
                //Ajouter la condition apres si le partnaire dit qu'il n'accept moins d'une journy
              
                if($dissponibility[9]=="Yes"){
                   if(array_key_exists($subCategory,$day)){
                    if($diffBetweenCOAndPO>=0  && $diffBetweenCOAndPO<=1  && $diffBetweenPcAndCO>0 && $diffBetweenPcAndCO<=1  ){
                      //  echo "vvv";
                        if($checkIfpassed==0){
                      //      echo "ff";
                     //  echo $day[$subCategory];
                            $checkIfpassed=1;
                            $priceReservation+=$day[$subCategory];
                            $diffBetweenCOAndPOIncrement =  $timeStartChosedByClient;
                            $diffBetweenCOAndPOIncrement = new \DateTime($diffBetweenCOAndPOIncrement);

                            $diffBetweenCOAndPOIncrement = $diffBetweenCOAndPOIncrement->format('H:i');
                            $diffBetweenCOAndPOInc= $diffBetweenCOAndPOIncrement;
                            
                                $diffBetweenCOAndPOIncrement =  (strtotime($diffBetweenCOAndPOInc)-strtotime($timeOuverturePartner))/3600;
                                $diffBetweenCOAndPCIncrement =  (strtotime($diffBetweenCOAndPOInc)-strtotime($timeClosedPartner))/3600;

                           continue 1;
                        }
                    }
                    //echo $diffBetweenCOAndPOIncrement.'sss';
                    if(($diffBetweenCOAndPOIncrement>=0  && ($diffBetweenCOAndPCIncrement>=-1 && $diffBetweenCOAndPCIncrement<=0) )){
                      
                        if($duration2 !=$duration4[0]){
                         //   echo "k";
                        if($checkIfpassed==1){
                         //   echo $day[$subCategory];
                            $priceReservation+=$day[$subCategory];
                        }
                    }

                    }
                    if(($diffBetweenCCAndPO>0  && ($diffBetweenCCAndPC>=-1 && $diffBetweenCCAndPC<=0) )){
                        if($duration2!=$duration4[0]){
                       //     echo "vv";
                            $checkIfpassed=2;
                            $checkIfpassed2=1;
                       //     echo $day[$subCategory];
                            $priceReservation+=$day[$subCategory];
                        }
                        //$checkIfpassed++;
                      }
                     //Cleansing if mintures does not exist
                      if(!key_exists(1,$duration4)){
                        $duration4[1]=0;
                      }
                  if($checkIfpassed==1){
                   
                        $diffBetweenCOAndPOInc = new \DateTime($diffBetweenCOAndPOInc);
                        //add with periode li 9bel
                        $diffBetweenCOAndPOInc->modify('+'.$duration4[0].' hour +'.$duration4[1].' minutes');
                        $diffBetweenCOAndPOIncrement = $diffBetweenCOAndPOInc->format('H:i');
                        $diffBetweenCOAndPOInc= $diffBetweenCOAndPOIncrement; 
                        $a=strtotime($timeStartChosedByClient);
                        $b=strtotime($diffBetweenCOAndPOInc);
                    if($b<$a){   
                        $diffBetweenCOAndPOIncrement =  (strtotime($diffBetweenCOAndPOInc)-strtotime($timeOuverturePartner))/3600;
                        $diffBetweenCOAndPCIncrement =  (strtotime($diffBetweenCOAndPOInc)-strtotime($timeClosedPartner))/3600;
                    }   else{
                        $checkIfpassed=3;
                    }
                }

            }

          
                }else{
                   
                    if(array_key_exists($subCategory,$day)){
                        //echo $diffBetweenCOAndPO."ss";
                       // echo $diffBetweenPcAndCO.'dd';
                        if($diffBetweenCOAndPO>=0  && $diffBetweenCOAndPO<=(float)$duration5  && $diffBetweenPcAndCO>0 && $diffBetweenPcAndCO<=(float)$duration5  ){
                            if($duration!=0){
                                $duration=$diffBetweenPcAndCO/$duration;
                                if($duration>1){
                                    $duration=1;
                                }
                            }
                            else 
                                    $duration=1;
                               //    echo "ff"; 
                              if($checkIfpassed2==0){
                                  
                           //  echo $day[$subCategory];
                                  $checkIfpassed2=1;
                                  $priceReservation+=$day[$subCategory]*$duration;
                                  $diffBetweenCOAndPOIncrement =  $timeStartChosedByClient;
                                  $diffBetweenCOAndPOIncrement = new \DateTime($diffBetweenCOAndPOIncrement);
      
                                  $diffBetweenCOAndPOIncrement = $diffBetweenCOAndPOIncrement->format('H:i');
                                  $diffBetweenCOAndPOInc= $diffBetweenCOAndPOIncrement;
                                  
                                  $diffBetweenCOAndPOIncrement =  (strtotime($diffBetweenCOAndPOInc)-strtotime($timeOuverturePartner))/3600;
                                  $diffBetweenCOAndPCIncrement =  (strtotime($diffBetweenCOAndPOInc)-strtotime($timeClosedPartner))/3600;
      
                                 continue 1;
                              }
                          }
                         // echo $diffBetweenCOAndPOIncrement.'sss';
                          if(($diffBetweenCOAndPOIncrement>=0  && ($diffBetweenCOAndPCIncrement>=-1*(float)$duration5 && $diffBetweenCOAndPCIncrement<=0) )){
                            //echo "k";
                              if($duration2 !=(float)$duration5){
                                 
                              if($checkIfpassed2==1){
                               //   echo $day[$subCategory];
                                  $priceReservation+=$day[$subCategory];
                              }
                          }
      
                          }
                          //echo $diffBetweenCCAndPC.'dd';
                          if(($diffBetweenCCAndPO>0  && ($diffBetweenCCAndPC>=-1*(float)$duration5 && $diffBetweenCCAndPC<=0) )){
                          //  echo "vv";
                            if($duration!=0){
                                $duration=$diffBetweenPcAndCO/$duration;
                                if($duration>1){
                                    $duration=1;
                                }
                            }
                                   
                                else 
                                    $duration=1;  
                                //     echo $duration;
                            if($duration2 !=(float)$duration5){
                                 
                                  $checkIfpassed=2;
                                  $checkIfpassed2=2;
                                 
                             $priceReservation+=$day[$subCategory]*$duration;
                              }
                              //$checkIfpassed++;
                            }
                           //Cleansing if mintures does not exist
                            if(!key_exists(1,$duration4)){
                              $duration4[1]=0;
                            }
                        if($checkIfpassed2==1){
                         
                              $diffBetweenCOAndPOInc = new \DateTime($diffBetweenCOAndPOInc);
                              //add with periode li 9bel
                              $diffBetweenCOAndPOInc->modify('+'.$duration4[0].' hour +'.$duration4[1].' minutes');
                              $diffBetweenCOAndPOIncrement = $diffBetweenCOAndPOInc->format('H:i');
                              $diffBetweenCOAndPOInc= $diffBetweenCOAndPOIncrement; 
                              $a=strtotime($timeStartChosedByClient);
                              $b=strtotime($diffBetweenCOAndPOInc);
                          if($b<$a){   
                              $diffBetweenCOAndPOIncrement =  (strtotime($diffBetweenCOAndPOInc)-strtotime($timeOuverturePartner))/3600;
                              $diffBetweenCOAndPCIncrement =  (strtotime($diffBetweenCOAndPOInc)-strtotime($timeClosedPartner))/3600;
                          }   else{
                              $checkIfpassed=3;
                          }
                      }



                            }
                }

            }

    } 
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
