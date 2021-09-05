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
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Product').' '. Html::encode($this->title) ?></h2>
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
                'label' => Yii::t('app', 'Partner')
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
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Options')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
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
