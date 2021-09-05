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
        $productObj['price'] = $query[0]->price;
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
            $array_result['Price'] = $e['Price'];
            $array_sending[] = $array_result;
            $index++;
        }
        echo json_encode($array_sending);
    }
}
