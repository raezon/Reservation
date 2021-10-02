<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use kartik\money\MaskMoney;
use app\models\ProductParent;

/* @var $this yii\web\View */
/* @var $model app\models\ProductItem */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Item', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-item-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Product Item' . ' ' . Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">

            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],

            [
                'attribute' => 'product_id',
                'format' => 'html',
                'label' => 'Nom bien',
                'value' => function ($model) {
                    $product_parent = ProductParent::find()->andwhere(['id' => $model->product_id])->One();
                    return $product_parent->name;
                },
            ],
            [
                'attribute' => 'product_id',
                'format' => 'html',
                'label' => 'Description',
                'value' => function ($model) {
                    $product_parent = ProductParent::find()->andwhere(['id' => $model->product_id])->One();
                    return $product_parent->description;
                },
            ],
          
            [
                'attribute' => 'temp',
                'label' => 'Produit nom',
            ],
            [
                'attribute' => 'description',
                'label' => 'Description',


            ],
            [
                'attribute' => 'people_number',
                'label' => 'Nombre perssone ',


            ],

            'quantity',
            [
                'attribute' => 'price',
                'format' => 'html',
                'label' => 'Price ',
                'value' => function ($model) {
                    $price = $model->price . '' .'Dzd';
                    return $price;
                },

            ],
            [
                'attribute' => 'picture',
                'format' => 'html',
                'label' => 'Image',
                'value' => function ($model) {
                    $img_name = (string)$model->picture;
                    $images = json_decode($model->picture, true);
                    $img_name = (string)$images[0];
                    return Html::img('img/products/' . $img_name, ['width' => 100, 'height' => 100]);
                },

            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'label' => 'Status',
                'value' => function ($model) {
                    if ($model->status == "0") {
                        $status = "not active";
                    } else {
                        $status = "active";
                    }
                    return $status;
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