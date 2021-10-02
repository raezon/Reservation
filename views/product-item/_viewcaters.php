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
                'label' => 'Nom du bien',
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
                'attribute' => 'product_type',
                'label' => 'Repat Nom',


            ],
            [
                'attribute' => 'name',
                'label' => 'Repat',
                'value' => function ($model) {
                    return $model->name;
                },
            ],
            [
                'attribute' => 'temp',
                'label' => 'chaud/froid',
            ],

            'people_number',
            'quantity',
            [
                'attribute' => 'price',
                'format' => 'html',
                'label' => 'Price',
                'value' => function ($model) {
                    $price = $model->price . '' . 'Dzd';
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

                    return Html::img('img/products/' . $img_name, ['width' => 100, 'height' => 100]);
                },

            ],
            [
                'attribute' => 'checkbox',
                'format' => 'html',
                'label' => 'Food',
                'value' => function ($model) {
                    if ($model->partner_category == 3) {
                        $food_type_array = "";

                        $array_type_caters = json_decode($model->checkbox, true);
                        if (array_key_exists('vegan', $array_type_caters)) {
                            if ($array_type_caters['vegan'] != '0')
                                $food_type_array .= $array_type_caters['vegan'] . "<br>";
                        }
                        if (array_key_exists('Vegetarian', $array_type_caters)) {
                            if ($array_type_caters['Vegetarian'] != '0')
                                $food_type_array .= $array_type_caters['Vegetarian'] . "<br>";
                        }
                        if (array_key_exists("Gluten_free", $array_type_caters)) {
                            if ($array_type_caters['Gluten_free'] != '0')
                                $food_type_array .= $array_type_caters['Gluten_free'] . "<br>";
                        }
                        if (array_key_exists("Halal", $array_type_caters)) {
                            if ($array_type_caters['Halal'] != '0')
                                $food_type_array .= $array_type_caters['Halal'] . "<br>";
                        }
                        if (array_key_exists("Casher", $array_type_caters)) {
                            if ($array_type_caters['Casher'] != '0')
                                $food_type_array .= $array_type_caters['Casher'] . "<br>";
                        }
                        if (array_key_exists("Organic", $array_type_caters)) {
                            if ($array_type_caters['Organic'] != '0')
                                $food_type_array .= $array_type_caters['Organic'] . "<br>";
                        }
                        if (array_key_exists("Without_porc", $array_type_caters)) {
                            if ($array_type_caters['Without_porc'] != '0')
                                $food_type_array .= $array_type_caters['Without_porc'] . "<br>";
                        }
                        return $food_type_array;
                    }
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