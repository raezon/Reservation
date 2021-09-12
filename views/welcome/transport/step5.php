<?php
//CATERERS
use kartik\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Progress;
use app\views\welcome\widgets\NavStep;
?>

<?php $NavStep = new NavStep('step5'); ?>
<?php $NavStep->displayNav(); ?>
<?php $NavStep->displayProgress(80); ?>

<div class="row">

    <div class="col-md-12">

    <div class="page-header">
        <h4><?= $this->title ?></h4>

    </div>
  </div>
    <?php $form = ActiveForm::begin([
        'id' => 'partner-registration-form',
//      'enableAjaxValidation' => true,
        'enableClientValidation' => true,
    ]); ?>

        <?= Html::hiddenInput('category_id', \Yii::$app->request->get('category_id', 0)) ?>
        <div class="col-sm-12">
          <div class="col-sm-6">
             <?= $form->field($model3, 'IBAN')->textInput(['id'=>'autocomplete'])->label('IBAN') ?>
          </div>
          <div class="col-sm-6">
            <?= $form->field($model3, 'BIC_SWIFT')->textInput(['id'=>'autocomplete'])->label('BIC/SWIFT') ?>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="col-sm-6">
            <?= $form->field($model3, 'Bank_name')->textInput(['id'=>'autocomplete'])->label('Bank name') ?>
          </div>
          <div class="col-sm-6"><?= $form->field($model3, 'Bank_country')->textInput(['id'=>'autocomplete'])->label('Bank country') ?></div>
        </div>
        <div class="col-sm-12">
          <div class="col-sm-6">
              <?= $form->field($model3, 'File')->fileInput(['style'=>'width:500px'])->label('Add file') ?>
          </div>
        </div>

       
        
        
        
      
        

       
      
     <div class="form-group">
        <div class="pull-right">
            <?=Html::a('Next',Url::to(['welcome/step','id'=>6,'category_id'=>Yii::$app->request->get('category_id', 0)]),['class'=>'btn btn-lg btn-success','data-method'=>'POST'])?>
        </div>
    </div>
    <div class="form-group">
        <div class="pull-left">
            <?=Html::a('back',Url::to(['welcome/step','id'=>4,'category_id'=>Yii::$app->request->get('category_id', 0)]),['class'=>'btn btn-lg btn-primary','data-method'=>'POST'])?>
        </div>
    </div>

    <?php ActiveForm::end() ?>


   

</div><!-- .row -->
