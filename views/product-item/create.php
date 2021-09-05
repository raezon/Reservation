<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProductItem */

$this->title = 'Create Product Item';
$this->params['breadcrumbs'][] = ['label' => 'Product Item', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
