<?php

use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use yii\helpers\Url;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use yii\helpers\Html;
use yii\bootstrap\Progress;
use app\models\base\TblEvents;
use yii\bootstrap\Modal;
use unclead\multipleinput\MultipleInput;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\Partner;
use kartik\money\MaskMoney;

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

//print_r($ip);
/* @var $this yii\web\View */
$delai = [
  ['id' => '1', 'name' => '1 mont in advance'],

  ['id' => '2', 'name' => '3 weeks in advance'],

  ['id' => '3', 'name' => '15 days in advance'],

  ['id' => '4', 'name' => '7 days in advance'],

  ['id' => '5', 'name' => '5 days in advance'],

  ['id' => '6', 'name' => '3 days in advance'],

  ['id' => '7', 'name' => '2 days in advance'],

  ['id' => '8', 'name' => '1 days in advance'],

  ['id' => '9', 'name' => 'The same day']
];
$listData = ArrayHelper::map($delai, 'id', 'name');
$date_of_starting = date("Y-m-d");
$end_of_starting = date('Y-m-d', strtotime('+3 Years'));
//adding to the date of now
//partie insertion dans la table event
$date_of_starting = date("Y-m-d");
$end_of_starting = date('Y-m-d', strtotime('+3 Years'));
//adding to the date of now
function getDatesFromRange($start, $end, $format = 'Y-m-d')
{
  $array = array();
  $interval = new DateInterval('P1D');

  $realEnd = new DateTime($end);
  $realEnd->add($interval);

  $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

  foreach ($period as $date) {
    $array[] = $date->format($format);
  }

  return $array;
}
$array = getDatesFromRange($date_of_starting, $end_of_starting);
//insert $data in the model even
$i = 0;
$numItems = count($array);

$partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
$id_partenaire = $partner->id;
$exist = TblEvents::find()->where(['partner_id' => $partner->id])->one();
if (is_null($exist)) {
  foreach ($array as $key => $value) {

    $model5 = new TblEvents();
    $model5->id = $i;
    $model5->title = "Available";
    $time1 = strtotime($array[$key]);
    $value1 = date('Y-m-d', $time1);
    if (++$i == $numItems) {
      $time2 = strtotime($array[$key]);
      $value2 = date('Y-m-d', $time2);
    } else {
      if (array_key_exists($key + 1, $array)) {
        $time2 = strtotime($array[$key + 1]);
        $value2 = date('Y-m-d', $time2);
      }
    }

    $model5->title = "Available";
    $model5->partner_id = $id_partenaire;
    $model5->start = $value1;
    $model5->end = $value2;
    $model5->save();
    if (++$i == $numItems) {
    }
  }
}



?>
<div class="row">
  <div class="col-md-2">
    <h4>General Information</h4>
  </div>
  <div class="col-md-3">
    <h4 style="color:green;"><b>Availability and Displacement</b></h4>
  </div>
  <div class="col-md-2">
    <h4>Service and Prices</h4>
  </div>
  <div class="col-md-1">
    <h4>Conditions</h4>
  </div>
  <div class="col-md-2">
    <h4>Payments</h4>
  </div>
  <div class="col-md-2">
    <h4>Messages</h4>
  </div>
</div>

<div class="col-md-12">
  <?php $form = ActiveForm::begin([
    'id' => 'partner-registration-form',
    //'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'action' => ['welcome/send']
  ]); ?>


  <div class="row">
    <div class="col-md-6">
      <?= $form->field($model, 'idi')->hiddenInput(['value' => 2])->label(false); ?>
      <?= $form->field($model, 'cat_id')->hiddenInput(['value' => 8])->label(false);
      ?>
      <div id="locationField">
        <?= $form->field($model, 'search')->textInput(['id' => 'autocomplete'])->label('Adress') ?>
      </div>

      <div id="address">
        <tr>

          <td class="slimField"> <?= $form->field($model, 'companyAddress')->textInput(['id' => 'street_number'])->label('Street Number') ?></td>
          <td class="wideField" colspan="2"><?= $form->field($model, 'companyAddress_N')->textInput(['id' => 'route'])->label('Street') ?></td>
        </tr>
        <tr>
          <td class="wideField" colspan="3"><?= $form->field($model, 'city')->textInput(['id' => 'locality'])->label('City') ?></td>
        </tr>
        <tr>
          <td class="slimField"><?= $form->field($model, 'country')->textInput(['id' => 'administrative_area_level_1'])->label('State') ?></td>
          <td class="wideField"><?= $form->field($model, 'postalCode')->textInput(['id' => 'postal_code'])->label('Zip code') ?></td>
        </tr>
        <tr>
          <td class="wideField" colspan="3"><?= $form->field($model, 'country')->textInput(['id' => 'country'])->label('Country') ?></td>
        </tr>
      </div>
      <hr style="color:gray">
      <?= $form->field($model, 'delai')->dropDownList(
        $listData,
        [
          'style' => 'width:440px !important',
          'prompt' => 'How many days in advance can customers cancel without charge?
',

        ]
      )->label('Concellation conditions'); ?>
      </br>
      <hr style="color:gray">
      <?php
      echo $form->field($model, 'schedule')->widget(MultipleInput::class, [
        'max' => 3,
        'min' => 3,
        'columns' => [
          [
            'name'  => 'Distance',
            'type'  => 'checkbox',
            'title' => 'Distance',
            'enableError' => true,
            'options' => [
              'class' => 'input-priority'
            ]

          ],
          [
            'name'  => 'Price',
            'title' => 'Price',
            'type' => MaskMoney::class,
            'enableError' => true,
            'options' => [
              'class' => 'input-priority'
            ]
          ]

        ]
      ])->label('Delivery and Deplacement');
      ?>
    </div>
    <div class="col-md-6">

      <div class="response"></div>
      <div id='calendar'></div>



    </div>
  </div>
  <input type="hidden" value="1" id="category_id_id" name="">
  <?= Html::hiddenInput('category_id', \Yii::$app->request->get('category_id', 0)) ?>
</div>
<div class="col-md-6">
  <div class="form-group">
    <div class="pull-right">
      <?= Html::submitButton('Next', ['class' => 'btn btn-lg btn-success']) ?>
    </div>
    <div class="pull-left">
      <?= Html::a('back', Url::to(['welcome/step', 'id' => 1, 'category_id' => Yii::$app->request->get('category_id', 0)]), ['class' => 'btn btn-lg btn-primary', 'data-method' => 'POST']) ?>
    </div>
  </div>

  <?php ActiveForm::end() ?>
  <!--                          <p>Lat: <span id="geo-lat"></span></p>
                          <p>Lng: <span id="geo-lng"></span></p>-->
</div>
<script src="js/google_extra.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7Iz5ZKGr0_5l_LD47xNf9umU7GSiUVuw&libraries=places&callback=initAutocomplete" async defer></script>