<?php

use yii\helpers\Html;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use app\models\Other;
use unclead\multipleinput\TabularInput ;
use unclead\multipleinput\MultipleInput ;
use kartik\money\MaskMoney;

include 'header.php';

//call a function fo Ch
///partie des produit option et type
$Produit_option = [

 

  ['id' => '1', 'name' => 'Enclosed space'],

  ['id' => '2', 'name' => 'Full privatization'],

  ['id' => '3', 'name' => 'Some tables'],

  ['id' => '4', 'name' => 'Other']

];

$Produit_type = [

  ['id' => '0', 'name' => 'Banquet \\ Dinner'],

  ['id' => '1', 'name' => 'Conference'],

  ['id' => '2', 'name' => 'Cinema'],

  ['id' => '3', 'name' => 'Dinatoire'],

  ['id' => '4', 'name' => 'Meeting'],

  ['id' => '5', 'name' => 'Theater'],

  ['id' => '6', 'name' => 'Other'],
];

$closedDay=[
  ['id' => '8', 'name' => 'Saturday'],

  ['id' => '9', 'name' => 'Sunday'],

  ['id' => '10', 'name' => 'Monday'],

  ['id' => '11', 'name' => 'Tuesday '],

  ['id' => '12', 'name' => 'Wednesday '],

  ['id' => '13', 'name' => 'Wednesday '],

  ['id' => '14', 'name' => 'Wednesday '],
];
$fullDay=[
  ['id' => '1', 'name' => 'Yes'],

  ['id' => '2', 'name' => 'No'],

];
$advancePayment=[
  ['id' => '1', 'name' => '30%'],

  ['id' => '2', 'name' => '40%'],

  ['id' => '3', 'name' => '50%'],

  ['id' => '4', 'name' => '60%'],

  ['id' => '5', 'name' => '70%'],

  ['id' => '6', 'name' => '80%'],

  ['id' => '7', 'name' => '90%'],

  ['id' => '8', 'name' => '100%'],

];
?>
<style>
  .has-star[for="nombre_de_persson"]:after {
    font-size: 15px;
    content: " *";
    color: red;
  }

  .has-star[for="servicesandpriceform-area"]:after {
    font-size: 15px;
    content: " *";
    color: red;
  }

  ::placeholder {
    padding-top: 5px;
  }
  .error-msg{
   background-color: #FF0000;
}
</style>
<?php
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
\Yii::$app->params['maskMoneyOptions']['prefix'] =  $currencies_symbol;
//$this->title = 'General Information';
//*************part used for Other variables and both produitoptio nand product type***/
$other_model  =  Other::find()->one();
$produit_tableau_type = array();
$i = 0;
foreach ($Produit_type as $type) {
  $produit_tableau_type[$i] = $type['name'];
  $i++;
}

$listData = ArrayHelper::map($Produit_type, 'name', 'name');




?>
<?= $form->field($model, 'idi')->hiddenInput(['value' => 3])->label(false); ?>
<?= $form->field($model, 'cat_id')->hiddenInput(['value' => 1])->label(false); ?>
<?= Html::hiddenInput('category_id', \Yii::$app->request->get('category_id', 0)) ?>
<?= $form->field($model3, 'idi')->hiddenInput(['value' => 3])->label(false); ?>
<?php
/******************************Form before qst****************************************/
echo "<div class='col-md-12'>";
/*******************************First line******************************************/
echo "<div class='col-md-6'>";
echo $form->field($model3, 'CompanyName')->textInput(['placeholder' => 'Name of the Comany'])->label('Nom du bien');
echo "</div>";

echo "<div class='col-md-6'>";
echo $form->field($model3, 'description')->textInput(['placeholder' => 'Name of the room rental'])->label('Nom du produit');
echo "</div>";
//
/*****************************End ofFirst line******************************************/
echo "</div>";
////image
echo "<div class='col-md-12 '>";


echo "<div class='col-md-12'>";
echo $form->field($model3, 'desriptionRoom')->textArea([
  'class' => 'form-control ',
  'style' => 'height:100px;',
  'placeholder' => '',
])->label('Description');
echo "</div>";

echo "</div>";
echo "<div class='col-md-12'>";
/********************************Second line****************************************/
//first column
echo "<div class='col-md-6'>";

echo $form->field($model3, 'produit_nom[]')->widget(Select2::class, [
  'data' => $listData,
  'language' => 'de',
  'options' => [
    'style' => ' !important',
    'prompt' => 'Choose type of room', 'Multiple' => true
  ],
  'pluginOptions' => [
    'allowClear' => true
  ],
])->label("Type de chambre");
echo "</div>";

echo "<div class='col-md-6'>";
echo $form->field($model3, 'nombre_de_persson', [
  'options' => [
    'tag' => 'div',
    'class' => '',
  ]
])->textInput([
  'min' => '1',
  'type' => 'number',
  'id' => 'nombre_de_persson',

])->label('Nombre de perssone');
echo "</div>";
echo "</div>";

/********************************Seventh Line*******************************************/
echo "<div class='col-md-12'>";

echo "<div class='col-md-6'>";
echo $form->field($model3, "price")->widget(MaskMoney::classname(), [
  'name' => 'amount_ph_1',
  'value' => null,
  'options' => [
      'placeholder' => 'Enter a valid amount...',

  ],
  'pluginOptions' => [
      'prefix' =>  $currencies_symbol,
      'suffix' => '',
      'allowNegative' => false
  ]
])->label('Prix');
echo "</div>";

echo "<div class='col-md-6'>";
echo $form->field($model3, 'imageFile[]')->fileInput(['style' => 'width:500px', 'multiple' => true]);
echo "</div>";

echo "</div>";
?>
</div>
<div>
</div>
<?php
include 'rules.php';
$this->registerJs($rules);
?>

<script src="js/autocomplete.js"> </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTGpqrJDrULNO0PNch-b8vlmcwwGt7D2c&libraries=places&callback=initAutocomplete" async defer></script>