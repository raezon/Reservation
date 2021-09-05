<?php

namespace app\modules\api\controllers;

use app\models\ProductItem;
use app\models\ProductParent;

class BillController extends \yii\web\Controller
{
    public function actionIndex($id, $qte)
    {
        $query = ProductItem::find()
            ->where(['id' => $id])
            ->all();
        //getting the price 
        $productObj = array();
        
        $category= $query[0]->partner_category;
        $people_number= $query[0]->people_number;
        $price=$query[0]->price;
       
        if($category != 3 || $category !=1 ){
            $intialPrice =$price ;
          }
        //no regles de calcul
        if ($category == 1) {
         
              $intialPrice =  $query[0]->totalPrice($query[0]->description, $query[0]->partner_category, $query[0]->price, $query[0]->quantity, $_SESSION['nbr_persson'], $query[0]->people_number,$query[0]->checkbox, $_SESSION['subcategory']);
            
          } if ($category == 3) {
            
            $intialPrice =(float)$price *round($_SESSION['nbr_persson'] / (int)$people_number);
              
          }
          //echo $intialPrice/$qte;
          $productObj['price'] = $intialPrice;
          $productObj['intialPrice'] = $intialPrice/$qte;
        echo json_encode($productObj);
    }
    public function actionExtra($id)
    {
        $model = ProductParent::find()->where(['id' => $id])->all();
        $array = array();
        $array = json_decode($model[0]->extra, true);
        $array_result = array();
        $array_sending = array();
        $index = 0;

        foreach ($array as $e) {

            $array_result['index'] = $index;
            $array_result['Description'] = $e['Description'];
            $array_result['Price'] = str_replace(",", "", $e['Price']);
            $array_sending[] = $array_result;
            $index++;
        }
        echo json_encode($array_sending);
    }
    public function actionPeopleNumber()
    {
        echo json_encode($_SESSION['nbr_persson']);
    }
}
