<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\ReservationDetail */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reservation Detail'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservation-detail-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Reservation Detail').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'reservation.id',
                'label' => Yii::t('app', 'Reservation')
            ],
        [
                'attribute' => 'product.name',
                'label' => Yii::t('app', 'Product')
            ],
        'quantity',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerReservationOptions->totalCount){
    $gridColumnReservationOptions = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                [
                'attribute' => 'options.name',
                'label' => Yii::t('app', 'Options')
            ],
        'extra',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerReservationOptions,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Reservation Options')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnReservationOptions
    ]);
}
?>
    </div>
</div>
