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
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?php //echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?php /*/*echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) */ ?>
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
        'country',
        'city',
//        [
//            'attribute' => 'user.username',
//            'label' => Yii::t('app', 'User'),
//        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-payment']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' .
            Html::encode(Yii::t('app', 'Payment')),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-reservation-detail']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' .
            Html::encode(Yii::t('app', 'Reservation Detail')),
        ],
        'columns' => $gridColumnReservationDetail
    ]);
}
?>
    </div>
</div>