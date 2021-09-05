<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ReservationOptions */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Reservation Options',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reservation Options'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="reservation-options-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
