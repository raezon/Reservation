<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Options */

$this->title = Yii::t('app', 'Save As New {modelClass}: ', [
    'modelClass' => 'Options',
]). ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Options'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Save As New');
?>
<div class="options-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
