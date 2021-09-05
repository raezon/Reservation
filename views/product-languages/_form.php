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

           <div class=row>
             <div class="col-sm-2">
                  <?= $form->field($model, 'Arabic')->checkbox(['value'=>"Arabic", 'uncheckValue'=>"vide"] ,false)->label("Arabic");?>
             </div>
              <div class="col-sm-2">
                   <?=  $form->field($model, 'Frensh')->checkbox(['value'=>"Frensh", 'uncheckValue'=>"vide"] ,false)->label("Frensh");?>
              </div>
          <div class="col-sm-2">
              <?=  $form->field($model, 'English')->checkbox(['value'=>"English", 'uncheckValue'=>"vide"] ,false)->label("English");?>
          </div>
           <div class="col-sm-2">
               <?=  $form->field($model, 'Deutsh')->checkbox(['value'=>"Deutsh", 'uncheckValue'=>"vide"] ,false)->label("Deutsh");?>
           </div>
          <div class="col-sm-2">
              <?=  $form->field($model, 'Japenesse')->checkbox(['value'=>"Japenesse", 'uncheckValue'=>"vide"] ,false)->label("Japenesse");?>
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
