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

$Produit_type = [

  ['id' => 'Meeting', 'name' => 'Meeting'],

  ['id' => 'Conference', 'name' => 'Conference'],

  ['id' => 'Cocktail', 'name' => 'Cocktail'],

  ['id' => 'Dinatoire', 'name' => 'Dinatoire'],

  ['id' => 'Theater', 'name' => 'Theater'],

  ['id' => 'Cinema', 'name' => 'Cinema']
];
$Produit_option = [

  ['id' => 'Some tables', 'name' => 'Some tables'],

  ['id' => 'Enclosed space', 'name' => 'Enclosed space'],

  ['id' => 'Full privatization', 'name' => 'Full privatization'],


];
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
foreach ($Produit_type as $type) {
  $produit_tableau_type[] = $type['name'];
}
$listData = ArrayHelper::map($Produit_type, 'name', 'name');
$listData1 = ArrayHelper::map($Produit_option, 'name', 'name');

$produit_tableau_option = array();
foreach ($Produit_option as $option) {
  $produit_tableau_option[] = $option['name'];
}

?>
<?= $form->field($model, 'partner_category')->hiddenInput(['value' => 1])->label(false); ?>
<?php

/******************************Form before qst****************************************/
echo "<div class='col-md-12'>";
//echo $model->product_type  ;

$type = json_decode($model->product_type, true);

$model->area = $type['0']['area'];
$model->caution = $type['0']['caution'];
$model->event_cake = $type['0']['event_cake'];
$model->drink = $type['0']['drink'];
$model->External_food = $type['0']['External_food'];
$model->External_Catering = $type['0']['External_Catering'];
$model->Internal_Catering = $type['0']['Internal_Catering'];
$model->Without_guarantee = $type['0']['Without_guarantee'];
$model->Minimum_consumption_Price = $type['0']['Minimum_consumption_Price'];
$model->Wifi = $type['0']['Wifi'];
$model->Board = $type['0']['Board'];
$model->System_Sound = $type['0']['System_Sound'];
$model->Micro = $type['0']['Micro'];
$model->Video_projector = $type['0']['Video_projector'];
$model->System_Sound = $type['0']['System_Sound'];
if (array_key_exists('To_bring_back_cake_of_the_event', $type['0']))
  $model->To_bring_back_cake_of_the_event = $type['0']['To_bring_back_cake_of_the_event'];
$model->Parking_lot = $type['0']['Parking_lot']["name"];
$model->Parking_lot_field = $type['0']['Parking_lot']['field'];
$model->Subway = $type['0']['Subway']['name'];
$model->Subway_field = $type['0']['Subway']['field'];
$model->Train = $type['0']['Train']['name'];
$model->Train_field = $type['0']['Train']['field'];
$model->Bus = $type['0']['Bus']['name'];
$model->Bus_field = $type['0']['Bus']['field'];

/*******************************First line******************************************/


$script = <<< JS
$(document).ready(function(){
  $('#productitem-image').text('pp.img')
$("#1").click(function(){
$("#partner-registration-form").toggle();
})
});
JS;
$this->registerJs($script);
