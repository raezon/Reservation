<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\ProductOption */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-option-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Product Option'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerProduct->totalCount){
    $gridColumnProduct = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'partnerCategory.name',
                'label' => 'Partner Category'
            ],
        'name',
        'description',
        'picture',
        'price',
        'currencies_symbol',
        'number_people',
        'quantity',
        'duration',
        [
                'attribute' => 'productType.id',
                'label' => 'Product Type'
            ],
                'condition',
        'availability',
        [
                'attribute' => 'partner.name',
                'label' => 'Partner'
            ],
        'extra',
        'status',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerProduct,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Product'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnProduct
    ]);
}
?>
    </div>
</div>
