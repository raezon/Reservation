<?php

namespace app\components;

use Yii;
use yii\base\Component;
use yii\db\Expression;
use app\models\Partner;
use DateTime;
use DatePeriod;
use DateInterval;
use app\models\base\TblEvents;
use app\models\User;

//i need to define my model here 

class step1 extends Component
{
  function save_partner_step1($modelStep1, $user_id, $category_id,$test = null)
  {
    //partie Intiantiation
    $name = $modelStep1->firstName;
    $lastName = $modelStep1->lastName;
    $tel = $modelStep1->tel;
    $mobile = $modelStep1->mobile;
    $fax = $modelStep1->fax;
    $email = $modelStep1->email;
    //first we need to check if the partenaire exist
    $partenaire_existance = Partner::find()
      ->where(['user_id' => $user_id])
      ->exists();
    //we get a model from the product       
    $product_model = Partner::find()
      ->where(['user_id' => $user_id])->one();
    if (!$partenaire_existance) {
      $Name = bin2hex(openssl_random_pseudo_bytes(4));
      $product_model = new Partner();
    }
    $expression = new Expression('NOW()');
    $now = (new \yii\db\Query)->select($expression)->scalar();  // SELECT NOW();
    // prints the current date
    // we fill the default partenair identification
    $product_model->name = $name;
    $product_model->description = "xxxx";
    $product_model->address = "xxxx";
    $product_model->tel = $tel;
    if (empty($mobile))
      $mobile = "empty";
    $product_model->mobile = $mobile;
    if (empty($fax))
      $fax = "empty";
    $product_model->fax = $fax;
    $product_model->web_site = "xxxx";
    $product_model->country = "xxxx";
    $product_model->city = "xxxx";
    $product_model->companyAddress = "xxxx";
    $product_model->companyAddress_N = "xxxx";
    $product_model->postal_code = "xxxx";
    $product_model->keywords = "xxxx";
    $product_model->email = $email;
    $product_model->picture = "xxxx";
    $product_model->user_id = $user_id;
    $product_model->category_id = $category_id;
    $product_model->status = 0;
    $expression = new Expression('NOW()');
    $now = (new \yii\db\Query)->select($expression)->scalar();  // SELECT NOW()
    $timestamp = strtotime($now);;
    $product_model->created_at = $timestamp;
    $product_model->updated_at = $timestamp;

    //$product_model->updated_at=$timestamp;
    //dans le cas que le partenair exist dej
    if ($partenaire_existance) {
      if ($product_model->update()) {
        
       
        return true;

      } else {
        if(!$test){
          return false;
        }
        echo "UPDAT MODEL NOT SAVED partenair";
        //print_r( $product_model->getAttributes());
        print_r($product_model->getErrors());
        exit;
      }
    }
    //dans le cas que le partenaire n'exist pas
    else {
      if ($product_model->save()) {
        echo "sucess save";
        if($test){
          return true;
        }
        $this->create_date_partner();
  

      } else {
        if(!$test){
          return false;
        }
        echo "SAVE";
        echo "MODEL NOT SAVED";
        print_r($product_model->getAttributes());
        print_r($product_model->getErrors());
        exit;
      }
    }
  }
  //function taw3i
  public function getDatesFromRange($start, $end, $format = 'Y-m-d')
  {
    $array = array();
    $interval = new DateInterval('P1D');

    $realEnd = new DateTime($end);
    $realEnd->add($interval);

    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

    foreach ($period as $date) {
      $array[] = $date->format($format);
    }
    return $array;
  }
  public function create_date_partner()
  {
    //partie insertion dans la table event
    $date_of_starting = date("Y-m-d");
    $end_of_starting = date('Y-m-d', strtotime('+3 Years'));
    //adding to the date of now

    $array =  $this->getDatesFromRange($date_of_starting, $end_of_starting);
    //insert $data in the model even
    $i = 0;
    $numItems = count($array);
    $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
    $id_partenaire = $partner->id;
    $exist = TblEvents::find()->where(['partner_id' => $partner->id])->one();
    if (is_null($exist)) {
      foreach ($array as $key => $value) {
        $model5 = new TblEvents();
        $model5->id = $i;
        $model5->title = "Availability";
        $time1 = strtotime($array[$key]);
        $value1 = date('Y-m-d', $time1);
        if (++$i == $numItems) {
          $time2 = strtotime($array[$key]);
          $value2 = date('Y-m-d', $time2);
        } else {
          if (array_key_exists($key + 1, $array)) {
            $time2 = strtotime($array[$key + 1]);
            $value2 = date('Y-m-d', $time2);
          }
        }
        $model5->title = "Available";
        $model5->partner_id = $id_partenaire;
        $model5->start = $value1;
        $model5->end = $value2;
        $model5->save();
        if (++$i == $numItems) {
        }
      }
    }
  }
}
