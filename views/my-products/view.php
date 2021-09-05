<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= Yii::t('app', 'Product').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('app', 'PDF'), 
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => Yii::t('app', 'Will open the generated PDF file in a new window')
                ]
            )?>
            <?= Html::a(Yii::t('app', 'Save As New'), ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>            
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'price',
        'quantity',
        'type',
        'condition',
        'availability',
        [
            'attribute' => 'partner.name',
            'label' => Yii::t('app', 'Partner'),
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
if($providerOptions->totalCount){
    $gridColumnOptions = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            'name',
            'price',
                ];
    echo Gridview::widget([
        'dataProvider' => $providerOptions,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-options']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Options')),
        ],
        'columns' => $gridColumnOptions
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
                'attribute' => 'reservation.id',
                'label' => Yii::t('app', 'Reservation')
            ],
                        'quantity',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerReservationDetail,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-reservation-detail']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Reservation Detail')),
        ],
        'columns' => $gridColumnReservationDetail
    ]);
}
?>
    </div>
</div>