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
        [
            'attribute' => 'price',
            'format' => 'html',
            'label' => 'Image',
             'value' => function ($model) {
                                $price=$model->price.''.$model->currencies_symbol;
                return $price;

            },

        ],
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
        'availability',
        [
            'attribute' => 'partner.name',
            'label' => Yii::t('app', 'Partner'),
        ],
       /* [

            'attribute' => 'extra',
                'label' => Yii::t('app', 'Extra'),
                'value' => function($model){
                    $model=json_decode($model->extra,true);
                    print_r($model);
                    foreach ($model as $value) {
                       echo $value['Description'];
                       echo $value['Quantity'];
                       echo $value['Price'];
                    }
                    return $value;
                },
        ],*/
        'status',
    ];

    if($model->partnerCategory->name=="Room Rental"){
            $array_type_room_rental="";
            $area=0;
            $caution=0;
            $Rental_information=" ";
            $minimal="";
            $Facilities="";
            $Possibilities_check="";
            $transport="";


  if(!empty($model->productType->nom)){
   
   


    if (is_string($array_type_room_rental)) {
       $array_type_room_rental=json_decode($model->productType->nom,true);
                 $Caters="";
            //this variable is form some chebox in the room rental in the section Information

      if (array_key_exists("area",$array_type_room_rental))
                  {

                     $area.=$array_type_room_rental['area'].'';
                  }
      if (array_key_exists("option_of_meal",$array_type_room_rental))
                  {
                     $caution.=$array_type_room_rental['option_of_meal'].'';
                  }
       if (array_key_exists("Minimum_consumption_Price",$array_type_room_rental))
                  {
                     $minimal.=$array_type_room_rental['Minimum_consumption_Price'].'';
                  }

      if (array_key_exists("event_cake",$array_type_room_rental))
                  {
                    if($array_type_room_rental['event_cake']!=0)
                     $Rental_information.=$array_type_room_rental['event_cake'].'  </br>';
                  }
      if (array_key_exists("drink",$array_type_room_rental))
                  {
                     $Rental_information.=$array_type_room_rental["drink"]."<br>";
                  }
      if (array_key_exists("External_food",$array_type_room_rental))
                  {
                     $Rental_information.=$array_type_room_rental['External_food'].'</br>';
                  }
      if (array_key_exists("External_Catering",$array_type_room_rental))
                  {
                     $Rental_information.=$array_type_room_rental['External_Catering'].'</br>';
                  }
      if (array_key_exists("Internal_Catering",$array_type_room_rental))
                  {
                     $Rental_information.=$array_type_room_rental['Internal_Catering'].'</br>';
                  }
      if (array_key_exists("Without_guarantee",$array_type_room_rental))
                  {
                     $Rental_information.=$array_type_room_rental['Without_guarantee'].'</br>';
                  }
                     $Facilities="";

      if (array_key_exists(" Wifi",$array_type_room_rental))
                  {

                     $Facilities.=$array_type_room_rental['Wifi'].'</br>';
                  }
      if (array_key_exists("Board",$array_type_room_rental))
                  {
                      $Facilities.=$array_type_room_rental['Board'].'</br>';
                  }
      if (array_key_exists("event_cake",$array_type_room_rental))
                  {
                    if($array_type_room_rental['event_cake']!=0)
                      $Facilities.=$array_type_room_rental['event_cake'].'</br>';
                  }
      if (array_key_exists("System_Sound",$array_type_room_rental))
                  {
                      $Facilities.=$array_type_room_rental['System_Sound'].'</br>';
                  }
      if (array_key_exists("Micro",$array_type_room_rental))
                  {
                     $Facilities.=$array_type_room_rental['Micro'].'</br>';
                  }
      if (array_key_exists("Video projector",$array_type_room_rental))
                  {
                     $Facilities.=$array_type_room_rental['Video projector'].'</br>';
                  }
      if (array_key_exists("Internal_Catering",$array_type_room_rental))
                  {
                     $Facilities.=$array_type_room_rental['Internal_Catering'].'  </br>';
                  }
      if (array_key_exists("Without_guarantee",$array_type_room_rental))
                  {
                     $Facilities.=$array_type_room_rental['Without_guarantee'].'  </br>';
                  }

              if (array_key_exists("To_bring_back_cake_of_the_event",$array_type_room_rental))
                  {

                     $Possibilities_check.=$array_type_room_rental['To_bring_back_cake_of_the_event'].'</br>';
                  }
               if (array_key_exists("To_bring_back_drinks",$array_type_room_rental))
                  {

                    $Possibilities_check.=$array_type_room_rental['To_bring_back_drinks'].'</br>';
                  }
    ////////////////////////////////////////////////////////////

                    if (array_key_exists("Subway",$array_type_room_rental))
                  {

                     $transport.=$array_type_room_rental['Subway']["name"].$array_type_room_rental['Subway']['field'];
                  }



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
                'value' => $minimal.''.$model->currencies_symbol
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
          $value="";
         if(is_array($array_extra)){
             for ($i=0; $i <$count_extra ; $i++) {
              if(!empty($array_extra[$i]))
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
