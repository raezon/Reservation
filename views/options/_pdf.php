<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Options */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Options'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="options-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Options').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'price',
        [
                'attribute' => 'product.name',
                'label' => Yii::t('app', 'Product')
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
if($providerReservationOptions->totalCount){
    $gridColumnReservationOptions = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'reservationDetail.id',
                'label' => Yii::t('app', 'Reservation Detail')
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
