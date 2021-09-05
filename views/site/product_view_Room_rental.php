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
Yii::setAlias('@productImgUrl','http://localhost/clicangoevent/mainrepo/web/img/products/');

?>
  <?php

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

                      </div>
                  </div>
                  <div class="col-sm-8">

<?php

    $array_type_room_rental=json_decode($model->product_type,true);
    if (is_array($array_type_room_rental)) {
                 $Caters="";
            $area=0;
            $caution=0;
            $Rental_information=" ";
            $Minimal="";
            $Facilities="";
      if (array_key_exists("area",$array_type_room_rental))
                  {

                     $area.=$array_type_room_rental['area'].'</br>';
                  }
      if (array_key_exists("option_of_meal",$array_type_room_rental))
                  {
                     $caution.=$array_type_room_rental['option_of_meal'].'</br>';
                  }
       if (array_key_exists("option_of_meal",$array_type_room_rental))
                  {
                     $minimal.=$array_type_room_rental['Minimum_consumption_Price'].'</br>';
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
      if (array_key_exists("Possibility_check_name",$array_type_room_rental[0][0]["services_possiblity"]))
                  {
                    if($array_type_room_rental[0][0]["services_possiblity"]['Possibility_check_name']!='0')
                     $Rental_information.=$array_type_room_rental[0][0]["services_possiblity"]['Possibility_check_name'].'  </br>';
                  }  
      if (array_key_exists("Possibility_check_name",$array_type_room_rental[0][1]["services_possiblity"]))
                  {
                    if($array_type_room_rental[0][1]["services_possiblity"]['Possibility_check_name']!='0')
                     $Rental_information.=$array_type_room_rental[0][1]["services_possiblity"]['Possibility_check_name'].'  </br>';
                  }
      if (array_key_exists("Possibility_check_name",$array_type_room_rental[0][2]["services_possiblity"]))
                  {
                    if($array_type_room_rental[0][2]["services_possiblity"]['Possibility_check_name']!='0')
                     $Rental_information.=$array_type_room_rental[0][2]["services_possiblity"]['Possibility_check_name'].'</br>';
                  }
     if (array_key_exists("Possibility_check_name",$array_type_room_rental[0][3]["services_possiblity"]))
                  {
                    if($array_type_room_rental[0][3]["services_possiblity"]['Possibility_check_name']!='0')
                    $Rental_information.=$array_type_room_rental[0][3]["services_possiblity"]['Possibility_check_name'].'  </br>';
                  }  
      if (array_key_exists("Possibility_check_name",$array_type_room_rental[0][4]["services_possiblity"]))
                  {
                    if($array_type_room_rental[0][4]["services_possiblity"]['Possibility_check_name']!='0')
                     $Rental_information.=$array_type_room_rental[0][4]["services_possiblity"]['Possibility_check_name'].'  </br>';
                  }  
       if (array_key_exists("Possibility_check_name",$array_type_room_rental[0][5]["services_possiblity"]))
                  {
                    if($array_type_room_rental[0][5]["services_possiblity"]['Possibility_check_name']!='0')
                     $Rental_information.=$array_type_room_rental[0][5]["services_possiblity"]['Possibility_check_name'].'  </br>';
                  }
     if (array_key_exists("Possibility_check_name",$array_type_room_rental[0][6]["services_possiblity"]))
                  {
                    if($array_type_room_rental[0][6]["services_possiblity"]['Possibility_check_name']!='0')
                     $Rental_information.=$array_type_room_rental[0][6]["services_possiblity"]['Possibility_check_name'].'</br>';
                  }
     if (array_key_exists("Possibility_check_name",$array_type_room_rental[0][7]["services_possiblity"]))
                  {
                    if($array_type_room_rental[0][7]["services_possiblity"]['Possibility_check_name']!='0')
                    $Rental_information.=$array_type_room_rental[0][7]["services_possiblity"]['Possibility_check_name'].'  </br>';
                  } 
   

////////////////////////////////////////////////////////////////////////////////////
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
    ////////////////////////////////////////////////////////////
                  $transport="";
                    if (array_key_exists("Subway",$array_type_room_rental))
                  {

                     $transport.=$array_type_room_rental['Subway']["name"].$array_type_room_rental['Subway']['field'];
                  }




 }


    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        ['attribute' => 'Price in hour','value'=>$model->price.''.$model->currencies_symbol],
        'quantity',
        'people_number',
        'periode',
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
            'value' => "img/products/$model->picture",
            'format' => ['image',['width'=>'auto','height'=>'40%']],

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
                 'attribute' => 'html',
                'label' => Yii::t('app', 'Transport'),
                'value' => $transport,
                'format'=>'raw',

            ],


    ];

   /*if($model->name="Photo/Camera"||$model->name="Animation"||$model->name="Security"||$model->name="Hosts/Hostess"||$model->name="Transport")
    {
      $array_prices_day_night=json_decode($model->productOption->name,true);

      $gridColumn[]=[
           [
            'attribute' => 'productOption.name',
            'label' => Yii::t('app', 'Product Option'),
        ],






        ];
    }*/
    if(is_array($model->extra)){
      //getting the extra
          $array_extra=json_decode($model->extra,true);
      //getting the size of extra
          $count_extra=count($array_extra);
      //looping element
          for ($i=0; $i <$count_extra ; $i++) {
            $value =json_encode($array_extra[$i]);
              $gridColumn[]=[
                  'attribute' => 'extra',
                      'label' => Yii::t('app', 'Extra'.$i),
                      'value' => $value

              ];
            }
    }


   /* */

?>
 <div class="row">
          <div class="col mt-10 pt-5">
                <h3 class="text-center">Trouvez ce qu'il faut à votre événement en un clique</h3>
<!--search for client i will create an activeForm with a model -->
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
