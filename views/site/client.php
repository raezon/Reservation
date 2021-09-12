<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\bootstrap4\Html;
use kartik\widgets\ActiveForm;
//use yii\bootstrap4\ActiveForm;

$this->title = 'Devenir Modérateur';
?>

    <section class="pt-5 pb-5">
        <div class="row">
            <div class="col mt-10 pt-5">
                <h3 class="text-center"><?= Yii::t('app', 'Inscription Client') ?></h3>
                <div class="row">
                    <!-- class="row justify-content-center" -->
                    <div class="col-md-6 offset-md-3">

                        <?php $form = ActiveForm::begin([

                            //                                'enableAjaxValidation' => true,
                            'enableClientValidation' => true,
                        ]); ?>

                        <?php if ($user->hasErrors()) : ?>
                            <?= $form->errorSummary($user); ?>
                        <?php endif; ?>

                        <?= $form->field($user, 'username', ['labelOptions' => []])->textInput(['maxlength' => true]) ?>

                        <?= $form->field($user, 'email', ['labelOptions' => []]) ?>

                        <?= $form->field($user, 'password', ['labelOptions' => []])->passwordInput() ?>

                        <?= $form->field($user, 'repeat_password', ['labelOptions' => []])->passwordInput() ?>

                        <?= $form->field($user, 'accept')->checkbox([
                            //                                'template' => "<div class=\"form-check mt-2\">{input} {label}\n{error}</div>",
                            'checked' => false,
                            'label' => '<label for="register-form-accept">Accept our <a target="_blank" href="' . Url::to(['/site/terms']) . '">terms and conditions</a> ?</label>',
                            'required' => true
                        ]) ?>

                        <div class="form-group">
                            <div class="float-right">
                                <?= Html::submitButton(
                                    Yii::t('app', 'Créer mon compte'),
                                    ['class' => 'btn btn-success']
                                ) ?>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div><!-- .col-md-6 .offset-md-3 -->
                </div><!-- .row -->

            </div><!-- .col .mt-10 .pt-5 -->
        </div>
    </section>

