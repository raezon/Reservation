<?php 
use \yii\helpers\Html;
use yii\widgets\DetailView;
?>

<div class="row">
    <div class="col-sm-2 mt- text-center">
        <h2><?= Html::encode($model->name) ?></h2>
    </div>
    <?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
//        'name',
        'description:ntext',
        'address',
        'tel',
//        'web_site',
        'country',
        'city',
        //'postal_code',
        //'calender_id',
        //'keywords',
//        'email:email',
        'picture',
//        [
//            'attribute' => 'category.name',
//            'label' => Yii::t('app', 'Category'),
//        ],
        //'status',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
    ?>
</div>