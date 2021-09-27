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

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>


    <?= $form->field($product_parent, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name'])->label('Name bien') ?>
    <?= $form->field($product_parent, 'description')->textInput(['maxlength' => true, 'placeholder' => 'Name'])->label('Description') ?>
    <?= $form->field($model, 'description')->textInput(['maxlength' => true, 'placeholder' => 'Description'])->label('Nom du transport') ?>




    <?= $form->field($model, 'people_number', [
        'options' => [
            'tag' => 'div',
            'class' => '',
        ]
    ])->textInput([
        'type' => 'number',
        'placeholder' => 'People Number'
    ])->label('Nombre perssone?') ?>
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
    ])->label(' Price') ?>


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