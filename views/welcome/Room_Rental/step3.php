
<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use unclead\multipleinput\MultipleInput;
use kartik\money\MaskMoney;

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
]); ?><?php include 'first_part_step3.php' ?>
