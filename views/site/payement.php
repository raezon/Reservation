<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Payment */
/* @var $form ActiveForm */
?>
<div class="site-payement">

    <?php $form = ActiveForm::begin(); ?>

       
     
       <?=  $form->field($model, 'piece_jointe')->widget(FileInput::classname(), [
    'options' => ['multiple' => true],
    'pluginOptions' => ['previewFileType' => 'any']
]);?>
    
        <div class="form-group">
            <?= Html::submitButton('Payer', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-payement -->
