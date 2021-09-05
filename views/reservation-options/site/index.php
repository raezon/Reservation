<?php

/* @var $this yii\web\View */
//use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
//use yii\bootstrap4\Dropdown;
use yii\bootstrap4\Html;
//use yii\jui\DatePicker;
use kartik\datecontrol\DateControl;
use kartik\select2\Select2;
use kartik\tabs\TabsX;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\bootstrap4\Carousel;
use app\models\Partner;
use app\models\Product;
use kartik\form\ActiveForm;
use kartik\daterange\DateRangePicker;
$this->title = 'ClicangoEvent';

//$partners = \app\models\Partner::find()->all()
$categories = \app\models\PartnerCategory::find()->all();
$items = [];
$categoriesNames = [];
$perPage = 4;

foreach ($categories as $category) {
    $carouselContent = '';
    // Carousel
    $partners = Partner::find()->where(['category_id' =>$category])->andwhere(['status'=>1 ])->all();

    $array_id_partner= array();
    foreach ($partners as $partner) {
      $array_id_partner[]=$partner->id;  
    }
    
     // $products=Product::find()->where(['partner_category'=>4])->all();
       foreach ($products as $product) {
      //echo $product->name; 
    }
    
    //if products is empty 
    $count = count($products);
    echo $count;
   /*if(!empty($products1))
        {
          $products=$products1;
          $count = count($products);

        }*/

    

    if ($count == 0){
        // no Partner found in this Category
        $carouselContent = '<div class="alert alert-info text-center my-2"><h1>'.\Yii::t('app','No Product found!').'</h1></div>';
        
    } else if ($count <= $perPage){
        // Less than 3 partners in this Category
        $carouselContent .='<div class="container text-center my-3">
    <div id="partnerCarousel" class="carousel slide w-100" data-ride="carousel">
        <div class="carousel-inner w-100" role="listbox">
        <div class="carousel-item row active">';
if(!empty($products))
   foreach ($products as $product) {
          
            $carouselContent .= $this->render('_partner_card', ['model1'=>$product, 'perPage' => $perPage]);
        }

       
        $carouselContent .= '</div></div>
        <a class="carousel-control-btn carousel-control-prev btn-primary shadow" href="#partnerCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-btn carousel-control-next btn-primary shadow" href="#partnerCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>';
       
    } else if ($count > $perPage){
//        More than 3 partner ($count > 3) in this Category
//        $pages = $count % $perPage; // == 2
        $pages = (int) ceil($count / $perPage);
        $carouselContent .='<div class="container text-center my-3">
    <div id="partnerCarousel" class="carousel slide w-100" data-ride="carousel">
      <!-- ol class="carousel-indicators">
        <li data-target="#partnerCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#partnerCarousel" data-slide-to="1"></li>
        <li data-target="#partnerCarousel" data-slide-to="2"></li>
      </ol -->
        <div class="carousel-inner w-100" role="listbox">';  
       
       

         
           for ($page = 0; $page < $pages; $page++){
          
            $carouselContent .= $this->render('_partner_page', [
                'model1'=>$products,
                'partners' => $partners,
                'page' => $page,
                'perPage' => $perPage,
               ]);
        }
             
       
        $carouselContent .= '</div>
        <a class="carousel-control-btn carousel-control-prev btn-primary shadow" href="#partnerCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-btn carousel-control-next btn-primary shadow" href="#partnerCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>';
        
      
    } // if ($count <= 3)

    // Tabs Categories
    array_push($items, [
        'label' => $category->name, 
        'content' => $carouselContent,
        'active' => count($items) == 0
    ]);
    
    // Add Category's name to $categoriesNames
    array_push($categoriesNames, $category->name);
    
} // foreach ($categories)
?>  
      
    <section class="pt-5 pb-5">
      <!-- Search Box -->
      <div class="row">
          <div class="col mt-10 pt-5">
                <h3 class="text-center">Trouvez ce qu'il faut à votre événement en un clique</h3>
<!--search for client i will create an activeForm with a model -->
 <?php $form = ActiveForm::begin([
        'id' => 'partner-registration-form',
        //'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'method' => 'post',
        'action' =>['site/index']  
    ]); ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                        <?= Html::img('@web/logo.png', ['alt'=>'image']);?>
                        </div>
                    </div>
                      <div class="row">
                          <div class="col-sm-3">
                            <div class="dropdown">
                                <!-- input name="category" class="form-control" placeholder="Category" data-toggle="dropdown" class="dropdown-toggle" -->
                             
                                   <?php  echo $form->field($model ,'category')->widget(Select2::classname(),([
                                      'name' => 'partner_category',
                                      'data' => $categoriesNames,
                                      'options' => ['placeholder' => 'Select a Category...'],
                                      'pluginOptions' => [
                                          'allowClear' => true,
                                          //'multiple' => true,
                                      ],
                                  ])); ?>
                                
                            </div>
                          </div>
                          
                          <div class="col-sm-3">
                              <!-- input name="date_reservation" class="form-control" placeholder="CHOOSE A DATE?" -->

 <?php  echo $form->field($model,'date_depart', [
    'addon'=>['prepend'=>['content'=>'<i class="fas fa-calendar-alt"></i>']],
    'options'=>['class'=>'drp-container form-group']
])->widget( DateRangePicker::classname(),([
    'name'=>'date_range_3',
    'value'=>'2015-10-19 12:00 AM - 2015-11-03 01:00 PM',
    'convertFormat'=>true,
    'pluginOptions'=>[
        'timePicker'=>true,
        'timePickerIncrement'=>15,
        'locale'=>['format'=>'Y-m-d h:i A']
    ]  ,
    'options' => ['placeholder' => 'Select range...']          
])); 
?>
                               
                             
                          </div>
                          <div class="col-sm-3">
                              
                              <?php  
                               echo $form->field($model, 'nbr_persson')->textInput([

                                 'class' => 'form-control',
                                 'placeholder'=>'Enter nbr of persons...',
                                 'type' => 'number',
                                 
                            ]);?>
                             
                          </div>
                          <div class="col-sm-3">
                                <?php  
                               echo $form->field($model, 'place')->textInput([

                                 'class' => 'form-control',
                                 'placeholder'=>'NEAR TO?',
                                 
                                 
                            ]);?>
                          </div>
                     </div>
                      <div class="row float-right">
                          <div class="col-sm-12 mt-2">
                              <!--<input type="submit" class="btn btn-primary shadow ml-sm-auto" value="SEARCH...">-->
                              <?= Html::submitButton('SEARCH...', ['class'=>'btn btn-primary shadow ml-sm-auto']) ?>
                          </div>
                      </div>
                </div><!-- .form-group -->
<?php ActiveForm::end() ?>
          
          </div><!-- .col mt-10 pt-5 -->
      </div><!-- .row -->
      
      <!-- TabsX -->
      <div class="row">
          <div class="col mt-10 pt-5">
          <?= TabsX::widget([
              'position'=>TabsX::POS_ABOVE,
              'align' => TabsX::ALIGN_LEFT,
              'bordered'=>true,
              'encodeLabels'=>false,
              'items' => $items
//              [ 
//                  [ 'label' => 'One', 'content' => 'Anim pariatur cliche...', 'active' => true ], 
//                  [ 'label' => 'Two', 'content' => 'Anim pariatur cliche...', 'headerOptions' => [], 'options' => ['id' => 'myveryownID'], ], 
//               ], 
              ]);  ?>
          </div>
      </div><!-- .row -->
      
    </section>