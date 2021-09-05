<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentCondition */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-condition-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'iban')->textInput() ?>

    <?= $form->field($model, 'bic')->textInput() ?>

    <?= $form->field($model, 'bankname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bankcountry')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'File')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'condition1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'condition2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'partner_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
