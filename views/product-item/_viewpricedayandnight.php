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
            'name',
            [
                'attribute' => 'temp',
                'label' => 'Produit nom',
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
                'label' => 'Price ',
                'value' => function ($model) {
                    $price = $model->price . '' . $model->currencies_symbol;
                    return $price;
                },

            ],
            'currencies_symbol',
            [
                'attribute' => 'languages',
                'format' => 'html',
                'value' => function ($model) {
                    $food_type_array = "";
                    $product_parent = ProductParent::find()->andwhere(['id' => $model->product_id])->One();
                    if ($product_parent->partner_category == '7') {
                        $array_type_caters = json_decode($model->languages, true);
                        if (array_key_exists('Arabic', $array_type_caters)) {
                            if ($array_type_caters['Arabic'] != '0')
                                $food_type_array .= $array_type_caters['Arabic'] . "<br>";
                        }
                        if (array_key_exists('Frensh"', $array_type_caters)) {
                            if ($array_type_caters['Frensh"'] != '0')
                                $food_type_array .= $array_type_caters['Frensh'] . "<br>";
                        }
                        if (array_key_exists("English", $array_type_caters)) {
                            if ($array_type_caters['English'] != '0')
                                $food_type_array .= $array_type_caters['English'] . "<br>";
                        }
                        if (array_key_exists("Deutsh", $array_type_caters)) {
                            if ($array_type_caters['Deutsh'] != '0')
                                $food_type_array .= $array_type_caters['Deutsh'] . "<br>";
                        }
                        if (array_key_exists("Japenesse", $array_type_caters)) {
                            if ($array_type_caters['Japenesse'] != '0')
                                $food_type_array .= $array_type_caters['Japenesse'] . "<br>";
                        }
                        return $food_type_array;
                    }
                    return "empty";
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
            [
                'attribute' => 'product_id',
                'format' => 'html',
                'label' => 'extra',
                'value' => function ($model) {

                    $product_parent = ProductParent::find()->andwhere(['id' => $model])->One();
                    $array_extra = "";
                    $i = 0;
                    $array_type_caterss = json_decode($product_parent->extra, true);
                    if (!is_array($array_type_caterss))
                        $array_type_caterss = array();

                    foreach ($array_type_caterss as $array_type_caters) {

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