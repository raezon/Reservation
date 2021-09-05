<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Reservation */

$this->title = Yii::t('app', 'Save As New {modelClass}: ', [
    'modelClass' => 'Reservation',
]). ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reservation'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Save As New');
?>
<div class="reservation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
