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
use app\models\ProductParent;
use app\models\ProductItem;
use kartik\form\ActiveForm;
use kartik\daterange\DateRangePicker;

echo
'<style>
.has-star{
  display:none;
  }

</style>';
$this->title = 'Reservation';
$Produit_type = [

  ['id' => '0', 'name' => 'Banquet\Dinner'],

  ['id' => '1', 'name' => 'Conference'],

  ['id' => '2', 'name' => 'Cinema'],

  ['id' => '3', 'name' => 'Dinatoire'],

  ['id' => '4', 'name' => 'Meeting'],

  ['id' => '5', 'name' => 'Theater'],

  ['id' => '6', 'name' => 'Other'],
];

  $i=0;
  foreach ($Produit_type as $type) {
    $produit_tableau_type[$i] = $type['name'];
    $i++;
  }
  
 $listData = ArrayHelper::map($Produit_type, 'id', 'name');
//$partners = \app\models\Partner::find()->all()
$categories = \app\models\PartnerCategory::find()->all();
$items = [];
$categoriesNames = [];
$perPage = 3;

foreach ($categories as $category) {
  $carouselContent = '';
  // Carousel
  $partners = Partner::find()->where(['category_id' => $category])->andwhere([])->all();

  $array_id_partner = array();
  foreach ($partners as $partner) {
    $array_id_partner[] = $partner->id;
  }
  //j'ai fait mon chafngement

  $compteur_photo = 0;
  if ($category->id == 1 || $category->id == 2 || $category->id == 3 || $category->id == 4 || $category->id == 5 || $category->id == 6 || $category->id == 7 || $category->id == 8 || $category->id == 9) {
    /* $products=Product::find()->where(['partner_category'=>$category->id,'status'=>1])->all();
            $count = count($products);*/
    $productsparent = ProductParent::find()->where(['partner_category' => $category->id])->all();
    //construct an array of product id
    $array_product_id = array();
    //avoir les id des produits et un filtrage pour photo caméra
    foreach ($productsparent as $element) {

      $array_product_id[] = $element->id;
    }
    $products_old = ProductItem::find()->where(['product_id' => $array_product_id, 'status' => 1])->all();
    //needs here to construct a new prodcuts area for filtering image into 6 image into one 
    $compteur_photo = 0;
    $products = [];
    foreach ($products_old as $element) {

      $products[] = $element;
      $compteur_photo = 0;
    }

    $count = count($products);
  } else {
    $products = Product::find()->where(['partner_category' => $category->id, 'status' => 1])->all();
    $count = count($products);
  }


  if (!empty($products1)) {
    // $id=$category->id;
    if ($category->id == $category_searched) {
      $products = $products1;
      $count = count($products);
    } else {
      $count = 0;
    }
  }
  /*if(empty($products1))
        	$products=[];*/




  if ($count == 0) {
    // no Partner found in this Category
    $carouselContent = '<div class="text-center my-2"><h1>' . \Yii::t('app', 'Pas de Produit!') . '</h1></div>';
  } else if ($count <= $perPage) {
    // Less than 3 partners in this Category
    $carouselContent .= '<div class="container text-center my-3">
    <div id="partnerCarousel" class="carousel slide w-100" data-ride="carousel">
        <div class="carousel-inner w-100" role="listbox">
        <div class="carousel-item row active">';

    foreach ($products as $product) {

      $carouselContent .= $this->render('_partner_card', ['model'=>$productsparent,'model1' => $product, 'perPage' => $perPage]);
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
  } else if ($count > $perPage) {


    //        More than 3 partner ($count > 3) in this Category
    //        $pages = $count % $perPage; // == 2
    $id = "#partnerCarousel" . $category->id;
    $id_sans_diase = "partnerCarousel" . $category->id;
    $pages = (int) ceil($count / $perPage);
    $carouselContent .= '<div class="container text-center my-3">
    <div id="' .  $id_sans_diase . '" class="carousel slide w-100" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="' .  $id . '" data-slide-to="0" class="active"></li>
        <li data-target="' .  $id . '"data-slide-to="1"></li>
        <li data-target="' .  $id . '" data-slide-to="2"></li>
      </ol>
        <div class="carousel-inner w-100" role="listbox">';




    for ($page = 0; $page < $pages; $page++) {

      $carouselContent .= $this->render('_partner_page', [
        'model1' => $products,
        'partners' => $partners,
        'page' => $page,
        'perPage' => $perPage,
      ]);
    }


    $carouselContent .= '</div>
        <a class="carousel-control-btn carousel-control-prev btn-primary shadow" href="' . $id . '" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-btn carousel-control-next btn-primary shadow" href="' . $id . '" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>';
  } // if ($count <= 3)

  // Tabs Categories
  array_push($items, [
    'label' => '<b>' . $category->name . '</b>',
    'content' => $carouselContent,
    'active' => count($items) == 0
  ]);

  // Add Category's name to $categoriesNames
  array_push($categoriesNames, $category->name);
} // foreach ($categories)
?>
<!--<div class="form-group ">
  &nbsp;
</div>-->
<section class="pt-5 pb-5">
  <!-- Search Box -->
  <div class="row ">
    <div class="col mt-10 pt-5">

      <!--search for client i will create an activeForm with a model -->
      <?php $form = ActiveForm::begin([
        'id' => 'partner-registration-form',
        //'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'method' => 'post',
        'action' => ['site/send']
      ]); ?>
      <div class="form-group">
        <div class="row">
          <div id="Logo" class="col-sm-12 text-center">
            <?= Html::img('@web/logo.png', ['alt' => 'image','width'=>100,'height'=>100]); ?>
          </div>

        </div>
        <hr id="lineBeforeTitleLandingPage" class="col-sm-8 center" style="color:black">
        <h3 class="text-center" id="titleLandingPage"><b>FIND what you need for your event IN ONE CLICK</b></h3>
        <div class="row">
          <div class="col-sm-3">
            <div class="dropdown">
              <!-- input name="category" class="form-control" placeholder="Category" data-toggle="dropdown" class="dropdown-toggle" -->

              <?php echo $form->field($model, 'category')->widget(Select2::classname(), ([
                'name' => 'partner_category',
                'data' => $categoriesNames,

                'options' => ['placeholder' => 'Choisir le bien...']
              ])); ?>
          
            </div>
          </div>
          <div class="col-sm-6">
            <!-- input name="date_reservation" class="form-control" placeholder="CHOOSE A DATE?" -->

            <?php echo $form->field($model, 'date_depart', [
              'addon' => ['prepend' => ['content' => '<i class="fas fa-calendar-alt"></i>']],
              'options' => ['class' => 'drp-container form-group']
            ])->widget(DateRangePicker::classname(), ([
              'name' => 'date_range_3',
              'value' => '',
           
              'convertFormat' => true,
              'pluginOptions' => [
               // "maxSpan"=> [ "days"=> 0,"hour"=>30],
               // 'minDate'=>Date('Y-m-d'),
              //  'timePicker' => true,
            //    'timePickerIncrement' => 30,
       
                'locale' => ['format' => 'Y-m-d h:i A']
              ],
              'options' => ['placeholder' => 'Choisir Date...',   "autocomplete"=> "off"]
            ]));
            ?>


          </div>
          <div class="col-sm-3">
            <div class="dropdown">
              <!-- input name="category" class="form-control" placeholder="Category" data-toggle="dropdown" class="dropdown-toggle" -->

              <?php echo $form->field($model, 'place')->widget(Select2::classname(), ([
                'name' => 'place_algeria',

                'data' =>[
                   "Adrar"=> "Adrar",
                    "Chlef"=>"Chlef",
                    "Laghouat"=>"Laghouat",
                    "Oum El Bouaghi"=> "Oum El Bouaghi",
                    "Batna"=>"Batna",
                    "Béjaia"=>"Béjaia",
                    "Biskra"=>"Biskra",
                    "Béchar"=>"Béchar",
                    "Blida"=>"Blida",
                    "Bouira"=>"Bouira",
                    "Tamanrasset"=>"Tamanrasset",
                    "Tébessa"=>"Tébessa",
                    "Télemcen"=>"Télemcen",
                    "Tiaret"=>"Tiaret",
                    "Tizi Ouzou"=>"Tizi Ouzou",
                    "Alger",
                    "Djelfa",
                    "Jijel",
                    "Sétif",
                    "Saida",
                    "Skikda",
                    "Sidi Bel Abbès",
                    "Annaba",
                    "Guelma",
                    "Constantine",
                    "Médéa",
                    "Mostaganem",
                    "M'Sila",
                    "Mascara",
                    "Ouargla",
                    "Oran",
                    "El Bayadh",
                    "Illizi",
                    "Bordj Bou Arreridj",
                    "Boumerdes",
                    "El Tarf",
                    "Tindouf",
                    "Tissemsilt",
                    "El Oued",
                    "Khenchla",
                    "Souk Ahras",
                    "Tipaza",
                    "Mila",
                    "Ain Defla",
                    "Naama",
                    "Ain Témouchent",
                    "Ghardaia",
                    "Relizane",
                    "Timimoun",
                    "Bordj Badji Mokhtar",
                    "Ouled Djallal",
                    "Béni Abbès",
                    "In Salah",
                    "In Guezzam",
                    "Touggourt",
                    "Djanet",
                    "El M'Ghair",
                    "Meniaa"],

                'options' => ['placeholder' => 'Choisir la willaya...']
              ])); ?>
            


            </div>
          </div>

        </div>
       
        <div class="row float-right">
          <div class="col-sm-12 mt-2">
            <!--<input type="submit" class="btn btn-primary shadow ml-sm-auto" value="SEARCH...">-->
            <?= Html::submitButton('<span style="color:#fff;">Rechercher...</span>', ['class' => 'btn bg-purple shadow ml-sm-auto','style'=>'color:#fff;']) ?>
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
        'position' => TabsX::POS_ABOVE,
        'align' => TabsX::ALIGN_LEFT,
        'bordered' => true,
        'encodeLabels' => false,
        'items' => $items
      ]);  ?>
    </div>
  </div><!-- .row -->

</section>
