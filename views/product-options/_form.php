<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\money\MaskMoney;
/* @var $this yii\web\View */
/* @var $model app\models\ProductExtra */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="product-extra-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true, 'placeholder' => 'Description']) ?>

    <?=$form->field($model, 'quantity', [
          
                                'options' => [
                                    'tag' => 'div',
                                    'class' => '',
                                ]
                            ])->textInput([
                                  'placeholder'=>'Quantity',
                                 'type' => 'number'
                            ]);

     ?>

    <?= $form->field($model, "price")->widget(MaskMoney::classname(), [
                                       'name' => 'amount_ph_1',
                                'value' => null,
                                'options' => [
                                    'placeholder' => 'Price...',
                                    'style'=>'width:300 px'
                                ],
                                'pluginOptions' => [
                                    'prefix' => '$',
                                    'suffix' => '',
                                    'allowNegative' => false
                                ]
                            ])->label("Price");?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
