<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->products,
        'key' => 'id'
    ]);
    $gridColumns = [
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
        [
            'class' => 'yii\grid\ActionColumn',
            'controller' => 'product'
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
