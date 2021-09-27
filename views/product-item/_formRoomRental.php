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

$Produit_type = [

  ['id' => '0', 'name' => 'Banquet \\ Dinner'],

  ['id' => '1', 'name' => 'Conference'],

  ['id' => '2', 'name' => 'Cinema'],

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

  $currencies_symbol = "Dzd";
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

$listData = ArrayHelper::map($Produit_type, 'name', 'name');






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
echo $form->field($model3, 'CompanyName')->textInput(['placeholder' => 'Nom du bien']);
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
])->label("Type de chambre");
echo "</div>";
echo "<div class='col-md-6'>";
echo  $form->field($model, "price")->widget(MaskMoney::classname(), [
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
])->label(' Price') ;
echo "</div>";

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

])->label('Nombre de perssone');
echo "</div>";
echo "<div class='col-md-6'>";
echo $form->field($model3, 'imageFile[]')->fileInput(['style' => 'width:500px', 'multiple' => true]);
echo "</div>";
echo "</div>";


?>




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