<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductHistoriqueSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-product-historique-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'partner_category')->textInput(['placeholder' => 'Partner Category']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true, 'placeholder' => 'Description']) ?>

    <?= $form->field($model, 'picture')->textInput(['maxlength' => true, 'placeholder' => 'Picture']) ?>

    <?php /* echo $form->field($model, 'price')->textInput(['maxlength' => true, 'placeholder' => 'Price']) */ ?>

    <?php /* echo $form->field($model, 'number_people')->textInput(['maxlength' => true, 'placeholder' => 'Number People']) */ ?>

    <?php /* echo $form->field($model, 'quantity')->textInput(['maxlength' => true, 'placeholder' => 'Quantity']) */ ?>

    <?php /* echo $form->field($model, 'duration')->textInput(['maxlength' => true, 'placeholder' => 'Duration']) */ ?>

    <?php /* echo $form->field($model, 'product_type_id')->textInput(['maxlength' => true, 'placeholder' => 'Product Type']) */ ?>

    <?php /* echo $form->field($model, 'product_option_id')->textInput(['maxlength' => true, 'placeholder' => 'Product Option']) */ ?>

    <?php /* echo $form->field($model, 'condition')->textInput(['maxlength' => true, 'placeholder' => 'Condition']) */ ?>

    <?php /* echo $form->field($model, 'availability')->textInput(['maxlength' => true, 'placeholder' => 'Availability']) */ ?>

    <?php /* echo $form->field($model, 'partner_id')->textInput(['placeholder' => 'Partner']) */ ?>

    <?php /* echo $form->field($model, 'extra')->textInput(['maxlength' => true, 'placeholder' => 'Extra']) */ ?>

    <?php /* echo $form->field($model, 'status')->checkbox() */ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
