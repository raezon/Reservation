<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\ProductExtra */

//$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Product Extra', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-extra-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Product Extra'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
          
            
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
             [
            'attribute' => 'description',
            'format' => 'html',
            'label' => 'Description',
             'value' => function ($model) {
             

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
                return $model['0']['Price'].$model['currencies_symbol'];
              // 
                               

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