<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Reservation */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reservation'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservation-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Reservation').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'reservation_date',
        'start_date',
        'end_date',
        'status',
        'observation:ntext',
        [
                'attribute' => 'user.username',
                'label' => Yii::t('app', 'User')
            ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerPayment->totalCount){
    $gridColumnPayment = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'payment_date',
        'amount',
        'status',
            ];
    echo Gridview::widget([
        'dataProvider' => $providerPayment,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Payment')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnPayment
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerReservationDetail->totalCount){
    $gridColumnReservationDetail = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                [
                'attribute' => 'product.name',
                'label' => Yii::t('app', 'Product')
            ],
        'quantity',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerReservationDetail,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Reservation Detail')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnReservationDetail
    ]);
}
?>
    </div>
</div>
