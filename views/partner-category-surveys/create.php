<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PartnerCategorySurveys */

$this->title = Yii::t('app', 'Create Partner Category Surveys');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Partner Category Surveys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partner-category-surveys-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
