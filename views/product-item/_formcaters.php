<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;
use kartik\money\MaskMoney;
use unclead\multipleinput\MultipleInput;
/* @var $this yii\web\View */
/* @var $model app\models\ProductItem */
/* @var $form yii\widgets\ActiveForm */


    $currencies_symbol = "Dzd";
\Yii::$app->params['maskMoneyOptions']['prefix'] =  $currencies_symbol;
?>

<div class="product-item-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data',
        ],
        'id' => 'dynamic-form',
        //'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'method' => 'post',
    ]); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>
    <?= $form->field($product_parent, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name'])->label('Nom du bien') ?>
    <?= $form->field($product_parent, 'description')->textInput(['maxlength' => true, 'placeholder' => 'Name'])->label('Description') ?>
 
    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name'])->label("Repat") ?>


    <?= $form->field($model, 'product_type')->textInput(['maxlength' => true, 'placeholder' => 'Name'])->label("Product name") ?>

    <?= $form->field($model, 'temp')->textInput(['maxlength' => true, 'placeholder' => 'Temp'])->label('Chaud/Froid') ?>



    <?= $form->field($model, 'people_number', [
        'options' => [
            'tag' => 'div',
            'class' => '',
        ]
    ])->textInput([
        'type' => 'number',
        'placeholder' => 'People Number'
    ])->label('Nombre perssone?') ?>

    <?= $form->field($model, 'quantity', [
        'options' => [
            'tag' => 'div',
            'class' => '',
        ]
    ])->textInput([
        'type' => 'number',
        'placeholder' => 'Quantity'
    ]) ?>
  
    <?=
    $form->field($model, "price")->widget(MaskMoney::classname(), [
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
    ])->label('Price') ?>


    <div class="col-sm-12">
        <div class="col-sm-1">
            <?= $form->field($model, 'vegan')->checkbox(['value' => "vegan", 'uncheckValue' => "vide"], false)->label("vegan"); ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'Vegetarian')->checkbox(['value' => "Vegetarian", 'uncheckValue' => "vide"], false)->label("Vegetarian"); ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'Organic')->checkbox(['value' => "Organic", 'uncheckValue' => "vide"], false)->label("Organic"); ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'Gluten_free')->checkbox(['value' => "Gluten_free", 'uncheckValue' => "vide"], false)->label("Gluten_free"); ?>
        </div>
        <div class="col-sm-1">
            <?= $form->field($model, 'Halal')->checkbox(['value' => "Halal", 'uncheckValue' => "vide"], false)->label("Halal"); ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'Cacher')->checkbox(['value' => "Cacher", 'uncheckValue' => "vide"], false)->label("Cacher"); ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'Without_porc')->checkbox(['value' => "Without_porc", 'uncheckValue' => "vide"], false)->label("Without_porc"); ?>
        </div>
    </div>
    <?php
    $product_parent->extra = json_decode($product_parent->extra, true);
    ?>
   
   
    <?php $model->image = $model->picture; ?>
    <?= $form->field($model, 'image[]')->fileInput(['multiple' => true]) ?>



    <?php
    $user_id = User::getCurrentUser()->id;
    if ($user_id == 1) {
        echo $form->field($model, 'status')->checkbox();
    }
    ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>