<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentConditionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-condition-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'iban') ?>

    <?= $form->field($model, 'bic') ?>

    <?= $form->field($model, 'bankname') ?>

    <?= $form->field($model, 'bankcountry') ?>

    <?php // echo $form->field($model, 'File') ?>

    <?php // echo $form->field($model, 'condition1') ?>

    <?php // echo $form->field($model, 'condition2') ?>

    <?php // echo $form->field($model, 'partner_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
