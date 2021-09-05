<?php
use \yii\helpers\Html;
use \yii\helpers\Url;
use yii\widgets\DetailView;
use app\models\PartnerCategory;
use kartik\form\ActiveForm;
use kartik\daterange\DateRangePicker;
use kartik\select2\Select2;


/**
 * model: Partner object
 */
/*so i need to get the productid and get the current option and type if there is and the xtra and display them all */
$this->title = $model->name;
Yii::setAlias('@productImgUrl','/web/img/products/');
?>
  <?php
            if($model->partnerCategory->name=="Caterers")
    {
            $array_type_caters=json_decode($model->checkbox,true);
            $Caters="";
            $food_type_array="";

                                 if (array_key_exists('vegan',$array_type_caters))
                                              {
                                                if($array_type_caters['vegan']!='0')
                                                 $food_type_array.=$array_type_caters['vegan']."<br>";
                                             }
                                 if (array_key_exists('Vegetarian',$array_type_caters))
                                              {
                                                if($array_type_caters['Vegetarian']!='0')
                                                 $food_type_array.=$array_type_caters['Vegetarian']."<br>";
                                             }
                                  if (array_key_exists("Gluten_free",$array_type_caters))
                                              {
                                                if($array_type_caters['Gluten_free']!='0')
                                                 $food_type_array.=$array_type_caters['Gluten_free']."<br>";
                                              }
                                  if (array_key_exists("Halal",$array_type_caters))
                                              {
                                                if($array_type_caters['Halal']!='0')
                                                 $food_type_array.=$array_type_caters['Halal']."<br>";
                                              }
                                   if (array_key_exists("Casher",$array_type_caters))
                                              {
                                                if($array_type_caters['Casher']!='0')
                                                 $food_type_array.=$array_type_caters['Casher']."<br>";
                                              }
                                  if (array_key_exists("Organic",$array_type_caters))
                                              {
                                                if($array_type_caters['Organic']!='0')
                                                 $food_type_array.=$array_type_caters['Organic']."<br>";
                                              }
                                  if (array_key_exists("Without_porc",$array_type_caters))
                                              {
                                                if($array_type_caters['Without_porc']!='0')
                                                 $food_type_array.=$array_type_caters['Without_porc']."<br>";
                                              }
                                              
     

    }

$model1=PartnerCategory::find()->where(['id'=>$model->partner_category])->one();

              ?>
  <div class="container">

      <section class="pt-5 pb-5" style="min-height:100vh;">
          <?php $path='img/products'.'/'.$model->picture;
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
                        <h4>Name of meal</h4>
                        
                         <!--here we must provide a photo-->

                      </div>
                  </div>
                  <div class="col-sm-8">

<?php

  if($model->partnerCategory->name=="Caterers")
      $gridColumn = [

        ['attribute' => 'id', 'visible' => false],
        'name',
        ['attribute' => 'Price ','value'=>$model->price],
        'quantity',
        'people_number',
        'periode',
         [
            'attribute' => 'picture',
            'value' => "img/products/$model->picture",
            'format' => ['image',['width'=>'auto','height'=>'40%']]
        ],
       /*  [
                'label' => Yii::t('app', 'Price serveur'),
               // 'value' =>$array_type_caters['price_serveur']
              ],
         [
                'label' => Yii::t('app', 'Minimal Consomation'),
               // 'value' =>$array_type_caters['minimal_consamtion']
              ],*/
          [
                'label' => Yii::t('app', 'Food Types'),
                'value' =>$food_type_array,
                'format'=>'raw'
              ],


    ];

    $array_extra=json_decode($model->extra,true);
    $count_extra=count($array_extra);
    for ($i=0; $i <$count_extra ; $i++) {
      $value =json_encode($array_extra[$i]);
        $gridColumn[]=[

            'attribute' => 'extra',
                'label' => Yii::t('app', 'Extra'.$i),
                'value' => $value,
                'format'=>"raw"




        ];
    }

   /* */?>
<?php $form = ActiveForm::begin([
        'id' => 'partner-registration-form',
        //'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'method' => 'post',
       'action' =>['site/reservation','amout'=>$model->price,'id'=>$model->id]
    ]); ?>
                <div class="form-group">
                 
                      <div class="row">

                          <div class="col-sm-4">
                    
                           <?php echo $form->field($model2,'reservation_date', [
                              'addon'=>['prepend'=>['content'=>'<i class="fas fa-calendar-alt"></i>']],
                              'options'=>['class'=>'drp-container form-group']
                          ])->widget( DateRangePicker::classname(),([
                              'name'=>'date_range_3',
                              'value'=>'2015-10-19 12:00 AM - 2015-11-03 01:00 PM',
                              'convertFormat'=>true,
                              'pluginOptions'=>[
                                  'timePicker'=>true,
                                  'timePickerIncrement'=>15,
                                  'locale'=>['format'=>'Y-m-d h:i ']
                              ]  ,
                              'options' => ['placeholder' => 'Select range...']
                          ]));
                          ?>
                          </div>
                     </div>
                      <div class="row float-right">
                          <div class="col-sm-12 mt-2">
                              
                             <button class="btn   btn-primary ">Reservation</button>

                          </div>
                      </div>
                </div><!-- .form-group -->
<?php ActiveForm::end() ?>

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
