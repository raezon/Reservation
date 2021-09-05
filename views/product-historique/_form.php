<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductHistorique */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="product-historique-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'partner_category')->textInput(['placeholder' => 'Partner Category']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true, 'placeholder' => 'Description']) ?>

    <?= $form->field($model, 'picture')->textInput(['maxlength' => true, 'placeholder' => 'Picture']) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true, 'placeholder' => 'Price']) ?>

    <?= $form->field($model, 'number_people')->textInput(['maxlength' => true, 'placeholder' => 'Number People']) ?>

    <?= $form->field($model, 'quantity')->textInput(['maxlength' => true, 'placeholder' => 'Quantity']) ?>

    <?= $form->field($model, 'duration')->textInput(['maxlength' => true, 'placeholder' => 'Duration']) ?>

    <?= $form->field($model, 'product_type_id')->textInput(['maxlength' => true, 'placeholder' => 'Product Type']) ?>

    <?= $form->field($model, 'product_option_id')->textInput(['maxlength' => true, 'placeholder' => 'Product Option']) ?>

    <?= $form->field($model, 'condition')->textInput(['maxlength' => true, 'placeholder' => 'Condition']) ?>

    <?= $form->field($model, 'availability')->textInput(['maxlength' => true, 'placeholder' => 'Availability']) ?>

    <?= $form->field($model, 'partner_id')->textInput(['placeholder' => 'Partner']) ?>

    <?= $form->field($model, 'extra')->textInput(['maxlength' => true, 'placeholder' => 'Extra']) ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
    <?php if(Yii::$app->controller->action->id != 'save-as-new'): ?>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?php endif; ?>
    <?php if(Yii::$app->controller->action->id != 'create'): ?>
        <?= Html::submitButton(Yii::t('app', 'Save As New'), ['class' => 'btn btn-info', 'value' => '1', 'name' => '_asnew']) ?>
    <?php endif; ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
