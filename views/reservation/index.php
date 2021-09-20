<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

use app\models\User;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Reservation');
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="reservation-index">

    <h1><?=Html::encode($this->title)?></h1>

<?php
$gridColumn = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'class' => 'kartik\grid\ExpandRowColumn',
        'width' => '50px',
        'value' => function ($model, $key, $index, $column) {
            return GridView::ROW_COLLAPSED;
        },
        'detail' => function ($model, $key, $index, $column) {
            return Yii::$app->controller->renderPartial('_expand', ['model' => $model]);
        },
        'headerOptions' => ['class' => 'kartik-sheet-style'],
        'expandOneOnly' => true,
    ],
    ['attribute' => 'id', 'visible' => false],
    'reservation_date',
    [
        'attribute' => 'reservation_id',
        'label' => Yii::t('app', 'Produit'),
        'value' => function ($model) {
            return $model->productItem->name;
        },
    ],
    [
        'attribute' => 'reservation_id',
        'label' => Yii::t('app', 'Montant'),
        'value' => function ($model) {
            return $model->montant;
        },
    ],
    [
        'attribute' => 'reservation_id',
        'format' => 'html',
        'label' => 'Ccp ',
        'value' => function ($model) {
            if ($model->piece_jointe != 'vide' && $model->piece_jointe != '0') {
                return Html::a(
                    'Pièce jointe',
                    ['reservation/view-piece', 'id' => $model->id],
                    [
                        'id' => 'Imprimer',
                        'class' => 'btn btn-primary',
                        'target' => '_blank',
                    ]
                );
            } else {
                return '';
            }
        },
    ],
    [
        'attribute' => 'status',
        'format' => 'html',
        'label' => 'Etat ',
        'value' => function ($model) {
            switch ($model->status) {
                case '0':
                    return 'En attente';
                    break;

                case '1':
                    return 'Accepter';
                    break;
            }

        },
    ],
    [
        'attribute' => 'status',
        'format' => 'html',
        'label' => 'Accepter ',
        'visible' => User::isPartner(),
        'value' => function ($model) {

            return Html::a(
                'Accepter',
                ['reservation/accept', 'userId' => $model->user_id, 'reservation_id' => $model->id],
                [
                    'id' => 'Accepter',
                    'class' => 'btn btn-success',
                    'target' => '_blank',
                ]
            );

        },
    ],

    [
        'attribute' => 'user_id',
        'label' => Yii::t('app', 'User'),
        'value' => function ($model) {
            return $model->user->username;
        },
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => \yii\helpers\ArrayHelper::map(\app\models\User::find()->asArray()->all(), 'id', 'username'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'User', 'id' => 'grid--user_id'],
    ],
    [
        'class' => 'yii\grid\ActionColumn',
        'template' => '{save-as-new} {view} {update} {delete}',
        'buttons' => [
            'save-as-new' => function ($url) {
                return Html::a('<span class="glyphicon glyphicon-copy"></span>', $url, ['title' => 'Save As New']);
            },
        ],
    ],
];
?>
    <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumn,
    'pjax' => true,
    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-reservation']],
    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
    ],
    // your toolbar can include the additional full export menu
    'toolbar' => [
        '{export}',
        ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumn,
            'target' => ExportMenu::TARGET_BLANK,
            'fontAwesome' => true,
            'dropdownOptions' => [
                'label' => 'Full',
                'class' => 'btn btn-default',
                'itemsBefore' => [
                    '<li class="dropdown-header">Export All Data</li>',
                ],
            ],
        ]),
    ],
]);?>

</div>
