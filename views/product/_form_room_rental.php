<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;
use kartik\money\MaskMoney;
/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'Options', 
        'relID' => 'options', 
        'value' => \yii\helpers\Json::encode($model->options),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'ReservationDetail', 
        'relID' => 'reservation-detail', 
        'value' => \yii\helpers\Json::encode($model->reservationDetails),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
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

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'partner_category')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\PartnerCategory::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Partner category')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true, 'placeholder' => 'Description']) ?>

    <?= $form->field($model, 'price')->widget(MaskMoney::classname(), [
       'name' => 'amount_ph_1',
      'value' => null,
      'options' => [
          'placeholder' => 'Enter a valid amount...',
      ],
      'pluginOptions' => [
          'prefix' => $currencies_symbol,
          'suffix' => '',
          'allowNegative' => false
      ]
])->label("Price");?>

     <?= $form->field($model, 'number_people')->textInput(['placeholder' => 'Numberof People'])->label('Number of people') ?>
    <?= $form->field($model, 'quantity')->textInput(['maxlength' => true, 'placeholder' => 'Quantity']) ?>
    <?php 
    $model->image=$model->picture;
?>
    <?= $form->field($model, 'image')->fileInput([]) ?>


    <?= $form->field($model, 'condition')->textInput(['maxlength' => true, 'placeholder' => 'Condition']) ?>

    <?= $form->field($model, 'availability')->textInput(['maxlength' => true, 'placeholder' => 'Availability']) ?>

    <?= $form->field($model, 'extra')->textInput(['maxlength' => true, 'placeholder' => 'Extra']) ?>
    <?php
        $user_id=User::getCurrentUser()->id;
        if($user_id==180){
            echo $form->field($model, 'status')->checkbox();
        }
     ?>
     
    

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
