<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'General Information';

/* @var $this yii\web\View */
?>

<div class="row">
    
    <div class="col-md-12">
        
        <div class="page-header">
            <h4><?= Yii::t('app','What type of business would you like to register?') ?></h4>
        </div>
        
        <div class="row">
<?php foreach ($categories as $category): ?>
        <div class="col-xs-18 col-sm-6 col-md-3">
          <div class="thumbnail text-center">
              <?= Html::img("@web/uploads/".$category->getDirectoryName().".png", [
                  'class'=>"img-fluid img-thumbnail", 'width'=>'100px' ]) ?>
              <div class="caption">
                <h4><?= $category->name ?></h4>
                <p><?= $category->description ?></p>
                <div class="text-center">
                    <a href="<?= Url::to(['welcome/category', 'id' => $category->id]) ?>" 
                       class="btn btn-primary"><?= Yii::t('app','Register your business') ?></a>
                    <?php // $form = ActiveForm::begin(['action' => ['welcome/category'], 'options'=>['method' => 'post']]); ?>
                    <?php // echo Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken)? ?>
                    <?php //echo Html::hiddenInput('category_id', $category->id) ?>
                    <?php //echo Html::submitButton(Yii::t('app','Register your business'), ['class' => 'btn btn-primary', 'role' => 'button']) ?>
                    <?php // ActiveForm::end(); ?>
                </div>
            </div>
          </div>
        </div>
<?php endforeach; ?>
            
        </div>
        
    </div>
    
</div>