<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Surveys */

$this->title = Yii::t('app', 'Create Surveys');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Surveys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surveys-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
