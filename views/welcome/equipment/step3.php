<?php
//CATERERS
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Progress;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\money\MaskMoney;
use unclead\multipleinput\MultipleInput;
use  app\views\welcome\widgets\NavStep;

$currencies_symbol = "Dzd";
\Yii::$app->params['maskMoneyOptions']['prefix'] =  $currencies_symbol;

?>
<?php $NavStep = new NavStep('step3'); ?>
<?php $NavStep->displayNav(); ?>
<?php $NavStep->displayProgress(60); ?>

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
            'action' => ['dynamic/create']
            //dynamic/create
        ]); ?>
        <div class="row">
            <?= $form->field($model3, 'partner_category')->hiddenInput(['value' => 2])->label(false); ?>
            <?php
            echo "<div class='col-md-6'>";
            echo     $form->field($model3, 'name')->textInput([ 'placeholder' => 'Name under which you want to appear'])->label("Nom du bien");
            echo "</div>";
            //
            echo "<div class='col-md-6'>";
            echo     $form->field($model3, 'description')->textArea([ 'placeholder' => "Décrivez votre entreprise/service (spécialité, expertise, nombre d'années d'expérience ... etc) cela attirera plus de clients"])->label("Discription");
            echo "</div>";

            ?>


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
                    'people_number',
                    'quantity',
                    'periode',
                    'price_day',
                    'price_night',
                    'people_number',


                ],
            ]); ?>

            <div class="container-items">
                <!-- widgetContainer -->

                <?php foreach ($ProductsItem as $i => $ProductItem) : ?>

                    <div class="item panel panel-default">
                        <!-- widgetBody -->
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
                            if (!$ProductItem->isNewRecord) {
                                echo Html::activeHiddenInput($ProductItem, "[{$i}]id");
                            }
                            ?>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-6">
                                        <?=
                                        $form->field($ProductItem, "[{$i}]name")->textInput()->label('Nom du produit')
                                        ?>
                                    </div>


                                    <!--quantity-->

                                    <div class="col-sm-6">

                                        <?= $form->field($ProductItem, "[{$i}]quantity", [
                                            'options' => [
                                                'tag' => 'div',
                                                'class' => '',
                                            ]
                                        ])->textInput([
                                            'min' => '1',
                                            'type' => 'number'
                                        ])->label('Quantité') ?>
                                    </div>
                                </div>
                                <!--Rental periode-->
                                <div class="col-sm-12">


                                    <!--price -->

                                    <div class="col-sm-6">
                                        <?php
                                        echo $form->field($ProductItem, "[{$i}]price")->widget(MaskMoney::classname(), [
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
                                        ])->label('Prix'); ?>
                                    </div>
                                    <div class='col-md-6'>
                                        <?= $form->field($ProductItem, "[{$i}]picture[]")->fileInput(['multiple' => true]) ?>

                                    </div>
                                </div>
                              
                            </div><!-- .row -->
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php DynamicFormWidget::end(); ?>

        </div>
    </div>

    <div class="form-group">
        <div class="form-group">
            <div class="pull-right">
                <?= Html::submitButton('Next', ['class' => 'btn btn-lg btn-info', 'id' => "id"]) ?>

            </div>
        </div>


        <div class="form-group">
            <div class="pull-left">
                <?= Html::a('back', Url::to(['welcome/step', 'id' => 2, 'category_id' => Yii::$app->request->get('category_id', 0)]), ['class' => 'btn btn-lg btn-primary', 'data-method' => 'POST']) ?>
            </div>
        </div>

        <?php
        $js = '
       
         var j=0;

       
                $(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
                    j=j+1;
      
           jQuery(".dynamicform_wrapper .field-productitem-0-name").each(function(index) {
           
         $("input ").attr("id", "productitem-"+j+"-name"); //direct descendant 
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
       jQuery(".dynamicform_wrapper .field-productitem-0-picture").each(function(index) {
           
         $("input ").attr("id", "productitem-"+j+"-picture"); //direct descendant 
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
        <?php
        $ts = '
       $( document ).ready(function() {
        
     $("#id").click(function(){
    
        $("#dynamic-form").attr("action", "index.php?r=welcome%2Fnext&id=3&category_id=2");
      });
  });
     ';
        $this->registerJs($ts);
        ?>
        <?php ActiveForm::end() ?>
    </div>