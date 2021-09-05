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
use app\models\ProductItem;
use app\models\Plat;
use yii\bootstrap\Progress;
use borales\extensions\phoneInput\PhoneInput;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\money\MaskMoney;
use unclead\multipleinput\MultipleInput;

//$this->title = 'General Information';
/* @var $this yii\web\View */
  //1 drop down for the lunch
        $Produit= [

          ['id' => '1', 'name' => 'Breakfast '],

          ['id' => '2', 'name' => 'Lunch/Dinner'],

          ['id' => '3', 'name' => 'Just Lunch'],

          ['id' => '4', 'name' => 'Just Dinner'],

          ['id' => '5', 'name' => 'Cocktails (sweet and savoury) '],

          ['id' => '6', 'name' => 'Salty buffet'],

          ['id' => '7', 'name' => 'Sweet Buffet '],

          ['id' => '8', 'name' => 'Sweet & salty buffet '],

          ['id' => '9', 'name' => 'other '],

        ];
        $mealData=ArrayHelper::map($Produit,'id','name');
         $Temperature= [

          ['id' => '1', 'name' => 'Hot '],

          ['id' => '2', 'name' => 'Cold'],

          ['id' => '3', 'name' => 'Averge'],

        ];
        $temperatureData=ArrayHelper::map($Temperature,'id','name');



?>
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
<?= Progress::widget([
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
         'options' => [
        'enctype' => 'multipart/form-data',
         
    ],
        
        'id' => 'dynamic-form',
        //'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'method' => 'post',
        'action' =>['dynamic/create']
    ]); ?>
        <div class="row"> 
        <?=  $form->field($model3, 'partner_category')->hiddenInput(['value'=>6])->label(false); ?>
        <?php
        echo "<div class='col-md-6'>";
        echo     $form->field($model, 'fax')->textInput(['style'=>'width:500px','placeholder'=>'Name under which you want to appear'])->label("Name"); 
        echo "</div>";
        //
        echo "<div class='col-md-6'>";
        echo     $form->field($model, 'email')->textInput(['style'=>'width:500px','placeholder'=>'Choose type of food'])->label("Kind of food"); 
        echo "</div>";
        //
        echo "<div class='col-md-6'>";
        echo     $form->field($model, 'email')->textInput(['style'=>'width:500px','placeholder'=>'Enter the minimum quantity'])->label("Minimum quantity to place this order"); 
        echo "</div>";
        //
         echo "<div class='col-md-6'>";
        echo     $form->field($model, 'email')->textInput(['style'=>'width:500px','placeholder'=>'Description of your compagny and services'])->label("Discription"); 
        echo "</div>";
       

        //food?>
        <div>
                    <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $ProductsItem[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'name',
                    'temp',
                    'description',
                    'checkbox',
                    'people_number',
                    'quantity',
                    'price'
                  
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($ProductsItem as $i => $ProductItem): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">

                        <h3 class="panel-title pull-left"><b>Products</b></h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $ProductItem->isNewRecord) {
                                echo Html::activeHiddenInput($ProductItem, "[{$i}]id");
                            }
                        ?>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                 <?= 
                                    $form->field($ProductItem, "[{$i}]name")->dropDownList(
                                        $mealData,
                                        [   'style' => ' !important',
                                            'prompt'=>'Choose your Meal',
                                            'onchange' => '
                                                $.post("index.php?r=welcome/lists&id='.'"+$(this).val(), function(data){
                                                    $("select#servicesandpriceform-produit_option").html(data);
                                                });'
                                        ]
                                        )->label('Name of Meal')
                                  ?>
                            </div>
                            <div class="col-sm-6">
                                <?=  $form->field($ProductItem, "[{$i}]temp")->dropDownList(
                                        $temperatureData,
                                        [   'style' => ' !important',
                                            'prompt'=>'Choose temperature of dish'
                                        
                                        ]
                                        )->label('Temperature of meal')
                                  ?> 
                            </div>
                             <div class="col-sm-6">
                                <?= $form->field($ProductItem, "[{$i}]description")->textInput(['maxlength' => true]) ?>
                            </div>
                             <div class="col-sm-6">
                                <?php 
                                    echo "<div class='col-md-2'>";
                                    echo "<h7>vegan</h7>";
                                    echo $form->field($ProductItem, "[{$i}]checkbox" ,['options' =>  ['class' => 'checkbox,
                                        checkbox-success','style'=>'margin-top:55px;']])->checkbox([] ,false)->label("");
                                    echo "</div>";
                                    echo "<div class='col-md-2'>";
                                    echo "<h7>No gluten</h7>";
                                    echo $form->field($ProductItem, "[{$i}]checkbox" ,['options' =>  ['claGluten freess' => 'checkbox,
                                        checkbox-success','style'=>'margin-top:55px;']])->checkbox([] ,false)->label("");

                                    echo "</div>";
                                    
                                    echo "<div class='col-md-2'>";
                                    echo "<h7>Halal</h7>";
                                     echo $form->field($ProductItem, "[{$i}]checkbox" ,['options' =>  ['class' => 'checkbox,
                                        checkbox-success','style'=>'margin-top:55px;']])->checkbox([] ,false)->label("");
                                    echo "</div>";
                                    echo "<div class='col-md-2'>";
                                     echo "<h7>Kosher</h7>";
                                     echo $form->field($ProductItem, "[{$i}]checkbox" ,['options' =>  ['class' => 'checkbox,
                                        checkbox-success','style'=>'margin-top:55px;']])->checkbox([] ,false)->label("");
                                    echo "</div>";
                                    echo "<div class='col-md-2'>";
                                    echo "<h7>Organic</h7>";
                                     echo $form->field($ProductItem, "[{$i}]checkbox" ,['options' =>  ['class' => 'checkbox,
                                        checkbox-success','style'=>'margin-top:55px;']])->checkbox([] ,false)->label("");
                                    echo "</div>";
                                    echo "<div class='col-md-2'>";
                                    echo "<h7>No porc</h7>";
                                     echo $form->field($ProductItem, "[{$i}]checkbox" ,['options' =>  ['class' => 'checkbox,
                                        checkbox-success','style'=>'margin-top:55px;']])->checkbox([] ,false)->label("");
                                    echo "</div>";?>
                            </div>
                             <div class="col-sm-6">
                                <?= $form->field($ProductItem, "[{$i}]people_number")->textInput(['maxlength' => true]) ?>
                            </div>
                             <div class="col-sm-6">
                                <?= $form->field($ProductItem, "[{$i}]quantity")->textInput(['maxlength' => true]) ?>
                            </div>
                             <div class="col-sm-6">
                                <?php
                                 echo $form->field($ProductItem, "[{$i}]price")->widget(MaskMoney::classname(), [
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
                            ])->label("Price"); ?>
                            </div>
                            <hr>
                                    <?php
                echo"<div class='col-md-12' >";
                    echo $form->field($model3, 'schedule')->widget(MultipleInput::className(), [
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
                        'enableError' => true,
                        'options' => [
                            'class' => 'input-priority'
                        ]
                    ]
                ]
             ])->label('Additonnal services');
                    echo"</div >";
            ?>
            </div>
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </hr>

            <?php DynamicFormWidget::end(); ?>
        </div>
      </div>
<div class="form-group">
      <div class="pull-right">
            <?=Html::a('Next',Url::to(['welcome/step','id'=>2,'category_id'=>Yii::$app->request->get('category_id', 0)]),['class'=>'btn btn-lg btn-success','data-method'=>'POST'])?>
        </div>
        
    </div>
    <?php ActiveForm::end() ?>
  