<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\money\MaskMoney;

/* @var $this yii\web\View */
/* @var $model app\models\ProductExtra */
/* @var $form yii\widgets\ActiveForm */
$geoip = new \lysenkobv\GeoIP\GeoIP();
$ip = $geoip->ip(Yii::$app->request->getUserIP()); // current user ip
$currencies = json_decode(file_get_contents('data.json'), true);
foreach ($currencies as $currency) {
    if (strtoupper($currency['country']) == strtoupper($ip->isoCode)) {
       $currencies_symbol= $currency['currency'];
    }
}
if(empty($currencies_symbol))
   $currencies_symbol="$";
   \Yii::$app->params['maskMoneyOptions']['prefix'] =  $currencies_symbol;
?>

<?php 
  $value=json_decode($model->extra,true);
  $model->description=$value[0]['Description'];
  $model->quantity=$value[0]['Quantity'];
  $model->price=$value[0]['Price'];
?>
<div class="product-extra-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true, 'placeholder' => 'Description']) ?>

    <?=    $form->field($model, 'quantity', [
                                'options' => [
                                    'tag' => 'div',
                                    'class' => '',
                                ]
                            ])->textInput([
                                 'placeholder' => 'Quantity',
                                 'type' => 'number'
                            ])?>

    <?=
        $form->field($model, "price")->widget(MaskMoney::classname(), [
        'name' => 'amount_ph_1',
        'value' => null,
        'options' => [
        'placeholder' => 'Enter a valid amount...',
        'style'=>'width:300 px'
        ],

        ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
