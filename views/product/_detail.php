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
            <h2><?= Html::encode($model->name) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'partnerCategory.name',
            'label' => Yii::t('app', 'Partner Category'),
        ],
        'name',
        'description',
        'price',
        'number_people',
        'quantity',
        'duration',
        'product_type_id',
        'product_option_id',
        'condition',
        'availability',
        [
            'attribute' => 'partner.name',
            'label' => Yii::t('app', 'Partner'),
        ],
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