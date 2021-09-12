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

        $array_partner_filtered_by_address = array();

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
                            $array_partner_filtered_by_address[$counter]['partner_id'] = $address['id'];
                            $array_partner_filtered_by_address[$counter]['distance'] = $distance;
                            $array_partner_filtered_by_address[$counter]['product_item_id'] = $item->id;
                            $array_partner_filtered_by_address[$counter]['product_id'] = $product_parent_id;
                            $array_partner_filtered_by_address[$counter]['price'] = 0;
                            $counter++;


                }
            }
        }

        return $array_partner_filtered_by_address;
    }
    function getDistance2($addressFrom, $addressTo, $unit = '')
    {

        $counter = 0;

        $array_partner_filtered_by_address = array();


        foreach ($addressFrom as $address) {
            //recupere tous les produit parent d'un partner
            $product_parent = ProductParent::find()
                ->andWhere(['partner_id' => $address['id']])
                ->all();

            $product_parent_id = array();
            foreach ($product_parent as $p) {
                $product_parent_id[] = $p->id;
            }
        
            if (!empty($product_parent_id)) {

                //partie produit items
                $ProductItems = ProductItem::find()
                    ->andWhere(['product_id' => $product_parent_id])
                    ->all();

                foreach ($ProductItems as $item) {
                    $array_partner_filtered_by_address[$counter]['partner_id'] = $address['id'];
                    $array_partner_filtered_by_address[$counter]['distance'] = 0;
                    $array_partner_filtered_by_address[$counter]['product_item_id'] = $item->id;
                    $array_partner_filtered_by_address[$counter]['product_id'] = $product_parent_id;
                    $array_partner_filtered_by_address[$counter]['price'] = 0;
                    $counter++;


                }
            }


        }



        return $array_partner_filtered_by_address;
    }

}
