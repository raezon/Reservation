<?php
    use kartik\widgets\ActiveForm;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use kartik\widgets\Select2;
    use yii\web\JsExpression;
    use dosamigos\google\maps\LatLng;
    use dosamigos\google\maps\Map;
    use yii\helpers\ArrayHelper;
    use app\models\Product;
    use app\models\Plat;
    use yii\bootstrap\Progress;
    use yii\grid\GridView;
    use yii\bootstrap\Modal;
    use app\models\Other;
    use unclead\multipleinput\MultipleInput;
    use kartik\money\MaskMoney;
    use app\models\User;
    use app\models\Partner;
//partie des includes
   
    include 'js.php';

 ?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>
                <?php if ($user['id']): ?>
                    Update Type  <b><?php //echo $user['name'] ?></b>
                <?php else: ?>
                    Create new Type
                <?php endif ?>
            </h3>
        </div>
        <div class="card-body">

            <?php $form = ActiveForm::begin(); ?>
                  

                                <div class="form-group">
                    
                        <div>
        <div class="pull-left col-md-12">
               <a class="btn btn-sm " style="border: none;background:none;outline: none;color:#000000" id="2"><h4><span style="color:green; font-size: 20px;">+</span>Information</h4></a>
        </div>
    </div>
        <?= Html::hiddenInput('category_id', \Yii::$app->request->get('category_id', 0)) ?>
 <?php
  echo"<div class='col-md-12 '>";

     echo"<div class='col-md-6 '>";
      echo $form->field($model, 'area', [
                         'options' => [
                             'tag' => 'div',
                             'class' => '',
                         ]
                     ])->textInput([
                          'type' => 'number',
                     ])->label('Area m²');
      echo "</div>";
    /*-------------Cautioion Fields here ----------------------------------------------*/
      echo"<div class='col-md-6'>";
      echo $form->field($model, 'caution')->widget(MaskMoney::classname(), [
      'name' => 'amount_ph_1',
      'value' => null,
      'options' => [
        'placeholder' => 'Enter a valid amount...',
        
      ],
      'pluginOptions' => [
        'prefix' => '$ ',
        'suffix' => '',
        'allowNegative' => false
      ]
      ]);
      echo "</div>";
    echo "</div>";?>
    <!--First Part-->
    <div class="col-md-12">
        <div class="col-md-3">
             <label>Event Cake</label>
        </div>
         <div class="col-md-3">
             <?= $form->field($model, 'event_cake')->checkbox(['id' => 'remember-me-ver', 'custom' => true,'value'=>"event_cake", 'uncheckValue'=>"vide"]) ?>
        </div>
    </div>
      <div class="col-md-12">
        <div class="col-md-3">
             <label>Drink</label>
        </div>
         <div class="col-md-3">
             <?= $form->field($model, 'drink')->checkbox(['id' => 'remember-me-ver', 'custom' => true,'value'=>"drink", 'uncheckValue'=>"vide"]) ?>
        </div>
    </div>
      <div class="col-md-12">
        <div class="col-md-3">
             <label>External food </label>
        </div>
         <div class="col-md-3">
             <?= $form->field($model, 'External_food')->checkbox(['id' => 'remember-me-ver', 'custom' => true,'value'=>"External food", 'uncheckValue'=>"vide"]) ?>
        </div>
    </div>
      <div class="col-md-12">
        <div class="col-md-3">
             <label>External Catering</label>
        </div>
         <div class="col-md-3">
             <?= $form->field($model, 'External_Catering')->checkbox(['id' => 'remember-me-ver', 'custom' => true,'value'=>"External_Catering", 'uncheckValue'=>"vide"]) ?>
        </div>
    </div>
      <div class="col-md-12">
        <div class="col-md-3">
             <label>Internal Catering</label>
        </div>
         <div class="col-md-3">
             <?= $form->field($model, 'Internal_Catering')->checkbox(['id' => 'remember-me-ver', 'custom' => true,'value'=>"Internal_Catering", 'uncheckValue'=>"vide"]) ?>
        </div>
    </div>
      <div class="col-md-12">
        <div class="col-md-3">
             <label>Without guarantee</label>
        </div>
         <div class="col-md-3">
             <?= $form->field($model, 'Without_guarantee')->checkbox(['id' => 'remember-me-ver', 'custom' => true,'value'=>"Without_guarantee", 'uncheckValue'=>"vide"]) ?>
        </div>
    </div>
      <div class="col-md-12">
        <div class="col-md-3">
             </br>

             <label>Minimum consumption Price </label>

        </div>
         <div class="col-md-3">
             <?=
                $form->field($model, 'Minimum_consumption_Price')->widget(MaskMoney::classname(), [
              'name' => 'amount_ph_1',
              'value' => null,
              'options' => [
                'placeholder' => 'Enter a valid amount...',
                
              ],
              'pluginOptions' => [
                'prefix' => '$ ',
                'suffix' => '',
                'allowNegative' => false
              ]
              ]);
              ?>
              
        </div>
    </div>

<?php
$script = <<< JS
$(document).ready(function(){
  $("#2").click(function(){
    $("#partner-registration-form1").toggle();
  })
});
JS;
$this->registerJs($script); ?>

    <div class="">

    <div>
        <div class="pull-left col-md-12">
               <button class="btn btn-sm " style="background-color:transparent; border-color: #ffffff;" id="4"><h4><span style="color:green; font-size: 20px;">+</span>Other Services</h4></button>
               <div class="col-md-offset-1" id="form5">
               <div class="col-md-offset-1" id="form1">
                <button class="btn btn-sm " style="background-color:transparent; border-color: #ffffff;" id="3"><h4><span style="color:green; font-size: 20px;">+</span>Facilities</h4></button>

    <div class="col-md-12">
        <div class="col-md-3">
             <label>Wifi</label>
        </div>
        <div class="col-md-3">
             <?= $form->field($model, 'Wifi')->checkbox(['id' => 'remember-me-ver', 'custom' => true,'value'=>"Wifi",'uncheckValue'=>"vide"]) ?>
        </div>
    </div>
      <div class="col-md-12">
        <div class="col-md-3">
             <label>Board</label>
        </div>
        <div class="col-md-3">
             <?= $form->field($model, 'Board')->checkbox(['id' => 'remember-me-ver', 'custom' => true,'value'=>"Board",'uncheckValue'=>"vide"]) ?>
        </div>
    </div>
      <div class="col-md-12">
        <div class="col-md-3">
             <label>System Sound</label>
        </div>
       <div class="col-md-3">
             <?= $form->field($model, 'System_Sound')->checkbox(['id' => 'remember-me-ver', 'custom' => true,'value'=>"System_Sound",'uncheckValue'=>"vide"]) ?>
        </div>
    </div>
      <div class="col-md-12">
        <div class="col-md-3">
             <label>Micro</label>
        </div>
         <div class="col-md-3">
             <?= $form->field($model, 'Micro')->checkbox(['id' => 'remember-me-ver', 'custom' => true,'value'=>"Minimum_consumption_Price",'uncheckValue'=>"vide"]) ?>
        </div>
    </div>
       <div class="col-md-12">
        <div class="col-md-3">
             <label>Video projector</label>
        </div>
         <div class="col-md-3">
             <?= $form->field($model, 'Video_projector')->checkbox(['id' => 'remember-me-ver', 'custom' => true,'value'=>"Video_projector",'uncheckValue'=>"vide"]) ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-3">
        <a class="" id="other_s" style="border: none;background:none;outline: none;cursor:cell;"><b>+Other ...</b></a>
        <?php
        echo "<div id='Facilities_id'>";
         echo $form->field($model, 'extra_Facilities')->widget(MultipleInput::className(), [
    'max' => 4,
    'columns' => [
         [
            'name'  => 'Facilities_name',
            'title' => 'Facilities name',
            'enableError' => true,
            'options' => [
                'class' => 'input-priority'
            ]
        ],
    ]
 ])->label('Add Other Facilities');
        echo"</div >";?>
        </div>

    </div>
<?php
$script = <<< JS
$(document).ready(function(){
  $("#3").click(function(){
    $("#partner-registration-form2").toggle();
  })
});
JS;
$this->registerJs($script);
   ?>
               </div>
               <div class="col-md-offset-1">
                <button class="btn btn-sm " style="background-color:transparent; border-color: #ffffff;" id="5"><h4><span style="color:green; font-size: 20px;">+</span>Possibilities : Check </h4></button>


      <div class="col-md-12">
        <div class="col-md-3">
             <label>To bring back cake of the event</label>
        </div>
        <div class="col-md-3">
             <?= $form->field($model, 'To_bring_back_cake_of_the_event')->checkbox(['id' => 'remember-me-ver', 'custom' => true,'value'=>"To_bring_back_cake_of_the_event",'uncheckValue'=>"vide"]) ?>
        </div>
    </div>
      <div class="col-md-12">
        <div class="col-md-3">
             <label>To bring back drinks </label>
        </div>
        <div class="col-md-3">
             <?= $form->field($model, 'To_bring_back_drinks')->checkbox(['id' => 'remember-me-ver', 'custom' => true,'value'=>"To_bring_back_drinks",'uncheckValue'=>"vide"]) ?>
        </div>
    </div>
      <div class="col-md-12">
        <div class="col-md-3">
            <a class="" id="other_c" style="border: none;background:none;outline: none;cursor:cell;"><b>+Other ...</b></a>
            <?php
        echo "<div id='Possibilities_id'>";
         echo $form->field($model, 'extra_possiblity')->widget(MultipleInput::className(), [
    'max' => 4,
    'columns' => [
         [
            'name'  => 'Possibility_check_name',
            'title' => 'Possibility_check_name',
            'enableError' => true,
            'options' => [
                'class' => 'input-priority'
            ]
        ],
    ]
 ])->label('Add Other Possibility check');
        echo"</div >";?>
        </div>

    </div>
<?php
$script = <<< JS
$(document).ready(function(){
  $("#5").click(function(){
    $("#partner-registration-form3").toggle();
  })
});
JS;
$this->registerJs($script);?>
<?php
$script = <<< JS
$(document).ready(function(){
  $("#4").click(function(){
    $("#form5").toggle();
  })
});
JS;
$this->registerJs($script);
    //ActiveForm::end() ?>
               </div>
        <!--partie add-->
            <div class="col-md-offset-1">
                <button class="btn btn-sm " style="background-color:transparent; border-color: #ffffff;" id="6"><h4><span style="color:green; font-size: 20px;">+</span>Transport</h4></button>
                   <?php
                   //transport
                   /*$form = ActiveForm::begin([
                       'id' => 'partner-registration-form4',
                       'enableAjaxValidation' => false,
                       'enableClientValidation' => false,
                   ]); */?>
                 <div class="col-md-12">
                       <div class="col-md-3">
                         <?= Html::img("@web/img/parking_black.png", [
                                 'class'=>"img-fluid img-thumbnail", 'width'=>'70px' ]) ?>

                            <label>Parking lot</label>

                       </div>
                        <div class="col-md-3">
                           </br>
                              <?= $form->field($model, 'Parking_lot')->checkbox(['id' => 'click1', 'custom' => true,'value'=>"Parking_lot",'uncheckValue'=>"vide"]) ?>
                       </div>
                       <div class="col-md-3">
                              <?= $form->field($model, 'Parking_lot_field')->textInput(['id' => 'field1','style'=>'width:300px','placeholder'=>'Name of park'])->label('');?>
                       </div>

                   </div>
                       <div class="col-md-12">
                       <div class="col-md-3">
                         <?= Html::img("@web/img/subway.png", [
                                 'class'=>"img-fluid img-thumbnail", 'width'=>'60px' ]) ?>
                            <label>Subway</label>
                       </div>
                           <div class="col-md-3">
                               </br>
                              <?= $form->field($model, 'Subway')->checkbox(['id' => 'click2', 'custom' => true,'value'=>"Subway",'uncheckValue'=>"vide"]) ?>
                       </div>
                       <div class="col-md-3">
                              <?= $form->field($model, 'Subway_field')->textInput(['id' => 'field2','style'=>'width:300px','placeholder'=>'Subway stations description or name'])->label('');?>
                       </div>
                   </div>
                 <div class="col-md-12">
                       <div class="col-md-3">
                            <?= Html::img("@web/img/train2.png", [
                                 'class'=>"img-fluid img-thumbnail", 'width'=>'60px' ]) ?>
                                 <label>Train</label>
                       </div>
                           <div class="col-md-3">
                               </br>
                              <?= $form->field($model, 'Train')->checkbox(['id' => 'click3', 'custom' => true,'value'=>"Train",'uncheckValue'=>"vide"])?>
                       </div>
                       <div class="col-md-3">
                              <?= $form->field($model, 'Train_field')->textInput(['id' => 'field3','style'=>'width:300px','placeholder'=>'Train stations description or name'])->label('');?>
                       </div>
                   </div>
                     <div class="col-md-12">
                       <div class="col-md-3">
                         <?= Html::img("@web/img/bus_montpellier.png", [
                                 'class'=>"img-fluid img-thumbnail", 'width'=>'60px' ]) ?>
                            <label>Bus</label>
                       </div>
                           <div class="col-md-3">
                           </br>
                              <?= $form->field($model, 'Bus')->checkbox(['id' => 'click4', 'custom' => 'true','value'=>"Bus",'uncheckValue'=>"vide"]) ?>
                       </div>
                       <div class="col-md-3">
                              <?= $form->field($model, 'Bus_field')->textInput(['id' => 'field4','style'=>'width:300px','placeholder'=>'Bus stations description or name'])->label('');?>
                       </div>
                   </div>
                    <div class="invalid-feedback">
                        <?php //echo  $errors['name'] ?>
                    </div>
                </div>

           <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
