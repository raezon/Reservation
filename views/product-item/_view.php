<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use kartik\money\MaskMoney;
use app\models\ProductParent;
use app\models\ProductItem;

/* @var $this yii\web\View */
/* @var $model app\models\ProductItem */

$product=ProductItem::find()->andwhere(['id'=>$_GET['id']])->one();
$product_parent=ProductParent::find()->andwhere(['id'=>$product->product_id])->One();

if($product->partner_category=="6"){
	$name=json_decode($model->name,true);
	$this->title=$name[0];	
}else{
    $this->title=$model->name;
}

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
                'attribute' => 'partnerCategory.name',
                'label' => 'Partner Category',
            ],
            [
                'attribute' => 'product_id',
                'format' => 'html',
                'label' => 'Name society',
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
                
                'attribute' => 'name',
                'label' => 'Produit nom',
                'value' => function ($model) {
                        if ($model->partner_category != 6) {
                            
                            return $model->name;
                        }
                        if ($model->partner_category == 6) {
                            $name=json_decode( $model->name,true);
                            return $name[0];
                        }
                 }
            ],
            [
                'attribute' => 'temp',
                'label' => 'Produit nom',
                'value' => function ($model) {
                    if ($model->partner_category != 6) {
                            
                        return $model->temp;
                    }
                    if ($model->partner_category == 6) {
                        $temp=json_decode( $model->temp,true);
                        return $temp[0];
                    }
             }
            ],
            [
                'attribute' => 'description',
                'label' => 'Description',


            ],
            'people_number',


            [
                'attribute' => 'number_of_agent',

                'label' => 'Number Of Agent',
                'value' => $model->number_of_agent


            ],
            'quantity',
            'periode',
            [
                'attribute' => 'price',
                'format' => 'html',
                'label' => 'Price',
                'value' => function ($model) {
                    $price = $model->price . '' . $model->currencies_symbol;
                    return $price;
                },

            ],
            'currencies_symbol',
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
            [
                'attribute' => 'product_id',
                'format' => 'html',
                'label' => 'extra',
                'value' => function ($model) {

                    $product_parent = ProductParent::find()->andwhere(['id' => $model])->One();
                    $array_extra = "";
                    $i = 0;

                    $array_type_caters = json_decode($product_parent->extra, true);
                    if (!is_array($array_type_caters))
                        $array_type_caters = array();

                    foreach ($array_type_caters as $array_type_caters) {

                        if (array_key_exists('Description', $array_type_caters)) {
                            if ($array_type_caters['Description'] != '0')
                                $array_extra .= 'Description :' . $array_type_caters['Description'] . ",";
                        }
                        if (array_key_exists('Quantity', $array_type_caters)) {
                            if ($array_type_caters['Quantity'] != '0')
                                $array_extra .= $array_type_caters['Quantity'] . "<br>";
                        }
                        if (array_key_exists("Price", $array_type_caters)) {
                            if ($array_type_caters['Price'] != '0')
                                $array_extra .= "Price :" . $array_type_caters['Price'] . "<br>";
                        }
                        $i++;
                    }

                    return $array_extra;
                },
            ]

        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);
        ?>
    </div>
</div>