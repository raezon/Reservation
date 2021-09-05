<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ReservationDetail */

$this->title = Yii::t('app', 'Create Reservation Detail');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reservation Detail'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservation-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
