<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProductExtra */

$this->title = 'Create Product Extra';
$this->params['breadcrumbs'][] = ['label' => 'Product Extra', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-extra-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
