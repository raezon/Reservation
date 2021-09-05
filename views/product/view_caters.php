<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//$model->extra=json_decode($model->extra,true);
?>
<div class="product-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Product').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">

            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php
/*this part will consist for transforming a json into multiple values with a nice display*/
if($model->partnerCategory->name="Room Rental"){

}

    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'partnerCategory.name',
            'label' => Yii::t('app', 'Partner Category'),
        ],
        'name',
        'description',
        'price',
        'number_people',
        'quantity',
        [
            'attribute' => 'picture',
             'value' => '/web/img/products/'.$model->picture,
             'format' => ['image',['width'=>'auto','height'=>150]]

        ],
        'duration',
        [
            'attribute' => 'productOption.name',
            'label' => Yii::t('app', 'Product Option'),
        ],
        'condition',
        [
            'attribute' => 'partner.name',
            'label' => Yii::t('app', 'Partner'),
        ],
        'status',
    ];

    if($model->partnerCategory->name=="Room Rental"){
            $array_type_room_rental="";
            $area=0;
            $caution=0;
            $Rental_information=" ";
            $Minimal="";
            $Facilities="";
            $Possibilities_check="";
            $transport="";


  



    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'description',
        ['attribute' => 'Price in hour','value'=>$model->price.''.$model->currencies_symbol],
        'quantity',
        'number_people',
        'duration',
           [
                'label' => Yii::t('app', 'Area'),
                'value' => $area.'m²'
            ],
             [
                'label' => Yii::t('app', 'Caution'),
                'value' => $caution.''.$model->currencies_symbol
            ], [
                'label' => Yii::t('app', 'Minimal Consomation'),
                'value' => $Minimal.''.$model->currencies_symbol
            ],
         [
            'attribute' => 'picture',
            'value' => "http://localhost/clicangoevent/mainrepo/web/img/products/$model->picture",
            'format' => ['image',['width'=>'auto','height'=>'15%']],

        ],
         [
                'label' => Yii::t('app', 'Rental information'),
                'value' => $Rental_information,
                'format'=>'raw',
            ],
            [
                'attribute' => 'html',
                'label' => Yii::t('app', 'Rental Facilities'),
                'value' => $Facilities,
                'format'=>'raw',
            ],
            [
                'label' => Yii::t('app', 'Possibilities check'),
                'value' => $Possibilities_check,
                'format'=>'raw',
            ],
             [
                 'attribute' => 'html',
                'label' => Yii::t('app', 'Transport'),
                'value' => $transport,
                'format'=>'raw',

            ],


    ];
    }
        }
}
        if(is_string($model->extra)){

      //getting the extra
          $array_extra=json_decode($model->extra,true);
      //getting the size of extra
          $count_extra=count($array_extra);
      //looping element
         if(is_array($array_extra)){
             for ($i=0; $i <$count_extra ; $i++) {
            $value =json_encode($array_extra[$i]);
              $gridColumn[]=[
                  'attribute' => 'extra',
                      'label' => Yii::t('app', 'Extra'.$i),
                      'value' => $value

              ];
            }
         }

    }
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>

    <div class="row">
<?php
if($providerOptions->totalCount){
    $gridColumnOptions = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            'name',
            'price',
                ];
    echo Gridview::widget([
        'dataProvider' => $providerOptions,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-options']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Options')),
        ],
        'columns' => $gridColumnOptions
    ]);
}
?>
    </div>

    <div class="row">
<?php
if($providerReservationDetail->totalCount){
    $gridColumnReservationDetail = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            [
                'attribute' => 'reservation.id',
                'label' => Yii::t('app', 'Reservation')
            ],
                        'quantity',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerReservationDetail,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-reservation-detail']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Reservation Detail')),
        ],
        'columns' => $gridColumnReservationDetail
    ]);
}
?>
    </div>
</div>
