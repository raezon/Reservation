<?php

namespace app\components;

use Yii;
use yii\base\Component;
use yii\db\Expression;
use app\models\Partner;
use app\models\ProductParent;
use app\models\PartnerCategory;
use app\models\ProductItem;

use app\models\User;
//i need to define my model here

class step3 extends Component
{
  function save_partner_step3($user_id, $category_id, $modelStep3)
  {

 
    //Intialization
    //methode de sauvgarde de tous ces données 
    $produit_nom = $modelStep3->produit_nom;
    $produit_option = $modelStep3->produit_option;
    $produit_description = $modelStep3->description;
    $produit_description1 = $modelStep3->description1;
    $services = json_encode($modelStep3->services);
    $services_facilities = $modelStep3->services_F;
    $services_possiblity = $modelStep3->extra_p;
    $services_transport = $modelStep3->extra_t;
    $address_room_rental = $modelStep3->adress_roomRental;
    $produit_l_produit_option = "xxx";
    $produit_l_produit_type = "xxx";
    $produit_price_day = 0.0;
    $produit_price_night =  0.0;
    //Partie de l'image Upload RoomRental Multiple 
    $expression = new Expression('NOW()');
    $now = (new \yii\db\Query)->select($expression)->scalar();  // SELECT NOW()
    $timestamp = strtotime($now);
    $length = sizeof($_FILES['ServicesAndPriceForm']["tmp_name"]["imageFile"]);


    for ($k = 0; $k < $length; $k++) {
      $e =  $_FILES['ServicesAndPriceForm']["name"]["imageFile"][$k];
      $type = $_FILES['ServicesAndPriceForm']["type"]["imageFile"][$k];
      $name = $_FILES['ServicesAndPriceForm']["tmp_name"]["imageFile"][$k];
      $extension = explode(".", $e);

      $array_image[] = 'products' . $modelStep3->produit_description . $k . $timestamp . '.' . $extension[1];
      $extension = explode(".", $e);
      $image = 'products' . $modelStep3->produit_description  . $k . $timestamp . '.' . $extension[1];

      $target = 'img/products/' . basename($image);
      if (move_uploaded_file($name, $target)) {
        $fp = fopen($target, "r");
      }
    }
    //Getting Information
    $images = json_encode($array_image, true);
    $modelStep3->imageFile = (string) $images;
    $produit_image = $modelStep3->imageFile;
    $produit_image_Name = $modelStep3->imageFile;
    $produit_nombre_de_perssone = $modelStep3->nombre_de_persson;
    $produit_nombre_de_equipement = $modelStep3->nombre_de_equipement;
    $min_consomation = $modelStep3->min_consomation;
    //price
    $produit_price =  0.01;
    $produit_prix_heure = $modelStep3->prix_heure;
    $services = json_encode($modelStep3->services);
    $services_facilities = $modelStep3->services_F;
    $services_possiblity = $modelStep3->extra_p;
    $services_transport = $modelStep3->extra_t;
    $address_room_rental = $modelStep3->adress_roomRental;
    $desriptionRoom = $modelStep3->desriptionRoom;

    $CompanyName = $modelStep3->CompanyName;
    //

    $partner_id_s = Partner::find()->andwhere(['user_id' => $user_id])->one();
    $productParent = new ProductParent();
    $productParent->partner_category = 1;
    $productParent->partner_id = $partner_id_s->id;
    $productParent->name = $CompanyName;
    $productParent->kind_of_food = "xxxx";
    $productParent->min = "xxxx";
    $productParent->description = $desriptionRoom;
    $productParent->extra = $services;

    //partie currencies
    $currencies_symbol = "$";
    $geoip = new \lysenkobv\GeoIP\GeoIP();
    $ip = $geoip->ip(Yii::$app->request->getUserIP()); // current user ip
    $currencies = json_decode(file_get_contents('data.json'), true);
    foreach ($currencies as $currency) {
      if (strtoupper($currency['country']) == strtoupper($ip->isoCode)) {
        $currencies_symbol = $currency['currency'];
      }
    }
    if (empty($currencies_symbol))
      $currencies_symbol = "$";
    $productParent->currencies_symbol = '0';
    $productParent->picutre = "e";
    $productParent->min = "0";
    if (empty($services))
      $productParent->extra = "0";

    if ($productParent->save()) {
    } else {

      print_r($productParent->getErrors());
      exit;
    }
    $session = Yii::$app->session;
    $session->open();
    $session->set('currencies', $currencies);
    $msg = array();
    //we will construct array for type room_rental
    $array_type_room_rental = array();
    //affecter le type des champre au tableau message qui sera affecter dans la notifivation
    if (is_null($array_type_room_rental))
      $msg['type'] = "empty";
    else
      $msg['type'] = $array_type_room_rental;
    //first saving the option of the produtct

    //creating a json array of product_option
    //
    $product_option_array = array();
    //$product_option_array['id']=$produit_price_day;
    //$product_option_array['product_name']=$produit_price_day;
    if (is_null($produit_price_day))
      $produit_price_day = "empty";
    if (is_null($produit_price_night))
      $produit_price_night = "empty";
    $product_option_array['price_day'] = $produit_price_day;
    $product_option_array['price_night'] = $produit_price_night;
    //for product options

    //if existing languages adding them to the array

    $partenaire_category_model = PartnerCategory::find()->where(['id' => $category_id])->one();
    $product_model = new ProductItem();
    $expression = new Expression('NOW()');
    $now = (new \yii\db\Query)->select($expression)->scalar();
    $product_model->partner_category = $partenaire_category_model->id;
    //$product_model->name=$produit_description;
    //$product_model->description="room_rental";
    $product_model->name = $produit_description;
    $product_model->temp = json_encode($produit_nom, true);
    $product_model->description = json_encode($produit_option, true);
    $product_model->picture = $produit_image_Name;

    $product_model->price = $modelStep3->price;
    $product_model->currencies_symbol = $currencies_symbol;
    $product_model->people_number = 0;
    if ( $category_id == 1)
      $product_model->people_number = $produit_nombre_de_perssone;
    $product_model->quantity = $produit_nombre_de_equipement;
    $product_model->periode = 0;


    $product_model->product_type = 'vide';
    // $product_model->product_option_id="xxx";

    $product_model->number_of_agent = 0;
    $product_model->product_id = $productParent->id;
    //we construct a json for address_room_rental 
    $address_room_rental_cordinates = array();
    $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();

    //$address_room_rental = $address_room_rental . ',' . $partner->city . ',' . $partner->postal_code . ',' . $partner->country;
    $address_room_rental = $address_room_rental;
    $Cordinates = $address_room_rental;
    $address_room_rental_cordinates["address"] = $address_room_rental;
    // Geocoding API request with end address
    $apiKey = 'AIzaSyCTGpqrJDrULNO0PNch-b8vlmcwwGt7D2c';
    $formattedAddrTo     = str_replace(' ', '+', $address_room_rental);

    $product_model->languages = 'empty';
    //we construct the array that will be stored in the checkbox
    $informationConcerningRoom=array();
    $ouvertureFermuture=array();
    $ouvertureFermutureAll=array();
   
    $periodeNameIndex=['From','To','Banquet \ Dinner','Cinema','Cocktail','Conference','Meeting','Theater'];
    $index=0;


    $product_model->checkbox = json_encode($informationConcerningRoom,true);
    $product_model->price =$modelStep3->price ;


    // $product_model->partner_id=$partenaire_model->id;
    //$product_model->extra=$services;
    $product_model->status = 1;
    $expression = new Expression('NOW()');
    $now = (new \yii\db\Query)->select($expression)->scalar();  // SELECT NOW()
    $timestamp = strtotime($now);

    //la partie de msg faire vos teste
    if (is_null($product_model->price))
      $product_model->price = 0.12;
    if (is_null($product_model->people_number))
      $product_model->people_number = "empty";
    if (is_null($product_model->quantity))
      $product_model->quantity = 1;
    if (is_null($product_model->periode))
      $product_model->periode = "empty";


    if (is_null($product_model->status))
      $product_model->status = 1;

    $msg['partner_category'] = $product_model->partner_category;
    $msg['name'] = $product_model->name;
    $msg['description'] = $product_model->description;
    $msg['picture'] = $product_model->picture;
    $msg['price'] = 0.0;
    $msg['people_number'] = $product_model->people_number;
    $msg['quantity'] = $product_model->quantity;
    $msg['periode'] = $product_model->periode;
    $msg['product_type_id'] = "xxx";
    $msg['product_option_id'] = "xxxx";
    $msg['condition'] = "xxxx";
    $msg['availability'] = "xxx";
    $msg['partner_id'] = "xxx";
    $msg['extra'] = $services;
    $msg['status'] = $product_model->status;
    $msg['created_at'] = "xx";
    $msg['updated_at'] = "xx";

    if ($product_model->save()) {
      
    } else {
      echo "Fail save Step3";
      print_r($product_model->getAttributes());
      print_r($product_model->getErrors());
      exit;
    }


    return ($msg);
  }
}
