<?php 
use \yii\helpers\Html;
use yii\widgets\DetailView;
?>

<div class="row">
    <div class="col-sm-4 mt-4 text-center">
        <h2><?= Html::encode($model->name) ?></h2>
    </div>
    <?php 
    Yii::setAlias('@productImgUrl','http://localhost/clicangoevent/mainrepo/web/img/products/');
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
//        'name',
        'description:ntext',
        [
            'attribute' => 'address',
            'value' => $model->address.' ,'.$model->postal_code.', '.$model->country.' ,'.$model->city
        ],        
        'tel',
//        'web_site',
        //'keywords',
//        'email:email',
        [
            'attribute' => 'picture', 
            'value' => "@web/img/picture/$model->picture",
            'format' => ['image',['width'=>'auto','height'=>'30%']]
        ],
//        'picture',
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