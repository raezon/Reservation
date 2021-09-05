<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'partner_category')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\PartnerCategory::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Partner category')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true, 'placeholder' => 'Description']) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true, 'placeholder' => 'Price']) ?>

    <?php /* echo $form->field($model, 'number_people')->textInput(['placeholder' => 'Number People']) */ ?>

    <?php /* echo $form->field($model, 'quantity')->textInput(['maxlength' => true, 'placeholder' => 'Quantity']) */ ?>

    <?php /* echo $form->field($model, 'duration')->textInput(['placeholder' => 'Duration']) */ ?>

    <?php /* echo $form->field($model, 'product_type_id')->textInput(['placeholder' => 'Product Type']) */ ?>

    <?php /* echo $form->field($model, 'product_option_id')->textInput(['placeholder' => 'Product Option']) */ ?>

    <?php /* echo $form->field($model, 'condition')->textInput(['maxlength' => true, 'placeholder' => 'Condition']) */ ?>

    <?php /* echo $form->field($model, 'availability')->textInput(['maxlength' => true, 'placeholder' => 'Availability']) */ ?>

    <?php /* echo $form->field($model, 'partner_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Partner::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Partner')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'extra')->textInput(['maxlength' => true, 'placeholder' => 'Extra']) */ ?>

    <?php /* echo $form->field($model, 'status')->checkbox() */ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
