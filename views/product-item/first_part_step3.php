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
