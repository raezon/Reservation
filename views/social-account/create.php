<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SocialAccount */

$this->title = Yii::t('app', 'Create Social Account');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Social Account'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="social-account-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
