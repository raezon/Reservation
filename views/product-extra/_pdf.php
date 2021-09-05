<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\ProductExtra */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Product Extras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-extra-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Product Extra'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'description',
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
