<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\PartnerCategorySurveys */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Partner Category Surveys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partner-category-surveys-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Partner Category Surveys').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'title',
        [
                'attribute' => 'partnerCategory.name',
                'label' => Yii::t('app', 'Partner Category')
            ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerSurveys->totalCount){
    $gridColumnSurveys = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'survey_order',
        [
                'attribute' => 'survey.survey_id',
                'label' => Yii::t('app', 'Survey')
            ],
            ];
    echo Gridview::widget([
        'dataProvider' => $providerSurveys,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Surveys')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnSurveys
    ]);
}
?>
    </div>
</div>
