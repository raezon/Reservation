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
      <p>To complete your registration, please tick the boxes below: </p>
       <?= $form->field($model3, "extra" ,['options' =>  ['class' => 'checkbox',
                                        'checkbox-success','style'=>'margin-top:55px;']])->checkbox(['value'=>"vegan", 'uncheckValue'=>"vide"] ,false)->label("I certify that the service or the property is completely legal and has all the necessary authorizations that I can provide and present on request. CLICANGO EVENT,
                                            reserves the right to verify all the information provided for this registration"); ?> 
       <label>
          
       </label>
     
  
    <?= $form->field($model3, "min" ,['options' =>  ['class' => 'checkbox',
                                        'checkbox-success','style'=>'margin-top:55px;']])->checkbox(['value'=>"vegan", 'uncheckValue'=>"vide"] ,false)->label(" I have read and accept the <span>General Conditions</span> of Service and the <span>Privacy Policy.

      <label>In France, fees earned on platforms such as CLICANGO EVENT.com may be subject to tax and social obligations. It is
        therefore your responsibility to submit to all necessary declarations with the competent authorities. For more
        information, we invite you to browse the site of the <span>tax administration</span> and those of <span>social organizations."); ?>     
      

     

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

