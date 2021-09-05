<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PartnerCategorySurveys */

$this->title = Yii::t('app', 'Save As New {modelClass}: ', [
    'modelClass' => 'Partner Category Surveys',
]). ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Partner Category Surveys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Save As New');
?>
<div class="partner-category-surveys-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
