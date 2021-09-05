<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = Yii::t('app', 'Product');
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>


<?php
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
     
        'name',
        'description',
           [
            'attribute' => 'price',
            'format' => 'html',
            'label' => 'Image',
             'value' => function ($model) {
                                $price=$model->price.''.$model->currencies_symbol;
                return $price;

            },

        ],
           [
            'attribute' => 'picture',
            'format' => 'html',
            'label' => 'Image',
             'value' => function ($model) {
                                $img_name=(string)$model->picture;
                return Html::img('http://localhost/clicangoevent/mainrepo/web/img/products/'.$img_name,['width'=>100,'height'=>100]);

            },

        ],
        [
                'attribute' => 'status',
                'label' => 'Status',
                'value' => function($model){
                    $etat='active';
                    if($model->status==0){
                        $etat='not active';
                    }else{
                        $etat='active'; 
                    }
                    return $etat;
                },
               
            ],
        [
            'class' => 'yii\grid\ActionColumn',
        ],
    ];
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-product']],
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
