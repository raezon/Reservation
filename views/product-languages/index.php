<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductExtraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = 'Product Languages';
$this->params['breadcrumbs'][] = $this->title;



?>
<div class="product-Languages-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   
    <?php 

    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
       
         [
            'attribute' => 'id',
            'format' => 'html',
            'label' => 'Arabic',
             'value' => function ($model) {
               // print_r($model);
               // die();
                if(array_key_exists("id", $model))
                return $model["id"];
               // die();
                               

            },

        ],
            [
            'attribute' => 'Arabic',
            'format' => 'html',
            'label' => 'Arabic',
             'value' => function ($model) {
                  if(array_key_exists("Arabic", $model))
                    if($model["Arabic"]=="0")
                        return "not spoken ";
                    return $model["Arabic"];
                
                               

            },

        ],
        [
            'attribute' => 'Frensh',
            'format' => 'html',
            'label' => 'Frensh',
             'value' => function ($model) {
                  if(array_key_exists('Frensh', $model))
                     if($model["Frensh"]=="0")
                        return "not spoken ";
                    return $model["Frensh"];
                
                               

            },

        ],
        [
            'attribute' => 'English',
            'format' => 'html',
            'label' => 'English',
             'value' => function ($model) {
                 if(array_key_exists('English', $model))
                    if($model["English"]=="0")
                        return "not spoken ";
                    return $model["English"];
                
                               

            },

        ],
        [
            'attribute' => 'Deutsh',
            'format' => 'html',
            'label' => 'Deutsh',
             'value' => function ($model) {
                 if(array_key_exists('Deutsh', $model))
                    if($model["Deutsh"]=="0")
                        return "not spoken ";
                   return $model["Deutsh"];
                
                               

            },

        ],
        [
            'attribute' => 'Japenesse',
            'format' => 'html',
            'label' => 'Japenesse',
             'value' => function ($model) {
                if(array_key_exists('Japenesse', $model)) 
                    if($model["Japenesse"]=="0")
                        return "not spoken ";
                return $model["Japenesse"];
                
                               

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
