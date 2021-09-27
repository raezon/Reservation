<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Notifications */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="notifications-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'class')->textInput(['maxlength' => true, 'placeholder' => 'Class']) ?>

    <?= $form->field($model, 'key')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'key2')->textInput(['maxlength' => true, 'placeholder' => 'Key2']) ?>

    <?= $form->field($model, 'message')->textInput(['maxlength' => true, 'placeholder' => 'Message']) ?>

    <?= $form->field($model, 'reservation_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Reservation::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => 'Choose Reservation'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'route')->textInput(['maxlength' => true, 'placeholder' => 'Route']) ?>

    <?= $form->field($model, 'seen')->checkbox() ?>

    <?= $form->field($model, 'read')->checkbox() ?>

    <?= $form->field($model, 'user_id')->textInput(['placeholder' => 'User']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
