
<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use unclead\multipleinput\MultipleInput;
use kartik\money\MaskMoney;


include 'header.php';
include 'priceByLocation.php';
include 'jsStep3Correction.php';

?>
<?php $form = ActiveForm::begin([
  'options' => [
    'enctype' => 'multipart/form-data',
  ],
  'id' => 'dynamic-form',
  //      'enableAjaxValidation' => true,
  'enableClientValidation' => true,
  'method' => 'post',
  'action' => ['welcome/send']
]); ?>
<?php include 'first_part_step3.php' ?>
<div class="col-md-12" style="padding-bottom:50px">

  <div class="col-sm-4">
  <div>
    <div class="pull-left col-md-12">
      <a class="btn btn-sm " style="border: none;background:none;outline: none;color:#000000" id="2">
        <h4><span style="color:green; font-size: 20px;">+</span>Accept</h4>
      </a>
    </div>
  </div>

  <?= $form->field($model3, 'partner_category')->hiddenInput(['value' => 1])->label(false); ?>
  <?= Html::hiddenInput('category_id', \Yii::$app->request->get('category_id', 0)) ?>
  <div class="col-md-12">
    <div class="col-md-8">
      <label>Personal Event Cake</label>
    </div>
    <div class="col-md-4">
      <?= $form->field($model3, 'event_cake')->checkbox(['id' => 'remember-me-ver', 'custom' => true, 'value' => "event_cake", 'uncheckValue' => "vide"]) ?>
    </div>
  </div>
  <div class="col-md-12">
    <div class="col-md-8">
      <label>External Drink</label>
    </div>
    <div class="col-md-4">
      <?= $form->field($model3, 'drink')->checkbox(['id' => 'remember-me-ver', 'custom' => true, 'value' => "drink", 'uncheckValue' => "vide"]) ?>
    </div>
  </div>

  <div class="col-md-12">
    <div class="col-md-8">
      <label>External Food </label>
    </div>
    <div class="col-md-4">
      <?= $form->field($model3, 'External_food')->checkbox(['id' => 'remember-me-ver', 'custom' => true, 'value' => "External food", 'uncheckValue' => "vide"]) ?>
    </div>
  </div>

  <div class="col-md-12">
    <div class="col-md-8">
      <label>External Catering</label>
    </div>
    <div class="col-md-4">
      <?= $form->field($model3, 'Internal_Catering')->checkbox(['id' => 'remember-me-ver', 'custom' => true, 'value' => "Internal_Catering", 'uncheckValue' => "vide"]) ?>
    </div>
  </div>

  <div class="col-md-12">

    <div class="col-md-7">
      <a class="" id="other_c" style="border: none;background:none;outline: none;cursor:cell;"><b>+Other accept...</b></a>

      <?php
      echo "<div id='Possibilities_id'>";
      echo $form->field($model3, 'extra_p')->widget(MultipleInput::className(), [
        'max' => 4,
        'min' => 4,
        'columns' => [
          [
            'name'  => 'Possibility_check_name',
            'title' => 'Possibility Check Name',
          ],

          [
            'name'  => 'Possibility_check_name2',
            'title' => 'Possibility Check Name',
          ],


        ]
      ])->label('Add Other Accept');
      echo "</div >"; ?>
    </div>
  </div>

  </div>
<!Fin Partie Accept -------------------------------------------------------------------------------------------->

<div class="col-sm-3">
<div>
    <div class="pull-left col-md-12">
      <a class="btn btn-sm " style="border: none;background:none;outline: none;color:#000000" id="2">
        <h4><span style="color:green; font-size: 20px;">+</span>Facilities</h4>
      </a>
    </div>
  </div>

  <div class="col-md-12">
              <div class="col-md-8">
                <label>Wifi</label>
              </div>
              <div class="col-md-4">
                <?= $form->field($model3, 'Wifi')->checkbox(['id' => 'remember-me-ver', 'custom' => true, 'value' => "Wifi", 'uncheckValue' => "vide"]) ?>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-8">
                <label>Board</label>
              </div>
              <div class="col-md-4">
                <?= $form->field($model3, 'Board')->checkbox(['id' => 'remember-me-ver', 'custom' => true, 'value' => "Board", 'uncheckValue' => "vide"]) ?>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-8">
                <label>System Sound</label>
              </div>
              <div class="col-md-4">
                <?= $form->field($model3, 'System_Sound')->checkbox(['id' => 'remember-me-ver', 'custom' => true, 'value' => "System_Sound", 'uncheckValue' => "vide"]) ?>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-8">
                <label>Micro</label>
              </div>
              <div class="col-md-4">
                <?= $form->field($model3, 'Micro')->checkbox(['id' => 'remember-me-ver', 'custom' => true, 'value' => "Minimum_consumption_Price", 'uncheckValue' => "vide"]) ?>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-8">
                <label>Video Projector</label>
              </div>
              <div class="col-md-4">
                <?= $form->field($model3, 'Video_projector')->checkbox(['id' => 'remember-me-ver', 'custom' => true, 'value' => "Video_projector", 'uncheckValue' => "vide"]) ?>
              </div>
            </div>

            <div class="col-md-12">
              <div class="col-md-8">
                <label>Internal Catering</label>
              </div>
              <div class="col-md-4">
                <?= $form->field($model3, 'External_Catering')->checkbox(['id' => 'remember-me-ver', 'custom' => true, 'value' => "External_Catering", 'uncheckValue' => "vide"]) ?>
              </div>
            </div>
          
          <div class="col-md-12">
            <div class="col-md-9">
              <a class="" id="other_s" style="border: none;background:none;outline: none;cursor:cell;"><b>+Other facilities ...</b></a>
              <?php
              echo "<div id='Facilities_id'>";
              echo $form->field($model3, 'services_F')->widget(MultipleInput::className(), [
                'max' => 4,
                'min' => 4,
                'columns' => [
                  [
                    'name'  => 'Description',
                    'title' => 'Description',

                  ],
                  [
                    'name'  => 'Description2',
                    'title' => 'Description',

                  ],


                ]
              ])->label('Add other facilities included in the price');
              echo "</div >"; ?>
            </div>
          </div>
          <?php include "jsStep3-partner-registration-form2andother.php"; ?>


       
</div>
     
 <!--partie Transport-->
 <div class="col-sm-5">
 <div>
    <div class="pull-left col-md-12">
      <a class="btn btn-sm " style="border: none;background:none;outline: none;color:#000000" id="2">
        <h4><span style="color:green; font-size: 20px;">+</span>Transport</h4>
      </a>
    </div>
  </div>

  <div class="col-md-12">
  <div class="col-md-4">
                <?= Html::img("@web/img/parking_black.png", [
                  'class' => "img-fluid img-thumbnail", 'width' => '60px'
                ]) ?>
                <label>Parking lot</label>
              </div>
              <div class="col-md-3">
                </br>
                <?= $form->field($model3, 'Parking_lot')->checkbox(['id' => 'click1', 'custom' => true, 'value' => "Parking_lot", 'uncheckValue' => "vide"]) ?>
              </div>
              <div class="col-md-3">
                <?= $form->field($model3, 'Parking_lot_field')->textInput(['id' => 'field1', 'style' => 'width:280px', 'placeholder' => 'Name of park'])->label(''); ?>
              </div>

            </div>
            <div class="col-md-12">
              <div class="col-md-4">
                <?= Html::img("@web/img/subway.png", [
                  'class' => "img-fluid img-thumbnail", 'width' => '60px'
                ]) ?>
                <label>Subway</label>
              </div>
              <div class="col-md-3">
                </br>
                <?= $form->field($model3, 'Subway')->checkbox(['id' => 'click2', 'custom' => true, 'value' => "Subway", 'uncheckValue' => "vide"]) ?>
              </div>
              <div class="col-md-3">
                <?= $form->field($model3, 'Subway_field')->textInput(['id' => 'field2', 'style' => 'width:280px', 'placeholder' => 'Subway stations description or name'])->label(''); ?>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-4">
                <?= Html::img("@web/img/train2.png", [
                  'class' => "img-fluid img-thumbnail", 'width' => '60px'
                ]) ?>
                <label>Train</label>
              </div>
              <div class="col-md-3">
                </br>
                <?= $form->field($model3, 'Train')->checkbox(['id' => 'click3', 'custom' => true, 'value' => "Train", 'uncheckValue' => "vide"]) ?>
              </div>
              <div class="col-md-3">
                <?= $form->field($model3, 'Train_field')->textInput(['id' => 'field3', 'style' => 'width:2800px', 'placeholder' => 'Train stations description or name'])->label(''); ?>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-4">
                <?= Html::img("@web/img/bus_montpellier.png", [
                  'class' => "img-fluid img-thumbnail", 'width' => '60px'
                ]) ?>
                <label>Bus</label>
              </div>
              <div class="col-md-3">
                </br>
                <?= $form->field($model3, 'Bus')->checkbox(['id' => 'click4', 'custom' => 'true', 'value' => "Bus", 'uncheckValue' => "vide"]) ?>
              </div>
              <div class="col-md-3">
                <?= $form->field($model3, 'Bus_field')->textInput(['id' => 'field4', 'style' => 'width:280px', 'placeholder' => 'Bus stations description or name'])->label(''); ?>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-8">
                <a class="" id="other_m" style="border: none;background:none;outline: none;cursor:cell;"><b>+Other transport ...</b></a>
                <?php
                echo "<div id='Transport_id'>";
                echo $form->field($model3, 'extra_t')->widget(MultipleInput::className(), [
                  'max' => 8,
                  'min' => 8,
                  'columns' => [
                    [
                      'name'  => 'Transportation_name',
                      'title' => 'Transport Name',
                      'enableError' => true,
                      'options' => [
                        'class' => 'input-priority',
                        'placeholder' => 'Transport name'
                      ]
                    ],
                    [
                      'name'  => 'route number',
                      'title' => 'Route Number',
                      'enableError' => true,
                      'options' => [
                        'class' => 'input-priority',
                        'placeholder' => 'Transport Route'
                      ]
                    ],

                  ]
                ])->label('Add Other Transport');
                echo "</div >"; ?>
              </div>
            </div>
 </div>


 





            <?php include 'js.php'; ?>
            <div class="row">
              <div class="col-sm-12">
                <div class="text-center">
                  <?= Html::submitButton('Add an other product', ['class' => 'btn btn-lg btn-success','id'=>'ClickAdd']) ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-group">
                <div class="pull-right">
                  <?= Html::submitButton('Next', ['class' => 'btn btn-lg btn-info', 'id' => "id"]) ?>
                </div>
              </div>
              <div class="form-group">
                <div class="pull-left">
                  <?= Html::a('back', Url::to(['welcome/step', 'id' => 2, 'category_id' => Yii::$app->request->get('category_id', 0)]), ['class' => 'btn btn-lg btn-primary', 'data-method' => 'POST']) ?>
                </div>
              </div>
            </div>
          </div>


          <!---partie script pour room rental-->
          <?php include "jsStep3Correction.php" ?>
          <?php ActiveForm::end() ?>
        </div>

</div>