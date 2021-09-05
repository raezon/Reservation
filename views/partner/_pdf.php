<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Partner */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Partners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partner-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Partner').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'description:ntext',
        'address',
        'tel',
        'fax',
        'web_site',
        'country',
        'city',
        'postal_code',
        'keywords',
        'email:email',
        'picture',
        [
                'attribute' => 'user.username',
                'label' => Yii::t('app', 'User')
            ],
        [
                'attribute' => 'category.name',
                'label' => Yii::t('app', 'Category')
            ],
        'status',
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
                'label' => Yii::t('app', 'Partner Category')
            ],
        'name',
        'price',
        'quantity',
        'product_type_id',
        'condition',
        'availability',
                'status',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerProduct,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Product')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnProduct
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerQuestionsPartner->totalCount){
    $gridColumnQuestionsPartner = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'questions.id',
                'label' => Yii::t('app', 'Questions')
            ],
                'status',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerQuestionsPartner,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Questions Partner')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnQuestionsPartner
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerSubscription->totalCount){
    $gridColumnSubscription = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'start_date',
        'end_date',
        'pack',
            ];
    echo Gridview::widget([
        'dataProvider' => $providerSubscription,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Subscription')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnSubscription
    ]);
}
?>
    </div>
</div>
