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

$this->title = 'ClicangoEvent';

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
  //j'ai fait mon changement

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
    $carouselContent = '<div class="alert alert-info text-center my-2"><h1>' . \Yii::t('app', 'No product found!') . '</h1></div>';
  } else if ($count <= $perPage) {
    // Less than 3 partners in this Category
    $carouselContent .= '<div class="container text-center my-3">
    <div id="partnerCarousel" class="carousel slide w-100" data-ride="carousel">
        <div class="carousel-inner w-100" role="listbox">
        <div class="carousel-item row active">';

    foreach ($products as $product) {

      $carouselContent .= $this->render('_partner_card', ['model1' => $product, 'perPage' => $perPage]);
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
        'action' => ['site/send']
      ]); ?>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-12 text-center">
            <?= Html::img('@web/logo.png', ['alt' => 'image']); ?>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-3">
            <div class="dropdown">
              <!-- input name="category" class="form-control" placeholder="Category" data-toggle="dropdown" class="dropdown-toggle" -->

              <?php echo $form->field($model, 'category')->widget(Select2::classname(), ([
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

          <div class="col-sm-4">
            <!-- input name="date_reservation" class="form-control" placeholder="CHOOSE A DATE?" -->

            <?php echo $form->field($model, 'date_depart', [
              'addon' => ['prepend' => ['content' => '<i class="fas fa-calendar-alt"></i>']],
              'options' => ['class' => 'drp-container form-group']
            ])->widget(DateRangePicker::classname(), ([
              'name' => 'date_range_3',
              'value' => '2015-10-19 12:00 AM - 2015-11-03 01:00 PM',
              'convertFormat' => true,
              'pluginOptions' => [
                'timePicker' => true,
                'timePickerIncrement' => 15,
                'locale' => ['format' => 'Y-m-d h:i ']
              ],
              'options' => ['placeholder' => 'Select range...']
            ]));
            ?>


          </div>
          <div class="col-sm-2">

            <?php
            echo $form->field($model, 'nbr_persson')->textInput([

              'class' => 'form-control',
              'placeholder' => 'People number...',
              'type' => 'number',
              'min' => '1',

            ]); ?>

          </div>
          <div class="col-sm-3">
            <?php
            echo $form->field($model, 'place')->textInput([
              'id' => 'autocomplete',
              'class' => 'form-control ',
              'placeholder' => 'NEAR TO?',



            ]); ?>
          </div>
        </div>
        <div class="row float-right">
          <div class="col-sm-12 mt-2">
            <!--<input type="submit" class="btn btn-primary shadow ml-sm-auto" value="SEARCH...">-->
            <?= Html::submitButton('SEARCH...', ['class' => 'btn btn-primary shadow ml-sm-auto']) ?>
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
        //              [
        //                  [ 'label' => 'One', 'content' => 'Anim pariatur cliche...', 'active' => true ],
        //                  [ 'label' => 'Two', 'content' => 'Anim pariatur cliche...', 'headerOptions' => [], 'options' => ['id' => 'myveryownID'], ],
        //               ],
      ]);  ?>
    </div>
  </div><!-- .row -->

</section>
<script>
  // This sample uses the Autocomplete widget to help the user select a
  // place, then it retrieves the address components associated with that
  // place, and then it populates the form fields with those details.
  // This sample requires the Places library. Include the libraries=places
  // parameter when you first load the API. For example:
  // <script
  // src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
  var placeSearch, autocomplete;

  var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
  };

  function initAutocomplete() {
    // Create the autocomplete object, restricting the search predictions to
    // geographical location types.

    autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('autocomplete'), {
        types: ['geocode']
      });

    // Avoid paying for data that you don't need by restricting the set of
    // place fields that are returned to just the address components.
    autocomplete.setFields(['address_component']);

    // When the user selects an address from the drop-down, populate the
    // address fields in the form.
    autocomplete.addListener('place_changed', fillInAddress);










    // Avoid paying for data that you don't need by restricting the set of
    // place fields that are returned to just the address components.
    //autocomplete.setFields(['address_component']);

    // When the user selects an address from the drop-down, populate the
    // address fields in the form.
    //autocomplete.addListener('place_changed', fillInAddress);
  }

  function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();

    for (var component in componentForm) {
      document.getElementById(component).value = '';
      document.getElementById(component).disabled = false;
    }

    // Get each component of the address from the place details,
    // and then fill-in the corresponding field on the form.
    for (var i = 0; i < place.address_components.length; i++) {
      var addressType = place.address_components[i].types[0];
      if (componentForm[addressType]) {
        var val = place.address_components[i][componentForm[addressType]];
        document.getElementById(addressType).value = val;
      }
    }
  }

  // Bias the autocomplete object to the user's geographical location,
  // as supplied by the browser's 'navigator.geolocation' object.
  function geolocate() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var geolocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        var circle = new google.maps.Circle({
          center: geolocation,
          radius: position.coords.accuracy
        });
        autocomplete.setBounds(circle.getBounds());
      });
    }
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7Iz5ZKGr0_5l_LD47xNf9umU7GSiUVuw&libraries=places&callback=initAutocomplete" async defer></script>