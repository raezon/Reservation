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
use yii\bootstrap\Modal;
use app\models\User;
use app\models\Partner;
use  app\views\welcome\widgets\NavStep;
$currencies_symbol = "Dzd";
\Yii::$app->params['maskMoneyOptions']['prefix'] =  $currencies_symbol;

$id_user = User::getCurrentUser()->id;
$partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
$partner_id = $partner->id;
include  'produit.php';
?>
<?php $NavStep = new NavStep('step3'); ?>
<?php $NavStep->displayNav(); ?>
<?php $NavStep->displayProgress(60); ?>



<div class="row">

<style>
    label:not([for="productparent-extra"]):not([for="productitem-0-vegan"]):not([for="productitem-0-vegetarian"]):not([for="productitem-0-organic"]):not([for="productitem-0-gluten_free"]):not([for="productitem-0-halal"]):not([for="productitem-0-cacher"]):not([for="productitem-0-without_porc"]):not([for="productitem-1-vegan"]):not([for="productitem-1-vegetarian"]):not([for="productitem-1-organic"]):not([for="productitem-1-gluten_free"]):not([for="productitem-1-halal"]):not([for="productitem-1-cacher"]):not([for="productitem-1-without_porc"]):not([for="productitem-2-vegan"]):not([for="productitem-2-vegetarian"]):not([for="productitem-2-organic"]):not([for="productitem-2-gluten_free"]):not([for="productitem-2-halal"]):not([for="productitem-2-cacher"]):not([for="productitem-2-without_porc"]):not([for="productitem-3-vegan"]):not([for="productitem-3-vegetarian"]):not([for="productitem-3-organic"]):not([for="productitem-3-gluten_free"]):not([for="productitem-3-halal"]):not([for="productitem-3-cacher"]):not([for="productitem-3-without_porc"]):after {
        font-size: 15px;
        content: " *";
        color: red;
    }
</style>
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
        ]); ?>

        <div class="row">

            <?= $form->field($model3, 'partner_category')->hiddenInput(['value' => 3])->label(false); ?>
            <?= Html::hiddenInput('category_id', \Yii::$app->request->get('category_id', 0)) ?>
            <?php

            echo "<div class='col-md-6'>";
            echo     $form->field($model3, 'name')->textInput(['placeholder' => 'Name under which you want to appear'])->label("Nom du bien");
            echo "</div>";

            echo "<div class='col-md-6'>";
            echo     $form->field($model3, 'description')->textArea(['placeholder' => "Décrivez votre entreprise/service (spécialité, expertise, nombre d'années d'expérience ... etc) cela attirera plus de clients"])->label("Discription");
            echo "</div>";



            //food
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
                    'checkbox',
                    'people_number',
                    'quantity',
                    'price'

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

                                        $form->field($ProductItem, "[{$i}]name[]")->widget(Select2::class, [
                                            'data' => $mealData,
                                            'language' => 'de',
                                            'options' => ['placeholder' => 'Choisir le repat', 'Multiple' => true],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ])->label("Repat");
                                        ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <?= $form->field($ProductItem, "[{$i}]temp")->dropDownList(
                                            $temperatureData,
                                            [
                                                'style' => ' !important',
                                                'prompt' => 'Choisir la temperature'

                                            ]
                                        )->label('Chaud/Froid')
                                        ?>
                                    </div>
                                </div>

                                <!--Deuxieme ligne -->
                                <div class="col-sm-12">
                                    <div class="col-sm-6">
                                        <?= $form->field($ProductItem, "[{$i}]description")->textInput(['maxlength' => true])->label('Nom du produit') ?>
                                    </div>

                                    <div class="col-sm-6">
                                        <?= $form->field($ProductItem, "[{$i}]people_number", [
                                            'options' => [
                                                'tag' => 'div',
                                                'class' => '',
                                            ]
                                        ])->textInput([
                                            'min' => '1',
                                            'type' => 'number'
                                        ])->label('Nombre perssone?') ?>
                                    </div>
                                </div>
                                <!--3 eme ligne -->
                                <div class="col-sm-12">
                                    <div class="col-sm-6">
                                        <?= $form->field($ProductItem, "[{$i}]quantity", [
                                            'options' => [
                                                'tag' => 'div',
                                                'class' => '',
                                            ]
                                        ])->textInput([
                                            'min' => '1',
                                            'type' => 'number'
                                        ])->label("<span>Quantity</span>
                                            <a href='#' title='This is the quantity needed to serve the number of people indicated Example :
                                            if :a quantity is sufficient for 2 people ,write 1' data-toggle='popover' data-trigger='hover' data-content='This is the quantity needed to serve the number of people indicated Example if :a quantity is sufficient for 2 people ,write 1'>
                                           <img width='15px' height='px' src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEuMSIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbG5zOnN2Z2pzPSJodHRwOi8vc3ZnanMuY29tL3N2Z2pzIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgeD0iMCIgeT0iMCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTIiIHhtbDpzcGFjZT0icHJlc2VydmUiIGNsYXNzPSIiPjxnPgo8cGF0aCB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGQ9Ik0yNTYsMEMxMTQuNjEzLDAsMCwxMTQuNjE3LDAsMjU2YzAsMTQxLjM5MSwxMTQuNjEzLDI1NiwyNTYsMjU2czI1Ni0xMTQuNjA5LDI1Ni0yNTZDNTEyLDExNC42MTcsMzk3LjM4NywwLDI1NiwweiAgIE0yNTYsMTI4YzE3LjY3NCwwLDMyLDE0LjMyOCwzMiwzMmMwLDE3LjY4LTE0LjMyNiwzMi0zMiwzMnMtMzItMTQuMzItMzItMzJDMjI0LDE0Mi4zMjgsMjM4LjMyNiwxMjgsMjU2LDEyOHogTTMwNCwzODRoLTk2ICBjLTguODM2LDAtMTYtNy4xNTYtMTYtMTZjMC04LjgzNiw3LjE2NC0xNiwxNi0xNmgxNnYtOTZoLTE2Yy04LjgzNiwwLTE2LTcuMTU2LTE2LTE2YzAtOC44MzYsNy4xNjQtMTYsMTYtMTZoNjQgIGM4LjgzNiwwLDE2LDcuMTY0LDE2LDE2djExMmgxNmM4LjgzNiwwLDE2LDcuMTY0LDE2LDE2QzMyMCwzNzYuODQ0LDMxMi44MzYsMzg0LDMwNCwzODR6IiBmaWxsPSIjMjk2YWNmIiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBzdHlsZT0iIiBjbGFzcz0iIj48L3BhdGg+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjwvZz48L3N2Zz4=' /></a>") ?>
                                    </div>

                                    <div class='col-md-6'>
                                        <?= $form->field($ProductItem, "[{$i}]picture[]")->fileInput(['multiple' => true])->label('photo') ?>

                                    </div>

                                </div>
                                <div class="col-sm-12">
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
                                </div>
                                <!-- 5 ligne -->
                                <div class="grid-container">
                                    <?php
                                    echo "<div class='grid-item'>";
                                    echo "<h7 id='marginVegan'>Vegan</h7>";
                                    echo $form->field($ProductItem, "[{$i}]vegan", ['options' =>  [
                                        'class' => 'checkbox',
                                        'checkbox-success', 'style' => 'margin-top:55px;'
                                    ]])->checkbox(['value' => "Vegan", 'uncheckValue' => "vide"], false)->label("");
                                    echo "</div>";
                                    echo "<div class='grid-item'>";
                                    echo "<h7 id='marginVegetarian'>Vegetarian</h7>";
                                    echo $form->field($ProductItem, "[{$i}]Vegetarian", ['options' =>  [
                                        'claGluten freess' => 'checkbox',
                                        'checkbox-success', 'style' => 'margin-top:55px;'
                                    ]])->checkbox(['value' => "Vegetarian", 'uncheckValue' => "vide"], false)->label("");

                                    echo "</div>";

                                    echo "<div class='grid-item'>";
                                    echo "<h7 id='marginOrganic'>Organic</h7>";
                                    echo $form->field($ProductItem, "[{$i}]Organic", ['options' =>  [
                                        'class' => 'checkbox',
                                        'checkbox-success', 'style' => 'margin-top:55px;'
                                    ]])->checkbox(['value' => "Organic", 'uncheckValue' => "vide"], false)->label("");
                                    echo "</div>";
                                    echo "<div class='grid-item'>";
                                    echo "<h7 id='marginGlutenFree'>Gluten free</h7>";
                                    echo $form->field($ProductItem, "[{$i}]Gluten_free", ['options' =>  [
                                        'class' => 'checkbox',
                                        'checkbox-success', 'style' => 'margin-top:55px;'
                                    ]])->checkbox(['value' => "Gluten_free", 'uncheckValue' => "vide"], false)->label("");
                                    echo "</div>";
                                    echo "<div class='grid-item'>";
                                    echo "<h7 id='marginHalal'>Halal</h7>";
                                    echo $form->field($ProductItem, "[{$i}]Halal", ['options' =>  ['class' => 'checkbox', '
                                        checkbox-success', 'style' => 'margin-top:55px;']])->checkbox(['value' => "Halal", 'uncheckValue' => "vide"], false)->label("");
                                    echo "</div>";
                                    echo "<div class='grid-item'>";
                                    echo "<h7 id='marginCacher'>Cacher</h7>";
                                    echo $form->field($ProductItem, "[{$i}]Cacher", ['options' =>  [
                                        'class' => 'checkbox',
                                        'checkbox-success', 'style' => 'margin-top:55px;'
                                    ]])->checkbox(['value' => "Cacher", 'uncheckValue' => "vide"], false)->label("");
                                    echo "</div>";
                                    echo "<div class='grid-item'>";
                                    echo "<h7 id='marginWithoutPorc'>Without porc</h7>";
                                    echo $form->field($ProductItem, "[{$i}]Without_porc", ['options' =>  [
                                        'class' => 'checkbox', 'value' => "Without_porc", 'uncheckValue' => "vide",
                                        'checkbox-success', 'style' => 'margin-top:55px;'
                                    ]])->checkbox([], false)->label("");
                                    echo "</div>"; ?>
                                </div>
                             

                            </div>
                        </div><!-- .row -->
                    </div>
            </div>
        <?php endforeach; ?>
        </div>
        </hr>

        <?php DynamicFormWidget::end(); ?>

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
        $("#productitem-"+0+"-without_porc").val("Without_porc")
         var j=0;
                $(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
                    
                    j=j+1;
              jQuery(".dynamicform_wrapper .field-productitem-0-name").each(function(index) {
           
         $("input ").attr("id", "productitem-"+j+"-name"); //direct descendant 
         $
        
    });           
           jQuery(".dynamicform_wrapper .field-productitem-0-temp").each(function(index) {
           
         $("input ").attr("id", "productitem-"+j+"-temp"); //direct descendant 
         $
        
    });
          jQuery(".dynamicform_wrapper .field-productitem-0-description").each(function(index) {
           
         $("input ").attr("id", "productitem-"+j+"-description"); //direct descendant 
         $
        
    });
        jQuery(".dynamicform_wrapper .field-productitem-0-quantity").each(function(index) {
           
         $("input ").attr("id", "productitem-"+j+"-quantity"); //direct descendant 
         $
        
    });
       jQuery(".dynamicform_wrapper .field-productitem-0-people_number").each(function(index) {
           
         $("input ").attr("id", "productitem-"+j+"-people_number"); //direct descendant 
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
     jQuery(".dynamicform_wrapper .field-productitem-0-vegan").each(function(index) {
           
         $("input ").attr("id", "productitem-"+j+"-vegan"); //direct descendant 
         $
        
    });
     jQuery(".dynamicform_wrapper .field-productitem-0-Vegetarian").each(function(index) {
           
         $("input ").attr("id", "productitem-"+j+"-Vegetarian"); //direct descendant 
         $
        
    });
     jQuery(".dynamicform_wrapper .field-productitem-0-Organic").each(function(index) {
           
         $("input ").attr("id", "productitem-"+j+"-Organic"); //direct descendant 
         $
        
    });
     jQuery(".dynamicform_wrapper .field-productitem-0-Gluten-free").each(function(index) {
           
         $("input ").attr("id", "productitem-"+j+"-Gluten-free"); //direct descendant 
         $
        
    });
      jQuery(".dynamicform_wrapper .field-productitem-0-Gluten-free").each(function(index) {
           
         $("input ").attr("id", "productitem-"+j+"-Gluten-free"); //direct descendant 
         $
        
    });
      jQuery(".dynamicform_wrapper .field-productitem-0-Halal").each(function(index) {
           
         $("input ").attr("id", "productitem-"+j+"-Halal"); //direct descendant 
         $
        
    });
      jQuery(".dynamicform_wrapper .field-productitem-0-Cacher").each(function(index) {
           
         $("input ").attr("id", "productitem-"+j+"-Cacher"); //direct descendant 
         $
        
    });
        jQuery(".dynamicform_wrapper .field-productitem-0-Without_porc").each(function(index) {
           
         $("input ").attr("id", "productitem-"+j+"-Without_porc"); //direct descendant 
         $
        
    });
        });

        $(".dynamicform_wrapper").on("afterInsert", function(e, item) {
            
            for(l=1;l<5;l++){
                $("#productitem-"+l+"-vegan").val("vegan")
                $("#productitem-"+l+"-vegetarian").val("Vegetarian")
                $("#productitem-"+l+"-organic").val("Organic")
                $("#productitem-"+l+"-gluten_free").val("Gluten_free")
                $("#productitem-"+l+"-halal").val("Halal")
                $("#productitem-"+l+"-cacher").val("Cacher")
                $("#productitem-"+l+"-without_porc").val("Without_porc")
            }
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
          var intialHeight=10;
          var counter=0;
          $("#productitem-0-name").on("change", function() {
           
            counter++;
            if(counter%3==0){
                intialHeight=intialHeight+25;
                $(".select2-search__field").css("height",intialHeight);
            }
               
            
          });
        $("#id").click(function(){
        
            $("#dynamic-form").attr("action", "index.php?r=welcome%2Fnext&id=3&category_id=3");
        });
  });
     ';
        $this->registerJs($ts); ?>
        <?php ActiveForm::end() ?>