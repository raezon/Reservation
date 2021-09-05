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
include  'produit.php';



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
        echo     $form->field($model3, 'name')->textInput(['style'=>'width:500px','placeholder'=>'Name under which you want to appear'])->label("Name"); 
        echo "</div>";
        //
        echo "<div class='col-md-6'>";
        echo     $form->field($model3, 'description')->textInput(['style'=>'width:500px','placeholder'=>'Choose type of food'])->label("Description"); 
        echo "</div>";
        //
       

       

        //food?>
    </div>
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
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                 <?= 
                                    $form->field($ProductItem, "[{$i}]name")->dropDownList(
                                        $mealData,
                                        [   'style' => ' !important',
                                            'prompt'=>'Choose your type of event',
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
                                            'prompt'=>'Choose type of Agent'
                                        
                                        ]
                                        )->label('Temperature of meal')
                                  ?> 
                            </div>
                        </div>        
<!--Deuxieme ligne -->
                        <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <?= $form->field($ProductItem, "[{$i}]number_of_agent", [
                                    'options' => [
                                        'tag' => 'div',
                                        'class' => '',
                                    ]
                                ])->textInput([
                                     'type' => 'number'
                                ]) ?>
                                </div>
                                 <div class="col-sm-6">
                                <?= $form->field($ProductItem, "[{$i}]periode", [
                                'options' => [
                                    'tag' => 'div',
                                    'class' => '',
                                ]
                            ])->textInput([
                                 'type' => 'number'
                            ])->label("Duration") ?>
                            </div>
                        </div>                            
<!--3 eme ligne -->
                    <div class="col-sm-12">
                       
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
                            <div class='col-md-6'>
                                <?= $form->field($ProductItem, "[{$i}]picture")->fileInput([])?>
           
                            </div>
                        </div>                             
                             

                                
            </div>
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </hr>

            <?php DynamicFormWidget::end(); ?>
                 <?php 
                    echo"<div class='col-md-12' >";
                    echo $form->field($model3, 'extra')->widget(MultipleInput::className(), [
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
                        'name'  => 'Price',
                        'title' => 'Price',
                         'type' =>MaskMoney::class
                    ]
                ]
             ])->label('Additonnal services');
                    echo"</div >";
            ?>
        </div>
      </div>
<div class="form-group">
      <div class="pull-right">
            <?= Html::submitButton('Save', ['class'=>'btn btn-lg btn-success ']) ?>
        </div>
        
    </div>
    <?php 
        $js = '
         var j=0;
                $(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
                    j=j+1;
                    
           jQuery(".dynamicform_wrapper .field-productitem-0-type").each(function(index) {
           
         $("input ").attr("id", "productitem-"+j+"-type"); //direct descendant 
         $
        
    });
        jQuery(".dynamicform_wrapper .field-productitem-0-quantity").each(function(index) {
           
         $("input ").attr("id", "productitem-"+j+"-quantity"); //direct descendant 
         $
        
    });
        jQuery(".dynamicform_wrapper .field-productitem-0-periode").each(function(index) {
           
         $("input ").attr("id", "productitem-"+j+"-periode"); //direct descendant 
         $
        
    });
        jQuery(".dynamicform_wrapper .field-productitem-0-price").each(function(index) {
           
         $("input ").attr("id", "productitem-"+j+"-price"); //direct descendant 
         $
        
    });
       jQuery(".dynamicform_wrapper .field-productitem-0-imageFile").each(function(index) {
           
         $("input ").attr("id", "productitem-"+j+"-imageFile"); //direct descendant 
         $
        
    });
        });

        $(".dynamicform_wrapper").on("afterInsert", function(e, item) {

        $(item).find(input[name*="[price]"]").inputmask({
            "alias":"decimal",
            "groupSeparator":".",
            "digits":0,
            "autoGroup":true,
            "removeMaskOnSubmit":true,
            "rightAlign":false
        });
    });

        $(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
            if (! confirm("Are you sure you want to delete this item?")) {
                return false;
            }
            return true;
        });

        $(".dynamicform_wrapper").on("afterDelete", function(e) {
            console.log("Deleted item!");
        });

        $(".dynamicform_wrapper").on("limitReached", function(e, item) {
            alert("Limit reached");
        });

        ';
        $this->registerJs($js, \yii\web\View::POS_LOAD);
    ?>
    <?php ActiveForm::end() ?>
  