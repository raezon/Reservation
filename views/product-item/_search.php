<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-product-item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'partner_category')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\PartnerCategory::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Choose Partner category'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'temp')->textInput(['maxlength' => true, 'placeholder' => 'Temp']) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true, 'placeholder' => 'Description']) ?>

    <?php /* echo $form->field($model, 'people_number')->textInput(['placeholder' => 'People Number']) */ ?>

    <?php /* echo $form->field($model, 'number_of_agent')->textInput(['placeholder' => 'Number Of Agent']) */ ?>

    <?php /* echo $form->field($model, 'quantity')->textInput(['placeholder' => 'Quantity']) */ ?>

    <?php /* echo $form->field($model, 'periode')->textInput(['placeholder' => 'Periode']) */ ?>

    <?php /* echo $form->field($model, 'price')->textInput(['placeholder' => 'Price']) */ ?>

    <?php /* echo $form->field($model, 'price_day')->textInput(['placeholder' => 'Price Day']) */ ?>

    <?php /* echo $form->field($model, 'price_night')->textInput(['placeholder' => 'Price Night']) */ ?>

    <?php /* echo $form->field($model, 'currencies_symbol')->textInput(['maxlength' => true, 'placeholder' => 'Currencies Symbol']) */ ?>

    <?php /* echo $form->field($model, 'languages')->textInput(['maxlength' => true, 'placeholder' => 'Languages']) */ ?>

    <?php /* echo $form->field($model, 'picture')->textInput(['maxlength' => true, 'placeholder' => 'Picture']) */ ?>

    <?php /* echo $form->field($model, 'checkbox')->textInput(['maxlength' => true, 'placeholder' => 'Checkbox']) */ ?>

    <?php /* echo $form->field($model, 'status')->textInput(['placeholder' => 'Status']) */ ?>

    <?php /* echo $form->field($model, 'product_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\ProductParent::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Choose Product parent'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
