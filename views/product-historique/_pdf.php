<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\ProductHistorique */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Historiques'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-historique-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Product Historique').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'partner_category',
        'name',
        'description',
        'picture',
        'price',
        'number_people',
        'quantity',
        'duration',
        'product_type_id',
        'product_option_id',
        'condition',
        'availability',
        'partner_id',
        'extra',
        'status',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
