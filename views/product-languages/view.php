<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\ProductExtra */

//$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Product Languages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="product-extra-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Product Languages'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
          
            
        </div>
    </div>

    <div class="row">
        <?php 
    $gridColumn = [
    ['attribute' => 'id', 'visible' => false],
            [
            'attribute' => 'Arabic',
            'format' => 'html',
            'label' => 'Arabic',
             'value' => function ($model) {
                
                return $model["Arabic"];
                
                               

            },

        ],
        [
            'attribute' => 'Frensh',
            'format' => 'html',
            'label' => 'Frensh',
             'value' => function ($model) {
                
                return $model["Frensh"];
                
                               

            },

        ],
        [
            'attribute' => 'English',
            'format' => 'html',
            'label' => 'English',
             'value' => function ($model) {
                
                return $model["English"];
                
                               

            },

        ],
        [
            'attribute' => 'Deutsh',
            'format' => 'html',
            'label' => 'Deutsh',
             'value' => function ($model) {
                
                return $model["Deutsh"];
                
                               

            },

        ],
        [
            'attribute' => 'Japenesse',
            'format' => 'html',
            'label' => 'Japenesse',
             'value' => function ($model) {
                
                return $model["Japenesse"];
                
                               

            },

        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>


    </div>
</div>