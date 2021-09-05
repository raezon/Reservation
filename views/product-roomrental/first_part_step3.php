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
//*************part used for Other variables and both produitoptio nand product type***/
$other_model  =  Other::find()->one();
$produit_tableau_type=array();
foreach ($Produit_type as $type) {
        $produit_tableau_type[]=$type['name'];
}
$listData=ArrayHelper::map($Produit_type,'id','name');
$listData1=ArrayHelper::map($Produit_option,'id','name');
//print_r($Produit_option);
//trying to reconstruct the array
$produit_tableau_option=array();
foreach ($Produit_option as $option) {
  $produit_tableau_option[]=$option['name'];
}

?>
<?=  $form->field($model, 'idi')->hiddenInput(['value'=>3])->label(false);?>
<?=  $form->field($model, 'cat_id')->hiddenInput(['value'=>1])->label(false);?>
<?= Html::hiddenInput('category_id', \Yii::$app->request->get('category_id', 0)) ?>
<?= $form->field($model3, 'idi')->hiddenInput(['value'=>3])->label(false);?>
<?php
/******************************Form before qst****************************************/
  echo "<div class='col-md-12'>";
/*******************************First line******************************************/
  echo"<div class='col-md-6'>";
  echo $form->field($model3 , 'description')->textInput(['style'=>'width:440px','placeholder'=>'Name under which you want to appear']);
  echo "</div>";
//
  echo"<div class='col-md-6'>";
  echo $form->field($model3, 'imageFile')->fileInput(['style'=>'width:500px']);
  echo "</div>";
/*****************************End ofFirst line******************************************/
  echo "</div>";
  echo "<div class='col-md-12'>";
/********************************Second line****************************************/
//first column
    echo"<div class='col-md-6'>";
    echo $form->field($model3, 'produit_type')->dropDownList(
    $produit_tableau_type,
    [ 
    'prompt'=>'Choose type of room',
    ]
    )->label('Type of Room');
    echo "</div>";
/////second columun/////////////////////////////////////////////////////////
  echo"<div class='col-md-6'>";
    echo $form->field($model3, 'produit_option')->dropDownList(
    $produit_tableau_option,
    [   
    'prompt'=>'Choose space for rent',

    ]
    )->label('Space for Rent');
    echo "</div>";
  /***************************End of Second line***************************************/
  echo "</div>";
/********************************Third Line*******************************************/
echo"<div class='col-md-12'>";
  echo"<div class='col-md-6'>";
  echo $form->field($model3, 'nombre_de_persson', [
                       'options' => [
                           'tag' => 'div',
                           'class' => '',
                       ]
                   ])->textInput([
                        'type' => 'number',
                        'id'=>'nombre_de_persson',
                        
                   ]);
  echo "</div>";
  echo"<div class='col-md-6'>";
  echo $form->field($model3, 'price')->widget(MaskMoney::classname(), [
  'name' => 'amount_ph_1',
  'value' => null,
  'options' => [
    'placeholder' => 'Enter a valid amount...',
    
  ],
  'pluginOptions' => [
    'prefix' => '$ ',
    'suffix' => '',
    'allowNegative' => false
  ]
  ]);
  echo "</div>";
echo "</div>";
/*******************************End ofThird Line***************************************/
/*******************************Fourth Line here***************************************/
echo"<div class='col-md-12 '>";
/*-------------Area Fields here -----------------------------------------------------*/
  echo"<div class='col-md-6 '>";
  echo $form->field($model3, 'area', [
                     'options' => [
                         'tag' => 'div',
                         'class' => '',
                     ]
                 ])->textInput([
                      'type' => 'number',
                 ])->label('Area m²');
  echo "</div>";
/*-------------Cautioion Fields here ----------------------------------------------*/
  echo"<div class='col-md-6'>";
  echo $form->field($model3, 'caution')->widget(MaskMoney::classname(), [
  'name' => 'amount_ph_1',
  'value' => null,
  'options' => [
    'placeholder' => 'Enter a valid amount...',
    
  ],
  'pluginOptions' => [
    'prefix' => '$ ',
    'suffix' => '',
    'allowNegative' => false
  ]
  ]);
  echo "</div>";
echo "</div>";
/*******************************End ofFourth Line**************************************/
/*******************************Fifth Line here***************************************/
echo"<div class='col-md-12' >";
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
    'class' => 'input-priority'
]
],
[
'name'  => 'Price',
'title' => 'Price',
'type' =>MaskMoney::class
]
]
])->label('Add Other Services');
echo"</div >";
/*******************************End offifth Line***************************************/?>
</div>
<div>
</div>
<?php
$script = <<< JS
$(document).ready(function(){
$("#1").click(function(){
$("#partner-registration-form").toggle();
})
});
JS;
$this->registerJs($script);