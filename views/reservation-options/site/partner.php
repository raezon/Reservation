<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\bootstrap4\Html;
use kartik\widgets\ActiveForm;
//use yii\bootstrap4\ActiveForm;

$this->title = 'Become a Partner';
?>

<section class="pt-5 pb-5">
<div class="row">
    <div class="col mt-10 pt-5">
          <h3 class="text-center"><?= Yii::t('app','Sign up for free') ?></h3>
              <div class="row"><!-- class="row justify-content-center" -->
                  <div class="col-md-6 offset-md-3">
                      
                      <?php $form = ActiveForm::begin([
                          'id' => 'partner-registration-form',
//                                'enableAjaxValidation' => true,
                          'enableClientValidation' => true,                                  
                      ]); ?>

                      <?php if ($user->hasErrors()): ?>
                        <?= $form->errorSummary($user); ?>
                      <?php endif; ?>

                      <?= $form->field($user, 'username')->textInput(['maxlength' => true]) ?>

                      <?= $form->field($user, 'email') ?>

                      <?= $form->field($user, 'password')->passwordInput() ?>

                      <?= $form->field($user, 'repeat_password')->passwordInput() ?>

                      <?= $form->field($user, 'accept')->checkbox([
//                                'template' => "<div class=\"form-check mt-2\">{input} {label}\n{error}</div>",
                          'checked' => false,
                          'label' => '<label for="register-form-accept">Accept our <a target="_blank" href="'.Url::to(['/site/terms']).'">terms and conditions</a> ?</label>',
                          'required' => true
                          ]) ?>

                      <div class="form-group">
                          <div class="float-right">
                              <?= Html::submitButton(Yii::t('app', 'Create My Account'), 
                                      ['class' => 'btn btn-success']) ?>
                          </div>
                      </div>
                      <?php ActiveForm::end(); ?>
                    </div><!-- .col-md-6 .offset-md-3 -->
              </div><!-- .row -->

    </div><!-- .col .mt-10 .pt-5 -->
</div>
</section>

<?php
//$this->registerJsFile('@web/js/geolocate.js', ['position' => \yii\web\View::POS_LOAD]);
?>