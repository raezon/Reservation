<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PartnerCategory */

$this->title = Yii::t('app', 'Create Partner Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Partner Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partner-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
