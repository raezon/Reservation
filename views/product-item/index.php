<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\User;

$this->title = 'Product Item';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="product-item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <div class="search-form" style="display:none">
        <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <?php Pjax::begin(['id' => 'id-pjax']); ?>
    <?php

    ?>
    <?php

    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'partner_category',
            'label' => 'Partner Category',
            'value' => function ($model) {

                return $model->partnerCategory->name;
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\app\models\PartnerCategory::find()->asArray()->all(), 'id', 'name'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Partner category', 'id' => 'grid-product-item-search-partner_category']
        ],
        [
            'attribute' => 'name',
            'label' => 'name',
            'value' => function ($model) {
                $etat = 'active';
                if ($model->partner_category != 3) {
                   
                    if ($model->partner_category == 1) {
                        $name=json_decode( $model->temp,true);
                        return $name[0];
                    }
                    if ($model->partner_category == 6) {
                        $name=json_decode( $model->name,true);
                        return $name[0];
                    }
                    return $model->name;
                } else {
                  
                    return $model->product_type;
                }
            },

        ],
       /* [
            'attribute' => 'temp',
            'label' => 'Produit nom',
            'value' => function ($model) {
                $etat = 'active';
                if ($model->partner_category == 1 ) {
                   
                    $temp=json_decode( $model->description,true);
                    return $temp[0];
                    
                } else if( $model->partner_category == 6){
                    $temp=json_decode( $model->temp,true);
                    return $temp[0];
                }
                else {
                    
                    return $model->temp;
                }
            },
        ],*/
        'price',
        [
            'attribute' => 'currencies_symbol',
            'label' => 'currencies'
        ],
        [
            'attribute' => 'picture',
            'format' => 'html',
            'label' => 'Image',
            'value' => function ($model) {
                $img_name = (string)$model->picture;
                // if ($model->partner_category == 4) {
                $images = json_decode($model->picture, true);
                if (is_array($images))
                    $img_name = (string)$images[0];
                else
                    $img_name = (string)$model->picture;
                // }

                return Html::img('img/products/' . $img_name, ['width' => 100, 'height' => 100]);
            },

        ],
        [
            'attribute' => 'status',
            'label' => 'Status',
            'value' => function ($model) {
                $etat = 'active';
                if ($model->status == 0) {
                    $etat = 'not active';
                } else {
                    $etat = 'active';
                }
                return $etat;
            },

        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}{update}{confirm} {delete}',
            'visible' => User::isAdmin(),
            'buttons' => [
                'delete' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id], [
                        'class' => '',
                        'data' => [
                            'confirm' => 'Are you absolutely sure ? You will lose all the information about this user with this action.',
                            'method' => 'post',
                        ]
                    ]);
                },
                'update' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $model->id], [
                        'class' => '',
                        'data' => [

                            'method' => 'post',
                        ],
                    ]);
                },
                'view' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view', 'id' => $model->id],  [
                        'class' => '',
                        'data' => [

                            'method' => 'post',
                        ],
                    ]);
                },
                'confirm' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-ok"></span>', ['confirm', 'id' => $model->id],  [
                        'class' => '',
                        'data' => [

                            'method' => 'post',
                        ],
                    ]);
                },

            ]
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}{update}{confirm} {delete}',
            'visible' => !User::isGuest() && !User::isAdmin(),
            'buttons' => [
                'delete' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id], [
                        'class' => '',
                        'data' => [
                            'confirm' => 'Are you absolutely sure ? You will lose all the information about this user with this action.',
                            'method' => 'post',
                        ]
                    ]);
                },
                'update' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $model->id], [
                        'class' => '',
                        'data' => [

                            'method' => 'post',
                        ],
                    ]);
                },
                'view' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view', 'id' => $model->id],  [
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
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-product-item']],
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
            ]),
        ],
    ]); ?>
    <?php Pjax::end(); ?>
    <?php
    $this->registerJs("
    $(document).on('ready pjax:success', function() {
        $('.pjax-delete-link').on('click', function(e) {
            e.preventDefault();
            var deleteUrl = $(this).attr('delete-url');
            var pjaxContainer = $(this).attr('pjax-container');
            var result = confirm('Delete this item, are you sure?');                                
            if(result) {
                $.ajax({
                    url: deleteUrl,
                    type: 'post',
                    error: function(xhr, status, error) {
                        alert('There was an error with your request.' + xhr.responseText);
                    }
                }).done(function(data) {
                    $.pjax.reload('#' + $.trim(pjaxContainer), {timeout: 3000});
                });
            }
        });

    });
");

    ?>
</div>