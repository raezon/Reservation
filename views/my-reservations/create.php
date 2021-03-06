<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Reservation */

$this->title = Yii::t('app', 'Create Reservation');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reservation'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
