<?php
//CATERERS
use kartik\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Progress;
use  app\views\welcome\widgets\NavStep;
?>

<?php $NavStep = new NavStep('step4'); ?>
<?php $NavStep->displayNav(); ?>
<?php $NavStep->displayProgress(50); ?>

<div class="row">
    
    <div class="col-md-12">
        
    <div class="page-header">
        <h4><?= $this->title ?></h4>
        
    </div>
    <?php $form = ActiveForm::begin([
        'id' => 'partner-registration-form',
//      'enableAjaxValidation' => true,
        'enableClientValidation' => true,  
        'action' =>['welcome/condition','id'=>5,'category_id'=>Yii::$app->request->get('category_id', 0)]                                
    ]); ?>
        
        <?= Html::hiddenInput('category_id', \Yii::$app->request->get('category_id', 0)) ?>
        

    <div> <!-- EN -->
      <p>To complete your registration, please tick the boxes below: </p>
       <?= $form->field($model5, "condition1" ,['options' =>  ['class' => 'checkbox',
                                        'checkbox-success','style'=>'margin-top:55px;']])->checkbox(['value'=>"valid", 'uncheckValue'=>"unvalide"] ,false)->label("I certify that the service or the property is completely legal and has all the necessary authorizations that I can provide and present on request. CLICANGO EVENT,
                                            reserves the right to verify all the information provided for this registration"); ?> 
       <label>
          
       </label>
     
  
    <?= $form->field($model5, "condition2" ,['options' =>  ['class' => 'checkbox',
                                        'checkbox-success','style'=>'margin-top:55px;']])->checkbox(['value'=>"valid", 'uncheckValue'=>"unvalide"] ,false)->label(" I have read and accept the <span>General Conditions</span> of Service and the <span>Privacy Policy.

      <label>In France, fees earned on platforms such as CLICANGO EVENT.com may be subject to tax and social obligations. It is
        therefore your responsibility to submit to all necessary declarations with the competent authorities. For more
        information, we invite you to browse the site of the <span>tax administration</span> and those of <span>social organizations."); ?>     
      

     

    </div>

 
 <div class="form-group">
        <div class="pull-right">
            <?= Html::submitButton('Next', ['class'=>'btn btn-lg btn-success']) ?>
            
        </div>
    </div>
     <div class="form-group">
        <div class="pull-left">
            <?=Html::a('back',Url::to(['welcome/step','id'=>3,'category_id'=>Yii::$app->request->get('category_id', 0)]),['class'=>'btn btn-lg btn-primary','data-method'=>'POST'])?>
        </div>
    </div>

        
    <?php ActiveForm::end() ?>
        
    </div><!-- .col-md-12 -->
    
</div><!-- .row -->

