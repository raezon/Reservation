<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ReservationOptions */

$this->title = Yii::t('app', 'Create Reservation Options');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reservation Options'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservation-options-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
