<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductExtraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = 'Product Extra';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="product-extra-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
   
    <?php 

    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
            [
            'attribute' => 'description',
            'format' => 'html',
            'label' => 'Description',
             'value' => function ($model) {
            if(array_key_exists('Description', $model['0']))
                return $model['0']['Description'];
                
                               

            },

        ],
            [
            'attribute' => 'quantity',
            'format' => 'html',
            'label' => 'Quantity',
             'value' => function ($model) {
                
                if(array_key_exists('Quantity', $model['0']))
                     return $model['0']['Quantity'];
                
                               

            },

        ],
            [
            'attribute' => 'price',
            'format' => 'html',
            'label' => 'Price',
             'value' => function ($model) {
               
          if(array_key_exists('Price', $model['0']))
               return $model['0']['Price'].$model['currencies_symbol'];
              //  
                               

            },

        ],
        [
    'class' => 'yii\grid\ActionColumn',
    'template' => '{view}{update} {delete}',
    'buttons' => [
        'delete' => function($url, $model){
            return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete','id' => $model['id'],'category_id'=>$model['category_id']], [
                'class' => '',
                'data' => [
                    'confirm' => 'Are you absolutely sure ? You will lose all the information about this user with this action.',
                    'method' => 'post',
                ],
            ]);
        },
         'update' => function($url, $model){
            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $model['id'],'category_id'=>$model['category_id']], [
                'class' => '',
                'data' => [
                    
                    'method' => 'post',
                ],
            ]);
        },
         'view' => function($url, $model){
            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view','id' => $model['id'],'category_id'=>$model['category_id']], [
                'class' => '',
                'data' => [
                    
                    'method' => 'post',
                ],
            ]);
        },
    ]
],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-product-extra']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        'export' => false,
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Full',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">Export All Data</li>',
                    ],
                ],
                'exportConfig' => [
                    ExportMenu::FORMAT_PDF => false
                ]
            ]) ,
        ],
    ]); ?>

</div>
