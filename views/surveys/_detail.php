<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Surveys */

?>
<div class="surveys-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'survey_order',
        [
            'attribute' => 'survey.survey_id',
            'label' => Yii::t('app', 'Survey'),
        ],
        [
            'attribute' => 'partnerCategorySurveys.title',
            'label' => Yii::t('app', 'Partner Category Surveys'),
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>