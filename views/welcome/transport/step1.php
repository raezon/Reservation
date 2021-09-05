<?php
//CATERERS
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
use borales\extensions\phoneInput\PhoneInput;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

//$this->title = 'General Information';
/* @var $this yii\web\View */





?>
<style>
  .required:before {
    font-size: 15px;
    content:" *";
    color: red;
  }
</style>

<div class="row">
    <div class="col-sm-3">
        <h4 style="color:green;font-size:12;"><b>General Information</b></h4>
    </div>
    <div class="col-md-3">
        <h4>Availability and Displacement</h4>
    </div>
    <div class="col-md-2">
        <h4>Service and Prices</h4>
    </div>
    <div class="col-md-1">
        <h4>Conditions</h4>
    </div>
    <div class="col-md-1">
        <h4>Payments</h4>
    </div>
    <div class="col-md-2">
        <h4>Messages</h4>
    </div>
</div>
<?php
echo Progress::widget([
    'percent' => 10,
    'barOptions' => ['class' => 'progress-bar-success'],
    'options' => ['class' => 'active progress-striped']
]);?>

<div class="row">
    
    <div class="col-md-12">
        
    <div class="page-header">
        <h4><?= $this->title ?></h4>
        
    </div>
    <?php $form = ActiveForm::begin([
        'id' => 'partner-registration-form',
//      'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'method' => 'post',
        'action' =>['welcome/send']  
    ]); ?>
        <div class="row"> 
        <?= Html::hiddenInput('category_id', \Yii::$app->request->get('category_id', 0)) ?>

        <?php
//FirstName
         echo $form->field($model, 'idi')->hiddenInput(['value'=>1])->label(false);
         echo $form->field($model, 'cat_id')->hiddenInput(['value'=>8])->label(false);



        echo "<div class='col-md-6'>";
        echo   $form->field($model, 'firstName')->textInput(); 
        echo "</div>";
//LastName
        echo "<div class='col-md-6'>";
        echo   $form->field($model, 'lastName')->textInput(['style'=>'width:500px']); 
        echo "</div>";
//telphone
        echo "<div class='col-md-6'>";
        echo $form->field($model, 'tel')->widget(PhoneInput::className(), [
    'jsOptions' => [
        'preferredCountries' => ['no', 'pl', 'ua'],
    ]
],['style'=>'width:500px']);
        echo "</div>";
//mobile
        echo "<div class='col-md-6'>";
        echo $form->field($model, 'mobile')->widget(PhoneInput::className(), [
    'jsOptions' => [
        'preferredCountries' => ['no', 'pl', 'ua'],
    ]
],['style'=>'width:500px']);
         echo "</div>";
//fax
        echo "<div class='col-md-6'>";
        echo     $form->field($model, 'fax')->textInput(['style'=>'width:500px']); 
        echo "</div>";
//email



//$modelsAddress= \yii\helpers\Json::encode($modelsAddress);
        
        echo "<div class='col-md-6'>";
        echo     $form->field($model, 'email')->textInput(['style'=>'width:500px']); 
        echo "</div>";

        //food?>
      </div>

<div class="form-group">
         <div class="pull-right">
            <?= Html::submitButton('Next', ['class'=>'btn btn-lg btn-success','data-method'=>'POST']) ?>
           
        </div>
    </div>
    <?php ActiveForm::end() ?>
  