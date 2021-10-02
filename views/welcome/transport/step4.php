<?php
//CATERERS
use kartik\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Progress

//$this->title = 'General Information';
/* @var $this yii\web\View */
?>
<div class="row">
    <div class="col-md-2">
        <h4>General Information</h4>
    </div>
    <div class="col-md-3">
        <h4>Availability and Displacement</h4>
    </div>
    <div class="col-md-2">
        <h4>Service and Prices</h4>
    </div>
    <div class="col-md-1">
        <h4 style="color:green;"><b>Conditions</b></h4>
    </div>
    <div class="col-md-2">
        <h4>Payments</h4>
    </div>
    <div class="col-md-2">
        <h4>Messages</h4>
    </div>
</div>
<?php
echo Progress::widget([
    'percent' => 60,
    'barOptions' => ['class' => 'progress-bar-success'],
    'options' => ['class' => 'active progress-striped']
]);?>

<div class="row">
    
    <div class="col-md-12">
        
    <div class="page-header">
        <h4><?= $this->title ?></h4>
        
    </div>
    <?php $form = ActiveForm::begin([
        'id' => 'partner-registration-form',
//      'enableAjaxValidation' => true,
        'enableClientValidation' => true,                                  
    ]); ?>
        
        <?= Html::hiddenInput('category_id', \Yii::$app->request->get('category_id', 0)) ?>
        

    <div> <!-- EN -->
      <p>Pour finaliser votre inscription, merci de cocher les cases ci-dessous :
: </p>
       <?= $form->field($model3, "extra" ,['options' =>  ['class' => 'checkbox',
                                        'checkbox-success','style'=>'margin-top:55px;']])->checkbox(['value'=>"vegan", 'uncheckValue'=>"vide"] ,false)->label("Je certifie que le service ou le bien est tout à fait légal et dispose de toutes les autorisations nécessaires que je peux fournir et présenter sur demande, se réserve le droit de vérifier toutes les informations fournies pour cette inscription"); ?> 
       <label>
          
       </label>
     
  
    <?= $form->field($model3, "min" ,['options' =>  ['class' => 'checkbox',
                                        'checkbox-success','style'=>'margin-top:55px;']])->checkbox(['value'=>"vegan", 'uncheckValue'=>"vide"] ,false)->label(" J'ai lu et j'accepte les conditions générales de service et la politique de confidentialité. En Algérie, les commissions perçues sur des plateformes telles que CLICANGO EVENT.com peuvent être soumises à des obligations fiscales et sociales. Il vous appartient donc de vous soumettre à toutes les déclarations nécessaires auprès des autorités compétentes. Pour plus d'informations, nous vous invitons à parcourir le site de l'administration fiscale et ceux des organismes sociaux."); ?>     
      

     

    </div>

 
 <div class="form-group">
        <div class="pull-right">
            <?=Html::a('Next',Url::to(['welcome/step','id'=>5,'category_id'=>Yii::$app->request->get('category_id', 0)]),['class'=>'btn btn-lg btn-success','data-method'=>'POST'])?>
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

