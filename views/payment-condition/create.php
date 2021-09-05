<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentCondition */

$this->title = 'Create Payment Condition';
$this->params['breadcrumbs'][] = ['label' => 'Payment Conditions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-condition-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
