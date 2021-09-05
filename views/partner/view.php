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
        <div class="col-sm-3" style="margin-top: 15px">
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
            
            <?= Html::a(Yii::t('app', 'Confirmate'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'label' => Yii::t('app', 'User'),
        ],
        [
            'attribute' => 'category.name',
            'label' => Yii::t('app', 'Category'),
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-product']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Product')),
        ],
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
    /*echo Gridview::widget([
        'dataProvider' => $providerQuestionsPartner,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-questions-partner']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Questions Partner')),
        ],
        'columns' => $gridColumnQuestionsPartner
    ]);*/
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-subscription']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Subscription')),
        ],
        'columns' => $gridColumnSubscription
    ]);
}
?>
    </div>
</div>