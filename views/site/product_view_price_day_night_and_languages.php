<?php
use \yii\helpers\Html;
use \yii\helpers\Url;
use yii\widgets\DetailView;
use app\models\PartnerCategory;
use kartik\form\ActiveForm;
use kartik\daterange\DateRangePicker;
use kartik\select2\Select2;
use app\models\ProductParent;
use app\models\ProductItem;

/**
 * model: Partner object
 */
/*so i need to get the productid and get the current option and type if there is and the xtra and display them all */
$this->title = $model->name;
Yii::setAlias('@productImgUrl','/web/img/products/');
?>
  <?php

$model1=PartnerCategory::find()->where(['id'=>$model->partner_category])->one();
$model_new=ProductItem::find()->where(['product_id'=>$model->product_id])->all();?>
<?php $form = ActiveForm::begin([
        'id' => 'partner-registration-form',
        //'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'method' => 'post',
       'action' =>['site/reservation','amout'=>$model->price,'id'=>$model->id]
    ]); ?>
    
                <div class="form-group">
                 
 <div class="row">
  
 
<?php foreach($model_new as $model){?>
  <div class="container">
     
      <section class="pt-5 pb-5" style="min-height:100vh;">
          <?php $path='clicangoevent/web/img/products'.'/'.$model->picture;
      if($model->picture!="") {

      }?>
        
          <div class="container-fluid pt-5 pb-5 position-relative">
              <div class="row">
                  <div class="col-sm-12">
                    <h2><?= $model->name ?></h2>
                    <p><strong>Category:<?=$model1->name?></strong> </p>
                    
                  </div>
              </div>

       <div class="row">
                  <div class="col-sm-4">
                      <div class="image-responsive">


                      </div>
                  </div>
                  <div class="col-sm-8">

<?php
      $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'price',
         [
            'attribute' => 'picture',
            'value' => "img/products/$model->picture",
            'format' => ['image',['width'=>'auto','height'=>'40%']]
        ], 
    ];
   
    $array_extra=json_decode($model->extra,true);
    if(!empty($array_extra))
        $count_extra=count($array_extra);
    else 
        $count_extra=0;
    for ($i=0; $i <$count_extra ; $i++) {
      $value =json_encode($array_extra[$i]);
        $gridColumn[]=[

            'attribute' => 'extra',
                'label' => Yii::t('app', 'Extra'.$i),
                'value' => $value




        ];
    }
    ?>

    <?php
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);

?>
                  </div>
              </div><!-- .row -->

          </div>
      </section>
  </div>
 <?php }?>
