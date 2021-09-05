<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\SocialAccount */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Social Account'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="social-account-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Social Account').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'user.username',
                'label' => Yii::t('app', 'User')
            ],
        'provider',
        'client_id',
        'data:ntext',
        'code',
        'email:email',
        'username',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
