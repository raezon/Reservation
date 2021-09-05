<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\ReservationOptions */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reservation Options'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservation-options-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Reservation Options').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'reservationDetail.id',
                'label' => Yii::t('app', 'Reservation Detail')
            ],
        [
                'attribute' => 'options.name',
                'label' => Yii::t('app', 'Options')
            ],
        'extra',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
