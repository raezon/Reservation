<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use yii\helpers\ArrayHelper;
use app\models\Product;
use app\models\Plat;
use yii\bootstrap\Progress;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use app\models\Other;
use unclead\multipleinput\MultipleInput;
use kartik\money\MaskMoney;
use app\models\User;
use app\models\Partner;
?>
<?php
//add code to get the current partener_id
$id_user = User::getCurrentUser()->id;
//traying to getting partener id
$partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
$partner_id = $partner->id;
$other_types = Other::find()->where(['partener_id' => $partner_id, 'category_id' => 3, 'type' => 1])->all();



$Produit = [
  ['id' => '1',  'name' => 'Breakfast'],
  ['id' => '2',  'name' => 'Lunch :Individual plate'],
  ['id' => '3',  'name' => 'Lunch :Dish to share'],
  ['id' => '4',  'name' => 'Lunch :Lunch box'],
  ['id' => '5',  'name' => 'Lunch :Meal trays'],
  ['id' => '6',  'name' => 'Lunch:Other'],
  ['id' => '7',  'name' => 'Dinner :Individual plate'],
  ['id' => '8',  'name' => 'Dinner :Dish to share'],
  ['id' => '9',  'name' => 'Dinner :Lunch box'],
  ['id' => '10', 'name' => 'Dinner :Meal trays'],
  ['id' => '11', 'name' => 'Dinner:Other'],
  ['id' => '12', 'name' => 'Lunch\Dinner :Individual plate'],
  ['id' => '13', 'name' => 'Lunch\Dinner :Dish to share'],
  ['id' => '14', 'name' => 'Lunch\Dinner :Lunch box'],
  ['id' => '15', 'name' => 'Lunch\Dinner :Meal trays'],
  ['id' => '16', 'name' => 'Lunch\Dinner:Other'],
  ['id' => '17', 'name' => 'Cocktail'],
  ['id' => '18', 'name' => 'Salty buffet'],
  ['id' => '19', 'name' => 'Sweet buffet'],
  ['id' => '20', 'name' => 'Sweet and Salty buffet '],
  ['id' => '21', 'name' => 'Other']
];
/*$i = 0;
$i = $i + 20;*/
/*if (!empty($other_types)) {
  foreach ($other_types as $other_type) {
    $i++;
    $Produit[$i]['name'] = $other_type->name;
  }
  $i = $i + 1;
  $Produit[$i]['name'] = "Other";
}
*/
$mealData = ArrayHelper::map($Produit, 'name', 'name');
$Temperature = [

  ['id' => '1', 'name' => 'Hot'],

  ['id' => '2', 'name' => 'Cold']

];
$temperatureData = ArrayHelper::map($Temperature, 'name', 'name');
$Kind_of_food = [
  ['id' => '1', 'name' => 'French'],
  ['id' => '2', 'name' => 'Italian'],
  ['id' => '3', 'name' => 'Oriental'],
  ['id' => '4', 'name' => 'Méditerranean'],
  ['id' => '5', 'name' => 'American'],
  ['id' => '6', 'name' => 'Southamerican'],
  ['id' => '7', 'name' => 'Asian'],
  ['id' => '8', 'name' => 'Indian'],
  ['id' => '9', 'name' => 'African'],
  ['id' => '10', 'name' => 'East'],
  ['id' => '11', 'name' => 'Wordfood'],
  ['id' => '12', 'name' => 'Other']
];
$Kind_of_food = ArrayHelper::map($Kind_of_food, 'name', 'name');
