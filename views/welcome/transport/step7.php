<?php
//CATERERS
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
use yii\jui\ProgressBar;
use yii\bootstrap\Progress;
use unclead\multipleinput\MultipleInput;
use kartik\money\MaskMoney;
$listData=ArrayHelper::map($Produit_type,'id','name');
//$this->title = 'General Information';
/* @var $this yii\web\View */

$geoip = new \lysenkobv\GeoIP\GeoIP();
$ip = $geoip->ip(Yii::$app->request->getUserIP()); // current user ip
$currencies = json_decode(file_get_contents('data.json'), true);
foreach ($currencies as $currency) {
    if (strtoupper($currency['country']) == strtoupper($ip->isoCode)) {
       $currencies_symbol= $currency['currency'];
    }
}
if(empty($currencies_symbol))
   $currencies_symbol="$";
   \Yii::$app->params['maskMoneyOptions']['prefix'] =  $currencies_symbol;


 $count_menu=0;
 $list_menu=['General Information','Availability and Displacement','Service and Prices','Conditions','Payments','Messages'];
 echo "<div class='row'>";
 foreach ($list_menu as $menu_item) {
    if($count_menu<3){

        if($count_menu==2){
           echo "<div class='col-md-3'>"."<h4 style='color:green;'><b>".$menu_item."</b></h4></div>";
        }
        else{

          echo "<div class='col-md-3'>"."<h4>".$menu_item."</h4></div>";
        }
    }
    else{
      echo "<div class='col-md-1'>"."<h4>".$menu_item."</h4></div>";
    }
  //incrementing the menu
  $count_menu++;
 }
echo "</div>";
echo Progress::widget([
    'percent' => 60,
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
          <?=  $form->field($model, 'idi')->hiddenInput(['value'=>3])->label(false);?>
          <?=  $form->field($model, 'cat_id')->hiddenInput(['value'=>8])->label(false);?>
        <?php
/********************************************FirstLine***********************/
echo "<div class='col-md-12'>";
        //Discription
        echo "<div class='col-md-6'>";
        echo $form->field($model3 , 'description')->textInput([]);
        echo "</div>";
         echo "<div class='col-md-6'>";
        echo $form->field($model3 , 'description1')->textInput([]);
        echo "</div>";
echo "</div>";
/********************************************SecondLine***********************/
echo "<div class='col-md-12'>";
        echo"<div class='col-md-6'>";
        echo $form->field($model3, 'produit_type')->dropDownList(
        $listData,
        [
            'prompt'=>'Choisir type de transport',

        ]
        );
        echo "</div>";
        echo"<div class='col-md-6'>";
        echo $form->field($model3, 'imageFile')->fileInput([]);
        echo "</div>";
        //nombre

echo "</div>";
/*****************************************Third Line***************************/
echo "<div class='col-md-12'>";
        echo"<div class='col-md-6'>";
        echo $form->field($model3, 'duration', [
                                'options' => [
                                    'tag' => 'div',
                                    'class' => '',
                                ]
                            ])->textInput([
                                 'type' => 'number',

                            ])->label('Duration');
        echo "</div>";
        echo"<div class='col-md-6'>";
        echo $form->field($model3, 'nombre_de_persson', [
                                'options' => [
                                    'tag' => 'div',
                                    'class' => '',
                                ]
                            ])->textInput([
                                 'type' => 'number',

                            ]);
        echo "</div>";

echo "</div>";



        //quantity

       //partie en dessu
        echo "<div class='row' >";
        echo "<div class='col-md-2'>";
        echo $form->field($model3, 'working_day' ,['options' =>  ['class' => 'checkbox checkbox-success']])->checkbox([] ,false)->label("working Evening");
         echo "</div>";
        echo "<div class='col-md-4'>";
                echo $form->field($model3,'prix_day')->widget(MaskMoney::classname(), [
               'name' => 'amount_ph_1',
                'value' => null,
                'options' => [
                    'placeholder' => 'Enter a valid amount...',
                    'style'=>'width:300 px'
                ],
                'pluginOptions' => [
                    'prefix' => '$',
                    'suffix' => '',
                    'allowNegative' => false
                ]
            ])->label("Working the  day");
         echo "</div>";
          echo "<div class='col-md-2'>";
        echo $form->field($model3,'working_night' ,['options' =>  ['class' => 'checkbox checkbox-success']])->checkbox([] ,false)->label("working Evening");
         echo "</div>";
        echo "<div class='col-md-4'>";
         echo $form->field($model3, 'prix_night')->widget(MaskMoney::classname(), [
               'name' => 'amount_ph_1',
                'options' => [
                    'placeholder' => 'Enter a valid amount...',
                    'style'=>'width:300 px'
                ],
                'pluginOptions' => [
                    'prefix' => '$',
                    'suffix' => '',
                    'allowNegative' => false
                ]
            ])->label("Working the evening");
        echo "</div>";

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
 ]);
        echo"</div >";
        ?>


        <div class="row">
        <div class="col-sm-12">
        <div class="text-center">
          <?= Html::submitButton('Save', ['class'=>'btn btn-lg btn-success']) ?>
        </div>
        </div>
        </div>

        <?php ActiveForm::end() ?>
        <div class="form-group">
        <div class="form-group">
            <div class="pull-right">
              <?=Html::a('Next',Url::to(['welcome/step','id'=>4,'category_id'=>Yii::$app->request->get('category_id', 0)]),['class'=>'btn btn-lg btn-info'])?>
            </div>
        </div>


         <div class="form-group">
            <div class="pull-left">
                <?=Html::a('back',Url::to(['welcome/step','id'=>2,'category_id'=>Yii::$app->request->get('category_id', 0)]),['class'=>'btn btn-lg btn-primary','data-method'=>'POST'])?>
            </div>
        </div>
