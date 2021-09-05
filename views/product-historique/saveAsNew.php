<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProductHistorique */

$this->title = Yii::t('app', 'Save As New {modelClass}: ', [
    'modelClass' => 'Product Historique',
]). ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Historiques'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Save As New');
?>
<div class="product-historique-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
