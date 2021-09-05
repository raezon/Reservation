<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SocialAccount */

$this->title = Yii::t('app', 'Save As New {modelClass}: ', [
    'modelClass' => 'Social Account',
]). ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Social Account'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Save As New');
?>
<div class="social-account-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
