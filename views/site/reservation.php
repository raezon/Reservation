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

    <?php $form = ActiveForm::begin([
                                        'action' => ['save-reservation','prix'=>$prix,'id'=>$id],
                                        'id' => 'formDecaissement',
                                        'method' => 'post',
                                        'enableAjaxValidation' => false,
                                        'enableClientValidation' => false,
                                        'options' => ['enctype' => 'multipart/form-data']
                                       // 'options' => ['data-pjax' => true ]
                                    ]); ?>



    <?=  $form->field($model, 'file')->widget(FileInput::classname(), [
    'options' => ['enctype' => 'multipart/form-data'],
    'pluginOptions' => ['previewFileType' => 'any']
]);?>

    <div class="form-group">
        <?= Html::submitButton('Reserver', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-payement -->