<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;
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

    <?= $form->field($model, 'price')->textInput(['maxlength' => true, 'placeholder' => 'Price']) ?>

    <?= $form->field($model, 'number_people')->textInput(['placeholder' => 'Number People']) ?>

    <?= $form->field($model, 'quantity')->textInput(['maxlength' => true, 'placeholder' => 'Quantity']) ?>

    <?= $form->field($model, 'duration')->textInput(['placeholder' => 'Duration']) ?>

    <?= $form->field($model, 'product_type_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\ProductType::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Product type')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'product_option_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\ProductOption::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Product option')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    <?php 
    $model->image=$model->picture;
?>
    <?= $form->field($model, 'image')->fileInput([]) ?>
    <?= $form->field($model, 'condition')->textInput(['maxlength' => true, 'placeholder' => 'Condition']) ?>

    <?= $form->field($model, 'availability')->textInput(['maxlength' => true, 'placeholder' => 'Availability']) ?>

    <?= $form->field($model, 'partner_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Partner::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Partner')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'extra')->textInput(['maxlength' => true, 'placeholder' => 'Extra']) ?>
    <?php
        $user_id=User::getCurrentUser()->id;
        if($user_id==1){
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
