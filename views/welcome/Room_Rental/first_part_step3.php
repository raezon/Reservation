<?php

use yii\helpers\Html;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use app\models\Other;
use unclead\multipleinput\TabularInput ;
use unclead\multipleinput\MultipleInput ;
use kartik\money\MaskMoney;


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
$closedDay = ArrayHelper::map($closedDay, 'name', 'name');
$listData = ArrayHelper::map($Produit_type, 'name', 'name');
$closedDays = ArrayHelper::map($closedDay, 'name', 'name');
$fullDays = ArrayHelper::map($fullDay, 'name', 'name');
$listData1 = ArrayHelper::map($Produit_option, 'name', 'name');
$advancePayment = ArrayHelper::map($advancePayment, 'name', 'name');



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
echo $form->field($model3, 'CompanyName')->textInput(['placeholder' => 'Name of the Comany']);
echo "</div>";

echo "<div class='col-md-6'>";
echo $form->field($model3, 'description')->textInput(['placeholder' => 'Name of the room rental']);
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
])->label("Type of Room");
echo "</div>";
/////second columun/////////////////////////////////////////////////////////
echo "<div class='col-md-6'>";

echo $form->field($model3, 'produit_option[]')->widget(Select2::class, [
  'data' => $listData1,
  'language' => 'de',
  'options' => [
    'style' => ' !important',
    'prompt' => 'Choose space for rent', 'Multiple' => false
  ],
  'pluginOptions' => [
    'allowClear' => true
  ],
])->label("Space for Rent");
echo "</div>";
/***************************End of Second line***************************************/
echo "</div>";
/********************************Third Line*******************************************/
echo "<div class='col-md-12'>";
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

]);
echo "</div>";
echo "<div class='col-md-6'>";
echo $form->field($model3, 'adress_roomRental')->textInput([
  'id' => 'autocomplete',
  'class' => 'form-control ',
  'placeholder' => 'NEAR TO?',
]);
echo "</div>";
echo "</div>";
/*******************************End ofThird Line***************************************/
/********************************Fourth Line*******************************************/
echo "<div class='col-md-12'>";
echo "<div class='col-md-6'>";
echo $form->field($model3, 'minRentalPeriode', [
  'options' => [
    'tag' => 'div',
    'class' => '',
  ]
])->textInput([
  'min' => '1',
  'type' => 'number',
  'id' => 'minRentalPeriode',

]);
echo "</div>";
echo "<div class='col-md-6'>";
echo $form->field($model3, 'maxRentalPeriode', [
  'options' => [
    'tag' => 'div',
    'class' => '',
  ]
])->textInput([
  'min' => '1',
  'type' => 'number',
  'id' => 'maxRentalPeriode',

]);
echo "</div>";

echo "</div>";
/*******************************End of Fourth Line***************************************/
/********************************Fifth Line*******************************************/
echo "<div class='col-md-12'>";
echo "<div class='col-md-6'>";
echo $form->field($model3, 'minNumberGuest', [
  'options' => [
    'tag' => 'div',
    'class' => '',
  ]
])->textInput([
  'min' => '1',
  'type' => 'number',
  'id' => 'minNumberGuest',

]);
echo "</div>";
echo "<div class='col-md-6'>";
echo $form->field($model3, 'maxSeats', [
  'options' => [
    'tag' => 'div',
    'class' => '',
  ]
])->textInput([
  'min' => '1',
  'type' => 'number',
  'id' => 'maxSeats',

]);
echo "</div>";

echo "</div>";
/*******************************End of Fifth Line***************************************/
/********************************Sixth Line*******************************************/
echo "<div class='col-md-12'>";

echo "<div class='col-md-6'>";

echo $form->field($model3, 'closedDay')->widget(Select2::classname(), ([
  'name' => 'partner_category',
  'data' => $closedDay,
  'language' => 'an',
  'options' => [
    'style' => ' !important',
    'prompt' => 'Closed day', 'Multiple' => true
  ],
  'pluginOptions' => [
    'allowClear' => true,
    //'multiple' => true,
  ],
])); 
echo "</div>";
echo "<div class='col-md-6 '>";
echo $form->field($model3, 'area', [
  'options' => [
    'tag' => 'div',
    'class' => '',
  ]
])->textInput([
  'min' => '1',
  'type' => 'number',
])->label('Area m²');
echo "</div>";
echo "</div>";
/*******************************End of Fifth Line***************************************/
/********************************Seventh Line*******************************************/
echo "<div class='col-md-12'>";

echo "<div class='col-md-6 '>";
echo $form->field($model3, 'fullDay')->widget(Select2::class, [
  'data' => $fullDays,
  'language' => 'an',
  'options' => [
    'style' => ' !important',
    'prompt' => 'Full day', 'Multiple' => false
  ],
  'pluginOptions' => [
    'allowClear' => true
  ],
])->label("Full day or not");
echo "</div>";
//
echo "<div class='col-md-6'>";
echo $form->field($model3, 'imageFile[]')->fileInput(['style' => 'width:500px', 'multiple' => true]);
echo "</div>";

echo "</div>";

/*******************************Fifth Line here***************************************/
echo "<div class='col-md-12' >";
$dayarray=['Saturday','Sunday','Monday','Thuesday','Wendenesay','Thirsday','Friday'];

echo $form->field($model3, 'ouvertureFermuture')->widget(MultipleInput ::class, [
  'max' => 7,
  'min' => 7,
  'allowEmptyList' => false,
  'columns' => [
    [
      'name'  => 'Day',
      'title' => 'Type of Room',
      'enableError' => true,
      'options' => [
        'class' => 'input-priority',
        'style'=>' cursor: not-allowed;
         background-color: #EEE;
         color: #9E9999;'
      ],
    

    ],
    [

      'name'  => 'period1',
      'title' => "Period 1",
      'type' =>  MaskMoney::class ,
      'enableError' => true,
      
      
      
      
    ],
    [
      'name'  => 'period2',
      'title' => "Period 2",
      'type' => MaskMoney::class ,
      'enableError' => true,
      
      
    ],
    [
      'name'  => 'period3',
      'title' => "Period 3",
      'type' => MaskMoney::class ,
      'enableError' => true,
      
   
    ],
    [
      'name'  => 'period4',
      'title' => "Period 4",
      'type' => MaskMoney::class ,
      'enableError' => true,
      
   
    ],
    [
      'name'  => 'period5',
      'title' => "Period 5",
      'type' => MaskMoney::class ,
      'enableError' => true,
      
   
    ],
    [
      'name'  => 'period6',
      'title' => "Period 6",
      'type' => MaskMoney::class ,
     'enableError' => true,
  
   
    ],

  ]

])->label('Chose your rental periods and the price by person for each period');
echo "</div >";

echo "<div class='col-md-12'>";
echo "<div class='col-md-6'>";
echo $form->field($model3, 'weekendSurcharge', [
  'options' => [
    'tag' => 'div',
    'class' => '',
  ]
])->textInput([
  'min' => '1',
  'type' => 'number',
  'id' => 'weekendSurcharge',

]);
echo "</div>";
echo "<div class='col-md-6'>";
echo $form->field($model3, 'deposit')->widget(MaskMoney::class, [
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
]);
echo "</div>";
echo "<div class='col-md-6'>";
echo $form->field($model3, 'advancePayment')->widget(Select2::class, [
  'data' => $advancePayment,
  'language' => 'an',
  'options' => [
    'style' => ' !important',
    'prompt' => 'Choose the adavencement payment', 'Multiple' => false
  ],
  'pluginOptions' => [
    'allowClear' => true
  ],
])->label("Advance payment");
echo "</div>";
echo "</div>";



echo "<div class='col-md-12' >";
echo $form->field($model3, 'services')->widget(MultipleInput::class, [
  'max' => 4,
  'allowEmptyList' => false,
  'attributeOptions' => [
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'validateOnChange' => true,
    'validateOnSubmit' => true,
    'validateOnBlur' => false,
],
  'columns' => [
    [
      'name'  => 'Description',
      'title' => 'Description',
      'enableError' => true,
      'options' => [
        'class' => 'input-priority'
      ]
    ],
    [
      'name'  => 'Quantity',
      'title' => 'Quantity',
      'enableError' => true,
      'options' => [
        'min' => '1',
        'type' => 'number',
        'class' => 'input-priority'
      ]
    ],
    [
      'name'  => 'Price',
      'title' => 'Price',
      'type' => MaskMoney::class
    ]
  ]

])->label('Add Other Services');
echo "</div >";

/*******************************End offifth Line***************************************/ ?>
</div>
<div>
</div>
<?php
include 'rules.php';
$this->registerJs($rules);
?>

<script src="js/autocomplete.js"> </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTGpqrJDrULNO0PNch-b8vlmcwwGt7D2c&libraries=places&callback=initAutocomplete" async defer></script>