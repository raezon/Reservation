<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->partnerCategorySurveys,
        'key' => function($model){
            return ['partner_category_id' => $model->partner_category_id, 'surveys_id' => $model->surveys_id];
        }
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        'title',
        [
                'attribute' => 'partnerCategory.name',
                'label' => Yii::t('app', 'Partner Category')
            ],
        [
            'class' => 'yii\grid\ActionColumn',
            'controller' => 'partner-category-surveys'
        ],
    ];
    
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'containerOptions' => ['style' => 'overflow: auto'],
        'pjax' => true,
        'beforeHeader' => [
            [
                'options' => ['class' => 'skip-export']
            ]
        ],
        'export' => [
            'fontAwesome' => true
        ],
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'showPageSummary' => false,
        'persistResize' => false,
    ]);
