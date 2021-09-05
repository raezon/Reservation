<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use app\models\Other;
use unclead\multipleinput\MultipleInput;
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



?>
<?php $form = ActiveForm::begin([
  'options' => [
    'enctype' => 'multipart/form-data',
    'enableClientValidation' => true,
    'method' => 'post',
    'action' => ['product-item/update']
  ],
]);
include "first_part_step3.php"; 
include "js.php"; ?>
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

echo $form->field($model3, 'ouvertureFermuture')->widget(MultipleInput::className(), [
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
      
      
      
    ],
    [
      'name'  => 'period2',
      'title' => "Period 2",
      'type' => MaskMoney::class ,
      
    ],
    [
      'name'  => 'period3',
      'title' => "Period 3",
      'type' => MaskMoney::class ,
   
    ],
    [
      'name'  => 'period4',
      'title' => "Period 4",
      'type' => MaskMoney::class ,
   
    ],
    [
      'name'  => 'period5',
      'title' => "Period 5",
      'type' => MaskMoney::class ,
   
    ],
    [
      'name'  => 'period6',
      'title' => "Period 6",
      'type' => MaskMoney::class ,
   
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
    'prompt' => 'Choose the adavencement payment', 'Multiple' => true
  ],
  'pluginOptions' => [
    'allowClear' => true
  ],
])->label("Advance payment");
echo "</div>";
echo "</div>";
?>
<div class="col-md-12" style="padding-bottom:50px">

  <div class="col-sm-4">
  <div>
    <div class="pull-left col-md-12">
      <a class="btn btn-sm " style="border: none;background:none;outline: none;color:#000000" id="2">
        <h4><span style="color:green; font-size: 20px;">+</span>Accept</h4>
      </a>
    </div>
  </div>

  <?= $form->field($model3, 'partner_category')->hiddenInput(['value' => 1])->label(false); ?>
  <?= Html::hiddenInput('category_id', \Yii::$app->request->get('category_id', 0)) ?>
  <div class="col-md-12">
    <div class="col-md-8">
      <label>Personal Event Cake</label>
    </div>
    <div class="col-md-4">
      <?= $form->field($model3, 'event_cake')->checkbox(['id' => 'remember-me-ver', 'custom' => true, 'value' => "event_cake", 'uncheckValue' => "vide"]) ?>
    </div>
  </div>
  <div class="col-md-12">
    <div class="col-md-8">
      <label>External Drink</label>
    </div>
    <div class="col-md-4">
      <?= $form->field($model3, 'drink')->checkbox(['id' => 'remember-me-ver', 'custom' => true, 'value' => "drink", 'uncheckValue' => "vide"]) ?>
    </div>
  </div>

  <div class="col-md-12">
    <div class="col-md-8">
      <label>External Food </label>
    </div>
    <div class="col-md-4">
      <?= $form->field($model3, 'External_food')->checkbox(['id' => 'remember-me-ver', 'custom' => true, 'value' => "External food", 'uncheckValue' => "vide"]) ?>
    </div>
  </div>

  <div class="col-md-12">
    <div class="col-md-8">
      <label>External Catering</label>
    </div>
    <div class="col-md-4">
      <?= $form->field($model3, 'Internal_Catering')->checkbox(['id' => 'remember-me-ver', 'custom' => true, 'value' => "Internal_Catering", 'uncheckValue' => "vide"]) ?>
    </div>
  </div>

  <div class="col-md-12">

    <div class="col-md-7">
      <a class="" id="other_c" style="border: none;background:none;outline: none;cursor:cell;"><b>+Other accept...</b></a>

      <?php
      echo "<div id='Possibilities_id'>";
      echo $form->field($model3, 'extra_p')->widget(MultipleInput::className(), [
        'max' => 4,
        'min' => 4,
        'columns' => [
          [
            'name'  => 'Possibility_check_name',
            'title' => 'Possibility Check Name',
          ],

          [
            'name'  => 'Possibility_check_name2',
            'title' => 'Possibility Check Name',
          ],


        ]
      ])->label('Add Other Accept');
      echo "</div >"; ?>
    </div>
  </div>

  </div>
<!Fin Partie Accept -------------------------------------------------------------------------------------------->

<div class="col-sm-3">
<div>
    <div class="pull-left col-md-12">
      <a class="btn btn-sm " style="border: none;background:none;outline: none;color:#000000" id="2">
        <h4><span style="color:green; font-size: 20px;">+</span>Facilities</h4>
      </a>
    </div>
  </div>

  <div class="col-md-12">
              <div class="col-md-8">
                <label>Wifi</label>
              </div>
              <div class="col-md-4">
                <?= $form->field($model3, 'Wifi')->checkbox(['id' => 'remember-me-ver', 'custom' => true, 'value' => "Wifi", 'uncheckValue' => "vide"]) ?>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-8">
                <label>Board</label>
              </div>
              <div class="col-md-4">
                <?= $form->field($model3, 'Board')->checkbox(['id' => 'remember-me-ver', 'custom' => true, 'value' => "Board", 'uncheckValue' => "vide"]) ?>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-8">
                <label>System Sound</label>
              </div>
              <div class="col-md-4">
                <?= $form->field($model3, 'System_Sound')->checkbox(['id' => 'remember-me-ver', 'custom' => true, 'value' => "System_Sound", 'uncheckValue' => "vide"]) ?>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-8">
                <label>Micro</label>
              </div>
              <div class="col-md-4">
                <?= $form->field($model3, 'Micro')->checkbox(['id' => 'remember-me-ver', 'custom' => true, 'value' => "Minimum_consumption_Price", 'uncheckValue' => "vide"]) ?>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-8">
                <label>Video Projector</label>
              </div>
              <div class="col-md-4">
                <?= $form->field($model3, 'Video_projector')->checkbox(['id' => 'remember-me-ver', 'custom' => true, 'value' => "Video_projector", 'uncheckValue' => "vide"]) ?>
              </div>
            </div>

            <div class="col-md-12">
              <div class="col-md-8">
                <label>Internal Catering</label>
              </div>
              <div class="col-md-4">
                <?= $form->field($model3, 'External_Catering')->checkbox(['id' => 'remember-me-ver', 'custom' => true, 'value' => "External_Catering", 'uncheckValue' => "vide"]) ?>
              </div>
            </div>
          
          <div class="col-md-12">
            <div class="col-md-9">
              <a class="" id="other_s" style="border: none;background:none;outline: none;cursor:cell;"><b>+Other facilities ...</b></a>
              <?php
              echo "<div id='Facilities_id'>";
              echo $form->field($model3, 'services_F')->widget(MultipleInput::className(), [
                'max' => 4,
                'min' => 4,
                'columns' => [
                  [
                    'name'  => 'Description',
                    'title' => 'Description',

                  ],
                  [
                    'name'  => 'Description2',
                    'title' => 'Description',

                  ],


                ]
              ])->label('Add other facilities included in the price');
              echo "</div >"; ?>
            </div>
          </div>
          <?php include "jsStep3-partner-registration-form2andother.php"; ?>


       
</div>
     
 <!--partie Transport-->
 <div class="col-sm-5">
 <div>
    <div class="pull-left col-md-12">
      <a class="btn btn-sm " style="border: none;background:none;outline: none;color:#000000" id="2">
        <h4><span style="color:green; font-size: 20px;">+</span>Transport</h4>
      </a>
    </div>
  </div>

  <div class="col-md-12">
  <div class="col-md-4">
                <?= Html::img("@web/img/parking_black.png", [
                  'class' => "img-fluid img-thumbnail", 'width' => '60px'
                ]) ?>
                <label>Parking lot</label>
              </div>
              <div class="col-md-3">
                </br>
                <?= $form->field($model3, 'Parking_lot')->checkbox(['id' => 'click1', 'custom' => true, 'value' => "Parking_lot", 'uncheckValue' => "vide"]) ?>
              </div>
              <div class="col-md-3">
                <?= $form->field($model3, 'Parking_lot_field')->textInput(['id' => 'field1', 'style' => 'width:280px', 'placeholder' => 'Name of park'])->label(''); ?>
              </div>

            </div>
            <div class="col-md-12">
              <div class="col-md-4">
                <?= Html::img("@web/img/subway.png", [
                  'class' => "img-fluid img-thumbnail", 'width' => '60px'
                ]) ?>
                <label>Subway</label>
              </div>
              <div class="col-md-3">
                </br>
                <?= $form->field($model3, 'Subway')->checkbox(['id' => 'click2', 'custom' => true, 'value' => "Subway", 'uncheckValue' => "vide"]) ?>
              </div>
              <div class="col-md-3">
                <?= $form->field($model3, 'Subway_field')->textInput(['id' => 'field2', 'style' => 'width:280px', 'placeholder' => 'Subway stations description or name'])->label(''); ?>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-4">
                <?= Html::img("@web/img/train2.png", [
                  'class' => "img-fluid img-thumbnail", 'width' => '60px'
                ]) ?>
                <label>Train</label>
              </div>
              <div class="col-md-3">
                </br>
                <?= $form->field($model3, 'Train')->checkbox(['id' => 'click3', 'custom' => true, 'value' => "Train", 'uncheckValue' => "vide"]) ?>
              </div>
              <div class="col-md-3">
                <?= $form->field($model3, 'Train_field')->textInput(['id' => 'field3', 'style' => 'width:2800px', 'placeholder' => 'Train stations description or name'])->label(''); ?>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-4">
                <?= Html::img("@web/img/bus_montpellier.png", [
                  'class' => "img-fluid img-thumbnail", 'width' => '60px'
                ]) ?>
                <label>Bus</label>
              </div>
              <div class="col-md-3">
                </br>
                <?= $form->field($model3, 'Bus')->checkbox(['id' => 'click4', 'custom' => 'true', 'value' => "Bus", 'uncheckValue' => "vide"]) ?>
              </div>
              <div class="col-md-3">
                <?= $form->field($model3, 'Bus_field')->textInput(['id' => 'field4', 'style' => 'width:280px', 'placeholder' => 'Bus stations description or name'])->label(''); ?>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-8">
                <a class="" id="other_m" style="border: none;background:none;outline: none;cursor:cell;"><b>+Other transport ...</b></a>
                <?php
                echo "<div id='Transport_id'>";
                echo $form->field($model3, 'extra_t')->widget(MultipleInput::className(), [
                  'max' => 8,
                  'min' => 8,
                  'columns' => [
                    [
                      'name'  => 'Transportation_name',
                      'title' => 'Transport Name',
                      'enableError' => true,
                      'options' => [
                        'class' => 'input-priority',
                        'placeholder' => 'Transport name'
                      ]
                    ],
                    [
                      'name'  => 'route number',
                      'title' => 'Route Number',
                      'enableError' => true,
                      'options' => [
                        'class' => 'input-priority',
                        'placeholder' => 'Transport Route'
                      ]
                    ],

                  ]
                ])->label('Add Other Transport');
                echo "</div >"; ?>
              </div>
            </div>
 </div>
<?php
echo "<div class='col-md-12' >";
echo $form->field($model3, 'services')->widget(MultipleInput::className(), [
  'max' => 4,
  
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
<div class="row">
              <div class="col-sm-12">
                <div class="text-center">
                  <?= Html::submitButton('Updae', ['class' => 'btn btn-lg btn-success']) ?>
                </div>
              </div>
            </div>
<?php ActiveForm::end() ?>

<?php
//separate it this js file
$script = <<< JS
//Regles sur les periode de temps
$(document).ready(function(){
  $("#servicesandpriceform-ouverturefermuture-0-period1-disp").prop("type", "time");
  $("#servicesandpriceform-ouverturefermuture-1-period1-disp").prop("type", "time");
  $("#servicesandpriceform-ouverturefermuture-0-period2-disp").prop("type", "time");
  $("#servicesandpriceform-ouverturefermuture-1-period2-disp").prop("type", "time");
  $("#servicesandpriceform-ouverturefermuture-0-period3-disp").prop("type", "time");
  $("#servicesandpriceform-ouverturefermuture-1-period3-disp").prop("type", "time");
  $("#servicesandpriceform-ouverturefermuture-0-period4-disp").prop("type", "time");
  $("#servicesandpriceform-ouverturefermuture-1-period4-disp").prop("type", "time");
  $("#servicesandpriceform-ouverturefermuture-0-period5-disp").prop("type", "time");
  $("#servicesandpriceform-ouverturefermuture-1-period5-disp").prop("type", "time");
  $("#servicesandpriceform-ouverturefermuture-0-period6-disp").prop("type", "time");
  $("#servicesandpriceform-ouverturefermuture-1-period6-disp").prop("type", "time");
  let select_cache = null
  var hourDiff=0;
  var previousEnding=-1;
  var nextStart=0;
  for (i = 1; i < 7; i++) {
  var startDate="";
  var endDate="";

 // var startDate = $('input[type=time]').valueAsDate;
  $(" #servicesandpriceform-ouverturefermuture-0-period"+i+"-disp").off('change').change(function(event){
    if (!select_cache) {
        setTimeout(() => {
            //Getting the previous hour
            if(previousEnding!=-1){
              previousEnding= $(" #servicesandpriceform-ouverturefermuture-0-period"+(i)+"-disp").valueAsDate
              previousEnding = new Date(endDate);
              previousEnding=endDate.getHours()-1;
            }
            //Getting the hour
            startDate =this.valueAsDate
            startDate = new Date(startDate);
            hourD=startDate.getHours()-1;
            //The case of 12 am to do not get a negative value
            if(hourD==-1)
                hourD=startDate.getHours() +1;
                minutesS=startDate.getMinutes()
                nextStart=startDate.getHours() -1;
            //verify that the value of next start >previos neding
            
            if(previousEnding>-1){
              alert(previousEnding)
              alert(nextStart);
              if(nextStart<previousEnding){
                alert("Hours of next period should be bigger than the ending of previous periode")
              }
            }else{
              if(nextStart>-1){
             //   alert(true)
              }
            }

            //clear the cache do to the repition
            select_cache = null
        }, 100)
    }
    select_cache = event
    
})

 

  $(" #servicesandpriceform-ouverturefermuture-1-period"+i+"-disp").off("change").change(function(){
    
    if (!select_cache) {
        setTimeout(() => {
          endDate =this.valueAsDate
          endDate = new Date(endDate);
          hourA=endDate.getHours()-1;
          if(hourA==-1)
              hourA=endDate.getHours()+1;
          minutesA=endDate.getMinutes();
          previousEnding=hourA;
          hourDiff+=hourA-hourD;
          
          if(hourDiff>24){
            alert("Sum of all periods can not be more than 24") 
          }
          if (startDate > endDate) { 
          // if(minutess>minutesA)
          //    alert("Hour  start an minutes should be bigger than Hour ending and minutes") 
          //  else
              alert("Hour start should be bigger than Hour ending") 
            }
          
            //clear the cache
            select_cache = null
        }, 100)
    }
    select_cache = event 

    
  });
  }

  
$("#1").click(function(){
$("#partner-registration-form").toggle();
})
});
JS;
$this->registerJs($script);
?>

<script>
  // This sample uses the Autocomplete widget to help the user select a
  // place, then it retrieves the address components associated with that
  // place, and then it populates the form fields with those details.
  // This sample requires the Places library. Include the libraries=places
  // parameter when you first load the API. For example:
  // <script
  // src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
  var placeSearch, autocomplete;

  var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
  };

  function initAutocomplete() {
    // Create the autocomplete object, restricting the search predictions to
    // geographical location types.

    autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('autocomplete'), {
        types: ['geocode']
      });

    // Avoid paying for data that you don't need by restricting the set of
    // place fields that are returned to just the address components.
    autocomplete.setFields(['address_component']);

    // When the user selects an address from the drop-down, populate the
    // address fields in the form.
    autocomplete.addListener('place_changed', fillInAddress);



    // Avoid paying for data that you don't need by restricting the set of
    // place fields that are returned to just the address components.
    //autocomplete.setFields(['address_component']);

    // When the user selects an address from the drop-down, populate the
    // address fields in the form.
    //autocomplete.addListener('place_changed', fillInAddress);
  }

  function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();

    for (var component in componentForm) {
      document.getElementById(component).value = '';
      document.getElementById(component).disabled = false;
    }

    // Get each component of the address from the place details,
    // and then fill-in the corresponding field on the form.
    for (var i = 0; i < place.address_components.length; i++) {
      var addressType = place.address_components[i].types[0];
      if (componentForm[addressType]) {
        var val = place.address_components[i][componentForm[addressType]];
        document.getElementById(addressType).value = val;
      }
    }
  }

  // Bias the autocomplete object to the user's geographical location,
  // as supplied by the browser's 'navigator.geolocation' object.
  function geolocate() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var geolocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        var circle = new google.maps.Circle({
          center: geolocation,
          radius: position.coords.accuracy
        });
        autocomplete.setBounds(circle.getBounds());
      });
    }
  }
; 
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTGpqrJDrULNO0PNch-b8vlmcwwGt7D2c&libraries=places&callback=initAutocomplete" async defer></script>