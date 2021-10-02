<?php

namespace app\components;

use Yii;
use yii\base\Component;
use yii\db\Expression;
use app\models\Partner;

class step2 extends Component
{
  function getCordinate($addressTo, $unit = '')
  {

    // Google API key
    $apiKey = 'AIzaSyB7Iz5ZKGr0_5l_LD47xNf9umU7GSiUVuw';
    // Change address format
    $formattedAddrTo  = str_replace(' ', '+', $addressTo);
    $cordinates = array();
    // Geocoding API request with end address
    $geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $formattedAddrTo . '&sensor=false&key=' . $apiKey);
    $outputTo = json_decode($geocodeTo);

    if (!empty($outputTo->error_message)) {
      return $outputTo->error_message;
    }
    $cordinates[0] = $outputTo->results[0]->geometry->location->lat;
    $cordinates[1] = $outputTo->results[0]->geometry->location->lng;
    return $cordinates;
  }
  function save_partner_step2($user_id, $category_id, $modelStep2)
  {
    //Intiantiation
    $addresse = $modelStep2->search;
    $companyAddress = $modelStep2->companyAddress;
    $companyAddress_N = $modelStep2->companyAddress_N;
    $city = $modelStep2->city;
    $state = $modelStep2->state;
    $postalCode = $modelStep2->postalCode;
    $country = $modelStep2->country;


    $product_model = Partner::find()
      ->where(['user_id' => $user_id])->one();

    $address = $addresse;
    $product_model->address = $address;
    $product_model->country = 'alger';
    $product_model->city = $city;
     $product_model->state=$state;
    $product_model->postal_code = $postalCode;
    $product_model->category_id = $category_id;
    $product_model->companyAddress = "xxxx";
    $product_model->companyAddress_N = "xxxx";
    $product_model->piece_jointe="Empty";

    //DeliveryAndDeplacement Cordinates
    //appeller la fonction
    $Cordinates = array();
    $Cordinates = $this->getCordinate($product_model->address . ',' . $product_model->city . ',' . $product_model->postal_code . ',' . $product_model->country);
    $product_model->latitude = $Cordinates[0];
    $product_model->longitude = $Cordinates[1];

    $expression = new Expression('NOW()');
    $now = (new \yii\db\Query)->select($expression)->scalar();
    $expression = new Expression('NOW()');
    $now = (new \yii\db\Query)->select($expression)->scalar();  // SELECT NOW()
    $timestamp = strtotime($now);;
    $product_model->created_at = $timestamp;
    $product_model->updated_at = $timestamp;
    if ($product_model->update()) {
     return true;
    } else {
      echo "UPDAT MODEL NOT SAVED partenaire in step2";
      print_r($product_model->getAttributes());
      print_r($product_model->getErrors());
      exit;
    }
  }
}
