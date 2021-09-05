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
    print_r($modelStep3->extra_p);
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
    //for the room rental
    $produit_l_area = $modelStep3->area;
    $produit_l_caution = 0.0;
    $produit_l_event_cake = $modelStep3->event_cake;
    $produit_l_drink = $modelStep3->drink;
    $produit_l_External_food = $modelStep3->External_food;
    $produit_l_External_Catering = $modelStep3->External_Catering;
    $produit_l_Internal_Catering = $modelStep3->Internal_Catering;
    $produit_l_Without_guarantee = $modelStep3->Without_guarantee;
    $produit_l_Minimum_consumption_Price = $modelStep3->Minimum_consumption_Price;
    $produit_l_Wifi = $modelStep3->Wifi;
    $produit_l_Board = $modelStep3->Board;
    $produit_l_Video_projector = $modelStep3->Video_projector;
    $produit_l_System_Sound = $modelStep3->System_Sound;
    $produit_l_Micro = $modelStep3->Micro;
    $produit_l_To_bring_back_cake_of_the_event = $modelStep3->To_bring_back_cake_of_the_event;
    $produit_l_To_bring_back_drinks = $modelStep3->To_bring_back_drinks;
    $produit_l_Parking_lot = $modelStep3->Parking_lot;
    $produit_l_Parking_lot_field = $modelStep3->Parking_lot_field;
    $produit_l_Subway = $modelStep3->Subway;
    $produit_l_Subway_field = $modelStep3->Subway_field;
    $produit_l_Train = $modelStep3->Train;
    $produit_l_Train_field = $modelStep3->Train_field;
    $produit_l_Bus = $modelStep3->Bus;
    $produit_l_Bus_field = $modelStep3->Bus_field;
    $produit_type = $modelStep3->produit_type;
    //min consomation
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
    //Space for Rent and Type of Room and Are in m2 and some question
    //here construct the array of room_rental
    //$array_type_room_rental["."]
    if (is_null($produit_l_area))
      /*conditions*/
      if (is_null($produit_l_area)) $produit_l_area = "empty";
    if (is_null($produit_l_caution)) $produit_l_caution = "empty";
    if (is_null($produit_l_produit_option)) $produit_l_produit_option = "empty";
    if (is_null($produit_l_produit_type)) $produit_l_produit_type = "empty";
    if (is_null($produit_l_event_cake)) $produit_l_event_cake = "empty";
    if (is_null($produit_l_drink)) $produit_l_drink = "empty";
    if (is_null($produit_l_External_food)) $produit_l_External_food = "empty";
    if (is_null($produit_l_External_Catering)) $produit_l_External_Catering = "empty";
    if (is_null($produit_l_Internal_Catering)) $produit_l_Internal_Catering = "empty";
    if (is_null($produit_l_Without_guarantee)) $produit_l_Without_guarantee = "empty";
    if (is_null($produit_l_Minimum_consumption_Price)) $produit_l_Minimum_consumption_Price = "empty";
    if (is_null($produit_l_Wifi)) $produit_l_Wifi = "empty";
    if (is_null($produit_l_Board)) $produit_l_Board = "empty";
    if (is_null($produit_l_Video_projector)) $produit_l_Video_projector = "empty";
    if (is_null($produit_l_System_Sound)) $produit_l_System_Sound = "empty";
    if (is_null($produit_l_Micro)) $produit_l_Micro = "empty";
    if (is_null($produit_l_To_bring_back_cake_of_the_event)) $produit_l_To_bring_back_cake_of_the_event = "empty";
    if (is_null($produit_l_To_bring_back_drinks)) $produit_l_To_bring_back_drinks = "empty";
    if (is_null($produit_l_Parking_lot)) $produit_l_Parking_lot = "empty";
    if (is_null($produit_l_Parking_lot_field)) $produit_l_Parking_lot_field = "empty";
    if (is_null($produit_l_Subway)) $produit_l_Subway = "empty";
    if (is_null($produit_l_Subway_field)) $produit_l_Subway_field = "empty";
    if (is_null($produit_l_Train)) $produit_l_Train = "empty";
    if (is_null($produit_l_Train_field)) $produit_l_Train_field = "empty";
    if (is_null($produit_l_Bus)) $produit_l_Bus = "empty";
    if (is_null($produit_l_Bus_field)) $produit_l_Bus_field = "empty";
    //////////////////////////////////////////////////////////////////////////
    $array_type_room_rental[0]["area"] = $produit_l_area;
    $array_type_room_rental[0]["caution"] = 0;
    $array_type_room_rental[0]["produit_option"] = $produit_l_produit_option;
    $array_type_room_rental[0]["produit_type"] = $produit_l_produit_type;
    $array_type_room_rental[0]["event_cake"] = $produit_l_event_cake;
    $array_type_room_rental[0]["drink"] = $produit_l_drink;
    $array_type_room_rental[0]["External_food"] = $produit_l_External_food;
    $array_type_room_rental[0]["External_Catering"] = $produit_l_External_Catering;
    $array_type_room_rental[0]["Internal_Catering"] = $produit_l_Internal_Catering;
    $array_type_room_rental[0]["Without_guarantee"] = $produit_l_Without_guarantee;
    $array_type_room_rental[0]["Minimum_consumption_Price"] = $produit_l_Minimum_consumption_Price;
    $array_type_room_rental[0]["Wifi"] = $produit_l_Wifi;
    $array_type_room_rental[0]["Board"] = $produit_l_Board;
    $array_type_room_rental[0]["System_Sound"] = $produit_l_System_Sound;
    $array_type_room_rental[0]["Video_projector"] = $produit_l_System_Sound;
    //services facilities extra

    $array_type_room_rental[0][0]["services_facilities"]['name'] = $services_facilities[0]['Description'];
    $array_type_room_rental[0][1]["services_facilities"]['name'] = $services_facilities[1]['Description'];
    $array_type_room_rental[0][2]["services_facilities"]['name'] = $services_facilities[2]['Description'];
    $array_type_room_rental[0][3]["services_facilities"]['name'] = $services_facilities[3]['Description'];
    $array_type_room_rental[0][4]["services_facilities"]['name'] = $services_facilities[0]['Description2'];
    $array_type_room_rental[0][5]["services_facilities"]['name'] = $services_facilities[1]['Description2'];
    $array_type_room_rental[0][6]["services_facilities"]['name'] = $services_facilities[2]['Description2'];
    $array_type_room_rental[0][7]["services_facilities"]['name'] = $services_facilities[3]['Description2'];

    $array_type_room_rental[0]["Micro"] = $produit_l_Micro;
    /*  $array_type_room_rental[0]["To_bring_back_cake_of_the_event"]=$produit_l_To_bring_back_cake_of_the_event;
          $array_type_room_rental[0]["To_bring_back_drinks"]=$produit_l_To_bring_back_drinks;
//services possibility check extra
         */
    $array_type_room_rental[0][0]["services_possiblity"]['Possibility_check_name'] = $services_possiblity[0]['Possibility_check_name'];
    $array_type_room_rental[0][1]["services_possiblity"]['Possibility_check_name'] = $services_possiblity[1]['Possibility_check_name'];
    $array_type_room_rental[0][2]["services_possiblity"]['Possibility_check_name'] = $services_possiblity[2]['Possibility_check_name'];
    $array_type_room_rental[0][3]["services_possiblity"]['Possibility_check_name'] = $services_possiblity[3]['Possibility_check_name'];;
    $array_type_room_rental[0][4]["services_possiblity"]['Possibility_check_name'] = $services_possiblity[0]['Possibility_check_name2'];
    $array_type_room_rental[0][5]["services_possiblity"]['Possibility_check_name'] = $services_possiblity[1]['Possibility_check_name2'];
    $array_type_room_rental[0][6]["services_possiblity"]['Possibility_check_name'] = $services_possiblity[2]['Possibility_check_name2'];
    $array_type_room_rental[0][7]["services_possiblity"]['Possibility_check_name'] = $services_possiblity[3]['Possibility_check_name2'];;
    //check box transport
    $array_type_room_rental[0]["Parking_lot"]["name"] = $produit_l_Parking_lot;
    $array_type_room_rental[0]["Parking_lot"]["field"] = $produit_l_Parking_lot_field;
    $array_type_room_rental[0]["Subway"]["name"] = $produit_l_Subway;
    $array_type_room_rental[0]["Subway"]["field"] = $produit_l_Subway_field;
    $array_type_room_rental[0]["Train"]["name"] = $produit_l_Train;
    $array_type_room_rental[0]["Train"]["field"] = $produit_l_Train_field;
    $array_type_room_rental[0]["Bus"]["name"] = $produit_l_Bus;
    $array_type_room_rental[0]["Bus"]["field"] = $produit_l_Bus_field;
    //services transport extra
    $array_type_room_rental[0][0]["services_transport"]['Transportation_name'] = $services_transport[0]['Transportation_name'];
    $array_type_room_rental[0][0]["services_transport"]['route number'] = $services_transport[0]['route number'];
    $array_type_room_rental[0][1]["services_transport"]['Transportation_name'] = $services_transport[1]['Transportation_name'];
    $array_type_room_rental[0][1]["services_transport"]['route number'] = $services_transport[1]['route number'];
    $array_type_room_rental[0][2]["services_transport"]['Transportation_name'] = $services_transport[2]['Transportation_name'];
    $array_type_room_rental[0][2]["services_transport"]['route number'] = $services_transport[2]['route number'];
    $array_type_room_rental[0][3]["services_transport"]['Transportation_name'] = $services_transport[3]['Transportation_name'];
    $array_type_room_rental[0][3]["services_transport"]['route number'] = $services_transport[3]['route number'];
    $array_type_room_rental[0][4]["services_transport"]['Transportation_name'] = $services_transport[4]['Transportation_name'];
    $array_type_room_rental[0][4]["services_transport"]['route number'] = $services_transport[4]['route number'];
    $array_type_room_rental[0][5]["services_transport"]['Transportation_name'] = $services_transport[5]['Transportation_name'];
    $array_type_room_rental[0][5]["services_transport"]['route number'] = $services_transport[5]['route number'];
    $array_type_room_rental[0][6]["services_transport"]['Transportation_name'] = $services_transport[6]['Transportation_name'];
    $array_type_room_rental[0][6]["services_transport"]['route number'] = $services_transport[6]['route number'];
    $array_type_room_rental[0][7]["services_transport"]['Transportation_name'] = $services_transport[7]['Transportation_name'];
    $array_type_room_rental[0][7]["services_transport"]['route number'] = $services_transport[7]['route number'];

    $array_type_room_rental = json_encode($array_type_room_rental, true);

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

    $product_model->price = 0.12;
    $product_model->currencies_symbol = $currencies_symbol;
    $product_model->people_number = 0;
    if ($category_id == 5 || $category_id == 2 || $category_id == 1)
      $product_model->people_number = $produit_nombre_de_perssone;
    $product_model->quantity = $produit_nombre_de_equipement;
    $product_model->periode = 0;


    $product_model->product_type = $array_type_room_rental;
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
    $geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $formattedAddrTo . '&sensor=false&key=' . $apiKey);
    $outputTo = json_decode($geocodeTo);
    $json = json_decode($geocodeTo);
    //partie country and full address

    foreach ($json->results as $result) {
      foreach ($result->address_components as $addressPart) {
        if ((in_array('locality', $addressPart->types)) && (in_array('political', $addressPart->types)))
          $city = $addressPart->long_name;
        else if ((in_array('administrative_area_level_1', $addressPart->types)) && (in_array('political', $addressPart->types)))
          $state = $addressPart->long_name;
        else if ((in_array('country', $addressPart->types)) && (in_array('political', $addressPart->types)))
          $country = $addressPart->long_name;
      }
    }
    if (($city != '') && ($state != '') && ($country != ''))
      $address = $city . ', ' . $state . ', ' . $country;
    else if (($city != '') && ($state != ''))
      $address = $city . ', ' . $state;
    else if (($state != '') && ($country != ''))
      $address = $state . ', ' . $country;
    else if ($country != '')
      $address = $country;
    $address_room_rental_cordinates = array();
    $address_room_rental_cordinates["address"] = $address;
    $address_room_rental_cordinates["lantitude"]       = $outputTo->results[0]->geometry->location->lat;
    $address_room_rental_cordinates["latitude"]    = $outputTo->results[0]->geometry->location->lng;
    $address_room_rental_cordinates = json_encode($address_room_rental_cordinates,  JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    //
    $product_model->languages = $address_room_rental_cordinates;
    //we construct the array that will be stored in the checkbox
    $informationConcerningRoom=array();
    $ouvertureFermuture=array();
    $ouvertureFermutureAll=array();
    $periodeValueIndex=['period1','period2','period3','period4','period5','period6'];
    $periodeNameIndex=['From','To','Banquet \ Dinner','Cinema','Cocktail','Conference','Meeting','Theater'];
    $index=0;
    $informationConcerningRoom[0]=$modelStep3->minRentalPeriode;
    $informationConcerningRoom[1]=$modelStep3->maxRentalPeriode;
    $informationConcerningRoom[2]=$modelStep3->minNumberGuest;
    $informationConcerningRoom[3]=$modelStep3->maxSeats;
    $informationConcerningRoom[4]=json_encode($modelStep3->closedDay,true);
    $informationConcerningRoom[5]=$modelStep3->weekendSurcharge;
    $informationConcerningRoom[6]=$modelStep3->deposit;
    $informationConcerningRoom[7]=$modelStep3->advancePayment;
    //I need to do cleansing of the overtureFermuture json array
    $ouverture=$modelStep3->ouvertureFermuture;
    $dayIncrement=true;
    for($i=0;$i<6;$i++){
      for($j=1;$j<=8;$j++){
        //cleansing of the date two cases
        if($ouverture[$j-1][$periodeValueIndex[$i]]){
        
          if(strlen($ouverture[$j-1][$periodeValueIndex[$i]])==3 && $j-1==0 ){
            
            $ouverture[$j-1][$periodeValueIndex[$i]] = $ouverture[$j-1][$periodeValueIndex[$i]][0] . ":" . substr($ouverture[$j-1][$periodeValueIndex[$i]], 1)."AM";
            if($dayIncrement==false){
              $datetime = date("g:iA", strtotime($ouverture[$j-1][$periodeValueIndex[$i]] ));
              $datetime = new \DateTime($datetime);
              $datetime->modify('+1 day');
              $ouverture[$j-1][$periodeValueIndex[$i]]  = $datetime->format('H:i:s');
            
            }else{
              $ouverture[$j-1][$periodeValueIndex[$i]]  = date("g:iA", strtotime($ouverture[$j-1][$periodeValueIndex[$i]] ));
            }
          }
          if(strlen($ouverture[$j-1][$periodeValueIndex[$i]])==4 && $j-1==0)
          {
            $twodigitime=substr($ouverture[$j-1][$periodeValueIndex[$i]],0,2);
            $twodigitime=(int)$twodigitime;
  
            if($twodigitime>=13 && $dayIncrement)
               $dayIncrement=false;
            
            if($dayIncrement==false && $twodigitime<13){
          
            $datetime = date("g:iA", strtotime($ouverture[$j-1][$periodeValueIndex[$i]] ));
            $datetime = new \DateTime($datetime);
            $datetime->modify('+1 day');
            $ouverture[$j-1][$periodeValueIndex[$i]]  = $datetime->format('H:i:s');
            $ouverture[$j-1][$periodeValueIndex[$i]].="AM";
            }
            if($dayIncrement==true && $twodigitime>=13){
              $ouverture[$j-1][$periodeValueIndex[$i]] = substr($ouverture[$j-1][$periodeValueIndex[$i]],0,2) . ":" . substr($ouverture[$j-1][$periodeValueIndex[$i]], 2);
              $ouverture[$j-1][$periodeValueIndex[$i]]  = date("g:iA", strtotime($ouverture[$j-1][$periodeValueIndex[$i]] ));
            }
            if($twodigitime>=13){
            $ouverture[$j-1][$periodeValueIndex[$i]] = substr($ouverture[$j-1][$periodeValueIndex[$i]],0,2) . ":" . substr($ouverture[$j-1][$periodeValueIndex[$i]], 2);
            $ouverture[$j-1][$periodeValueIndex[$i]] =date("g:iA", strtotime($ouverture[$j-1][$periodeValueIndex[$i]] ));
            }
           
          }
        }
        if($j<8)
        if($ouverture[$j][$periodeValueIndex[$i]] ){
          if(strlen($ouverture[$j][$periodeValueIndex[$i]])==3 && $j==1){
          
            $ouverture[$j][$periodeValueIndex[$i]] = $ouverture[$j][$periodeValueIndex[$i]][0]. ":" . substr($ouverture[$j][$periodeValueIndex[$i]], 1)."AM";
            if($dayIncrement==false){
              $datetime = date("g:iA", strtotime($ouverture[$j][$periodeValueIndex[$i]]  ));
              $datetime = new \DateTime($datetime);
              $datetime->modify('+1 day');
              $ouverture[$j][$periodeValueIndex[$i]]  = $datetime->format('H:i:s');
              $ouverture[$j][$periodeValueIndex[$i]].="AM";
        
            }else{
              $ouverture[$j][$periodeValueIndex[$i]]  = date("g:iA", strtotime($ouverture[$j-1][$periodeValueIndex[$i]] ));
            }
           // echo $datetime->format('Y-m-d H:i:s');
           // die();
         
          }
          if(strlen($ouverture[$j][$periodeValueIndex[$i]])==4 && $j==1)
          {
            if($dayIncrement==true)
              $dayIncrement=false;

            $ouverture[$j][$periodeValueIndex[$i]] = substr($ouverture[$j][$periodeValueIndex[$i]],0,2) . ":" . substr($ouverture[$j][$periodeValueIndex[$i]], 2);
            $ouverture[$j][$periodeValueIndex[$i]] =date("g:iA", strtotime($ouverture[$j][$periodeValueIndex[$i]] ));
          }

        }
        $ouvertureFermuture[$periodeNameIndex[$j-1]]=$ouverture[$j-1][$periodeValueIndex[$i]];
      }
      $ouvertureFermutureAll[]=$ouvertureFermuture;
      $ouvertureFermuture=array();
     
    } 
 

   /* echo "<pre>"; 
    echo json_encode($ouvertureFermuture, JSON_PRETTY_PRINT);
    echo "</pre>"; */
    //die();
    $informationConcerningRoom[8]=$ouvertureFermutureAll;
    $informationConcerningRoom[9]=$modelStep3->fullDay;

    $product_model->checkbox = json_encode($informationConcerningRoom,true);
    $product_model->min_price = 0.0;


    // $product_model->partner_id=$partenaire_model->id;
    //$product_model->extra=$services;
    $product_model->status = 0;
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
      $product_model->status = 0;

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
    // the max of auto inctrement
    $isok = true;




    if ($product_model->save()) {
      echo "sauvgarde";
      //  echo   $product_model->id."nex id";
      // echo "sucess saving step3";
    } else {
      echo "Fail save Step3";
      print_r($product_model->getAttributes());
      print_r($product_model->getErrors());
      exit;
    }


    return ($msg);
  }
}
