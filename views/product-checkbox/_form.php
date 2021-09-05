<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;
/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    
   
           <div class=row>
             <div class="col-sm-1">
                  <?= $form->field($model, 'vegan')->checkbox(['value'=>"vegan", 'uncheckValue'=>"vide"] ,false)->label("vegan");?>
             </div>
              <div class="col-sm-2">
                   <?=  $form->field($model, 'Vegetarian')->checkbox(['value'=>"Vegetarian", 'uncheckValue'=>"vide"] ,false)->label("Vegetarian");?>
              </div>
          <div class="col-sm-2">
              <?=  $form->field($model, 'Organic')->checkbox(['value'=>"Organic", 'uncheckValue'=>"vide"] ,false)->label("Organic");?>
          </div>
           <div class="col-sm-2">
               <?=  $form->field($model, 'Gluten_free')->checkbox(['value'=>"Gluten_free", 'uncheckValue'=>"vide"] ,false)->label("Gluten_free");?>
           </div>
          <div class="col-sm-1">
              <?=  $form->field($model, 'Halal')->checkbox(['value'=>"Halal", 'uncheckValue'=>"vide"] ,false)->label("Halal");?>
          </div>
           <div class="col-sm-1">
               <?=  $form->field($model, 'Cacher')->checkbox(['value'=>"Cacher", 'uncheckValue'=>"vide"] ,false)->label("Cacher");?>
           </div>
           <div class="col-sm-2">
               <?=  $form->field($model, 'Without_porc')->checkbox(['value'=>"Without_porc", 'uncheckValue'=>"vide"] ,false)->label("Without_porc");?>
           </div>
           
           </div>
           
         
   
     

    

  

    

   

   

    

    

     
    

    <?php
    /*$forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Options')),
            'content' => $this->render('_formOptions', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->options),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'ReservationDetail')),
            'content' => $this->render('_formReservationDetail', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->reservationDetails),
            ]),
        ],
    ];
    echo kartik\tabs\TabsX::widget([
        'items' => $forms,
        'position' => kartik\tabs\TabsX::POS_ABOVE,
        'encodeLabels' => false,
        'pluginOptions' => [
            'bordered' => true,
            'sideways' => true,
            'enableCache' => false,
        ],
    ]);*/
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
