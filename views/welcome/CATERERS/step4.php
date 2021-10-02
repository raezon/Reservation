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
      <p>Pour finaliser votre inscription, merci de cocher les cases ci-dessous :
</p>
       <?= $form->field($model5, "condition1" ,['options' =>  ['class' => 'checkbox',
                                        'checkbox-success','style'=>'margin-top:55px;']])->checkbox(['value'=>"valid", 'uncheckValue'=>"unvalide"] ,false)->label("Je certifie que le service ou le bien est tout à fait légal et dispose de toutes les autorisations nécessaires que je peux fournir et présenter sur demande. CLICANGO EVENT, se réserve le droit de vérifier toutes les informations fournies pour cette inscription"); ?> 
       <label>
          
       </label>
     
  
    <?= $form->field($model5, "condition2" ,['options' =>  ['class' => 'checkbox',
                                        'checkbox-success','style'=>'margin-top:55px;']])->checkbox(['value'=>"valid", 'uncheckValue'=>"unvalide"] ,false)->label(" J'ai lu et j'accepte les conditions générales de service et la politique de confidentialité. En Algérie, les commissions perçues sur des plateformes telles que CLICANGO EVENT.com peuvent être soumises à des obligations fiscales et sociales. Il vous appartient donc de vous soumettre à toutes les déclarations nécessaires auprès des autorités compétentes. Pour plus d'informations, nous vous invitons à parcourir le site de l'administration fiscale et ceux des organismes sociaux."); ?>     
      

     

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

