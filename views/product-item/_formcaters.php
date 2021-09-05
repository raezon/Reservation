<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;
use kartik\money\MaskMoney;
use unclead\multipleinput\MultipleInput;
/* @var $this yii\web\View */
/* @var $model app\models\ProductItem */
/* @var $form yii\widgets\ActiveForm */

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
    <?= $form->field($product_parent, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name'])->label('Name sosiety') ?>
    <?= $form->field($product_parent, 'description')->textInput(['maxlength' => true, 'placeholder' => 'Name'])->label('Description') ?>
    <?= $form->field($product_parent, 'kind_of_food')->textInput(['maxlength' => true, 'placeholder' => 'Name'])->label('Kind of food') ?>
    <?= $form->field($product_parent, 'min')->textInput(['maxlength' => true, 'placeholder' => 'Name'])->label('Minimum quantity to place this order') ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name'])->label("Meal") ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true, 'placeholder' => 'Description'])->label("Sort") ?>

    <?= $form->field($model, 'product_type')->textInput(['maxlength' => true, 'placeholder' => 'Name'])->label("Product name") ?>

    <?= $form->field($model, 'temp')->textInput(['maxlength' => true, 'placeholder' => 'Temp']) ?>



    <?= $form->field($model, 'people_number', [
        'options' => [
            'tag' => 'div',
            'class' => '',
        ]
    ])->textInput([
        'type' => 'number',
        'placeholder' => 'People Number'
    ]) ?>

    <?= $form->field($model, 'quantity', [
        'options' => [
            'tag' => 'div',
            'class' => '',
        ]
    ])->textInput([
        'type' => 'number',
        'placeholder' => 'Quantity'
    ]) ?>
    <?= $form->field($model, 'periode', [
        'options' => [
            'tag' => 'div',
            'class' => '',
        ]
    ])->textInput([
        'type' => 'number',
        'placeholder' => 'Periode'
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







    <?= $form->field($model, 'currencies_symbol')->textInput(['maxlength' => true, 'placeholder' => 'Currencies Symbol']) ?>


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
    <?= $form->field($product_parent, 'extra')->widget(MultipleInput::className(), [
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
                'type' => MaskMoney::class
            ]
        ]
    ])->label('Additonnal services');
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