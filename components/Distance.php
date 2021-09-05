<?php

namespace app\components;

use app\models\ProductParent;
use app\models\ProductItem;


//i need to define my model here

class Distance
{
    public $apiKey;


    public function __construct()
    {
        $this->apiKey = 'AIzaSyCTGpqrJDrULNO0PNch-b8vlmcwwGt7D2c';
    }
    function getDistance1($addressFrom, $addressTo, $unit = '')
    {
        $counter = 0;

        $formattedAddrTo     = $addressTo;
        $array_partner_filtered_by_address = array();
        // Geocoding API request with end address
        $formattedAddrTo     = str_replace(' ', '+', $addressTo);
        $geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $formattedAddrTo . '&sensor=false&key=' . $this->apiKey);
        $outputTo = json_decode($geocodeTo);
        if (!empty($outputTo->error_message)) {
            return $outputTo->error_message;
        }
        $latitudeTo        = $outputTo->results[0]->geometry->location->lat;
        $longitudeTo    = $outputTo->results[0]->geometry->location->lng;

        foreach ($addressFrom as $address) {
            //recupere tous les produit parent d'un partner

            $product_parent = ProductParent::find()
                ->andWhere(['partner_id' => $address['id']])
                ->andWhere(['partner_category' => 1])
                ->all();


            $product_parent_id = array();
            foreach ($product_parent as $p) {

                $product_parent_id[] = $p->id;
            }

            if (!empty($product_parent_id)) {


                //partie produit items
                $ProductItems = ProductItem::find()
                    ->andWhere(['product_id' => $product_parent_id])
                    ->andWhere(['partner_category' => 1])
                    ->all();

                foreach ($ProductItems as $item) {
                    if (is_array(json_decode($item->languages, true))) {

                        $cordinates = json_decode($item->languages, true);

                        // Get latitude and longitude from the geodata
                        $latitudeFrom    = $cordinates['lantitude'];
                        $longitudeFrom    = $cordinates['latitude'];

                        // Calculate distance between latitude and longitude
                        $theta    = $longitudeFrom - $longitudeTo;

                        $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
                        $dist    = acos($dist);
                        $dist    = rad2deg($dist);

                        $miles    = $dist * 60 * 1.1515;

                        // Convert unit and return distance
                        $unit = strtoupper($unit);
                        $distance = round($miles *  1.609344, 2);
                        $distance = (float)$distance;

                        if (is_nan($distance)) {
                            $distance = 0;
                        }
                        if ($distance < 100) {

                            $array_partner_filtered_by_address[$counter]['partner_id'] = $address['id'];
                            $array_partner_filtered_by_address[$counter]['distance'] = $distance;
                            $array_partner_filtered_by_address[$counter]['product_item_id'] = $item->id;
                            $array_partner_filtered_by_address[$counter]['product_id'] = $product_parent_id;
                            $array_partner_filtered_by_address[$counter]['price'] = 0;
                            $counter++;
                        } /*else {
                            $array_partner_filtered_by_address[$counter]['partner_id'] = -1;
                            $array_partner_filtered_by_address[$counter]['distance'] = 0;
                            $array_partner_filtered_by_address[$counter]['product_item_id'] = 0;
                            $array_partner_filtered_by_address[$counter]['product_id'] = [];
                            $array_partner_filtered_by_address[$counter]['price'] = 0;
                            $counter++;
                        }*/
                    }
                }
            }
        }

        return $array_partner_filtered_by_address;
    }
    function getDistance4($addressFrom, $addressTo, $unit = '')
    {
        $counter = 0;
        $price = 0;
        $formattedAddrTo     = str_replace(' ', '+', $addressTo);

        // Geocoding API request with end address
        $geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $formattedAddrTo . '&sensor=false&key=' . $this->apiKey);
        $outputTo = json_decode($geocodeTo);
        if (!empty($outputTo->error_message)) {
            return $outputTo->error_message;
        }
        $latitudeTo        = $outputTo->results[0]->geometry->location->lat;
        $longitudeTo    = $outputTo->results[0]->geometry->location->lng;
        foreach ($addressFrom as $address) {
            $array_partner_filtered_by_address = array();
            if ($address['latitude'] != 0) {
                $product_parent = ProductParent::find()
                    ->andwhere(['partner_id' => $address['id']])
                    ->all();

                foreach ($product_parent as $p) {

                    $product_parent_id[] = $p->id;
                }
                // Get latitude and longitude from the geodata
                $latitudeFrom    = $address['latitude'];
                $longitudeFrom    = $address['longitude'];
                // Calculate distance between latitude and longitude
                $theta    = $longitudeFrom - $longitudeTo;
                $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
                $dist    = acos($dist);
                $dist    = rad2deg($dist);
                $miles    = $dist * 60 * 1.1515;
                // Convert unit and return distance
                $unit = strtoupper($unit);
                $distance = round($miles * 1.609344, 2);
                $distance = (float)$distance;
                if ($distance < 100) {
                    $array_partner_filtered_by_address[] = $address['id'];
                    $array_partner_filtered_by_address[$counter]['distance'] = $distance;
                    $array_partner_filtered_by_address[$counter]['product_id'] = $product_parent_id;
                    if ($distance >= 0 && $distance < 30) {
                        $array_partner_filtered_by_address[$counter]['price'] = $price;
                    }
                    if ($distance >= 5 && $distance < 10) {
                        $array_partner_filtered_by_address[$counter]['price'] = $price + 5;
                    }
                    if ($distance >= 10 && $distance < 15) {
                        $array_partner_filtered_by_address[$counter]['price'] = $price + 10;
                    }
                    if ($distance >= 15 && $distance < 20) {
                        $array_partner_filtered_by_address[$counter]['price'] = $price + 20;
                    }
                    if ($distance > 20) {
                        $array_partner_filtered_by_address[$counter]['price'] = $price + 50;
                    }
                }
                $counter++;
            }
        }
        return $array_partner_filtered_by_address;
    }
    function getDistance2($addressFrom, $addressTo, $unit = '')
    {

        // Google API key
        $counter = 0;
        $apiKey = 'AIzaSyB7Iz5ZKGr0_5l_LD47xNf9umU7GSiUVuw';
        // Change address format
        $formattedAddrTo     = str_replace(' ', '+', $addressTo);
        $array_partner_filtered_by_address = array();

        // Geocoding API request with end address
        $geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $formattedAddrTo . '&sensor=false&key=' . $this->apiKey);
        $outputTo = json_decode($geocodeTo);
        if (!empty($outputTo->error_message)) {
            return $outputTo->error_message;
        }
        $latitudeTo        = $outputTo->results[0]->geometry->location->lat;
        $longitudeTo    = $outputTo->results[0]->geometry->location->lng;
        $c = 0;
        foreach ($addressFrom as $address) {

            $product_parent_id = array();
            $distance_array = array();
            if ($address['latitude'] != 0) {

                $DeliveryAndDeplacement = json_decode($address['DeliveryAndDeplacement'], true);
                $product_parent = ProductParent::find()
                    ->andwhere(['partner_id' => $address['id']])
                    ->all();

                foreach ($product_parent as $p) {

                    $product_parent_id[] = $p->id;
                }


                $latitudeFrom    =  $address['latitude'];
                $longitudeFrom    = $address['longitude'];

                // Calculate distance between latitude and longitude
                $theta    = $longitudeFrom - $longitudeTo;
                $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
                $dist    = acos($dist);
                $dist    = rad2deg($dist);
                $miles    = $dist * 60 * 1.1515;

                // Convert unit and return distance
                $unit = strtoupper($unit);

                $distance = round($miles * 1.609344, 2);
                // here i think how i can modify on the stucture of the distance each time i save on it



                $distance = (float)$distance;
                $Cordinate["distance"] = $distance;
                $price = 0;
                //  $distance_array[] = $distance;


                if ($distance <= 100) {

                    // if ($this->isNewDistanceSmallerThanTheOther($distance, $distance_array)) {
                    $array_partner_filtered_by_address[$counter]['partner_id'] = [];
                    $array_partner_filtered_by_address[$counter]['partner_id'] = $address['id'];
                    $array_partner_filtered_by_address[$counter]['distance'] = $distance;
                    $array_partner_filtered_by_address[$counter]['product_id'] = $product_parent_id;

                    if ($distance >= 0 && $distance < 30) {
                        if (!empty($DeliveryAndDeplacement[0]['Price']))
                            $array_partner_filtered_by_address[$counter]['price'] = $price + $DeliveryAndDeplacement[0]['Price'];
                        else
                            $array_partner_filtered_by_address[$counter]['price'] = $price;
                    }
                    if ($distance >= 30 && $distance < 60) {
                        if (!empty($DeliveryAndDeplacement[1]['Price']))
                            $array_partner_filtered_by_address[$counter]['price'] = $price + $DeliveryAndDeplacement[1]['Price'];
                        else
                            $array_partner_filtered_by_address[$counter]['price'] = $price;
                    }
                    if ($distance >= 60 && $distance < 100) {
                        if (!empty($DeliveryAndDeplacement[2]['Price']))
                            $array_partner_filtered_by_address[$counter]['price'] = $price + $DeliveryAndDeplacement[2]['Price'];
                        else
                            $array_partner_filtered_by_address[$counter]['price'] = $price;
                    }

                    // }


                    $counter++;
                }
            }
        }
        return $array_partner_filtered_by_address;
    }
    public function isNewDistanceSmallerThanTheOther($element, $array)
    {
        foreach ($array as $subElement) {
            if ($element > $subElement)
                return false;
        }
        return true;
    }
}
