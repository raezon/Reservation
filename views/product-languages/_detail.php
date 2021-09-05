<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

?>
<div class="product-view">

    <div class="row">
        <div class="col-sm-9">
            
        </div>
    </div>

    <div class="row">

<?php 

    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
       
        
         [
                
                'label' => Yii::t('app', 'Description'),
                'value' => 5,
               

            ],
        'quantity',
        'price',
        
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>