<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\User;
use app\models\Partner;
use app\models\PaymentCondition;

$this->title = 'General Information';

/* @var $this yii\web\View */
$session = Yii::$app->session;
$session->open(); // open a session
if ($session['refresh'] == 1) {
  $session['refresh'] = 2;
  Yii::$app->response->redirect(Url::to(['welcome/index'], true));
}

?>
<style>
  ::placeholder {
    color: green;
  }
</style>

<div class="row">

  <div class="col-md-12">

    <div class="page-header">
      <h4><?= Yii::t('app', 'What type of business would you like to register?') ?></h4>
    </div>

    <div class="row">
      <?php

      ?>
      <?php foreach ($categories as $category) : ?>
        <?php if ($category->id != 8) { ?>

          <div class="col-xs-18 col-sm-6 col-md-3">
            <div class="thumbnail text-center">
              <?= Html::img("@web/uploads/" . $category->getDirectoryName() . ".png", [
                'class' => "img-fluid img-thumbnail", 'width' => '100px'
              ]) ?>
              <div class="caption">
                <h4><?= $category->name ?></h4>
                <p><?= $category->description ?></p>
                <div class="text-center">
                  <?php
                  $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();

                  $allez_directement_a_letape3 = 0;


                  $id = 0;
                  if ($partner->city != "xxxx") {
                    $allez_directement_a_letape3 = 1;
                  }

                  if ($allez_directement_a_letape3 == 1) {
                    $id = 3; ?>

                    <a href="<?= Url::to(['welcome/step', 'id' => '3', 'category_id' => $category->id]) ?>" class="btn btn-primary"><?= Yii::t('app', 'Register your business') ?></a>
                  <?php
                  } else {
                  ?>
                    <a href="<?= Url::to(['welcome/category', 'id' => $category->id]) ?>" class="btn btn-primary"><?= Yii::t('app', 'Register your business') ?></a>
                  <?php
                  }
                  ?>



                  <?php // $form = ActiveForm::begin(['action' => ['welcome/category'], 'options'=>['method' => 'post']]); 
                  ?>
                  <?php // echo Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken)? 
                  ?>
                  <?php //echo Html::hiddenInput('category_id', $category->id) 
                  ?>
                  <?php //echo Html::submitButton(Yii::t('app','Register your business'), ['class' => 'btn btn-primary', 'role' => 'button']) 
                  ?>
                  <?php // ActiveForm::end(); 
                  ?>
                </div>
              </div>
            </div>
          </div>
        <?php
        }
       
        ?>
      <?php endforeach; ?>

    </div>

  </div>

</div>
