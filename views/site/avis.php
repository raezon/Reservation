<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Avis */
/* @var $form ActiveForm */
?>
<div class="site-avis">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'commentaire') ?>
        <?= $form->field($model, 'note') ?>
        <?= $form->field($model, 'date') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-avis -->
