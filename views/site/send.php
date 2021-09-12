<?php

/* @var $this yii\web\View */
//use yii\helpers\Html;
use yii\widgets\Pjax;
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
$this->title = 'Reservation';
use yii\widgets\LinkPager ;

$categoriesNames = [];
$items = [];
$categories = \app\models\PartnerCategory::find()->all();
foreach ($categories as $category) {
array_push($categoriesNames, $category->name);
echo
    '<style>
.has-star{
  display:none;
  }


</style>';
}
?>

   
                          



                        
<div id="loaderDiv" class="loader "></div>
<div id="some_pjax_id"></div>
<input type="hidden" id="hiddenfilter" name="custId" value="<?php if(isset($filter)) echo $filter;?>">
      <?php 



//Pjax::begin(['id' => 'some_pjax_id']);

/*echo ListView::widget([
  'dataProvider'=>$dataProvider,

  'itemView' => function ($model, $key, $index, $widget) {
     return $this->render("_filter_card",['model1' => $model]);

     // or just do some echo
     // return $model->title . ' posted by ' . $model->author;
 }, // this is where you have to specify the view file


 'layout' => '{items}', // here you can specify how the listview should render your custom view file. {items} is the list items and {pager} is the pagination component
  'itemOptions'=>[
    'tag'=>false, // we don't want the wrapping div for each item

  ]
  // itemOptions is the place where we can add Html attribute for the wrapper element
]);*/
  //Pjax::end() ;



 /*$content1= LinkPager::widget([
    'pagination' => $pages,
   'linkOptions'=>[
      'class'=>"page-link ",
      'style'=>'.prev .disabled{
          content: "";
      }'
   ]
    
 ]);
// $content=$content.$content1;*/
$ls = '
$( document ).ready(function() {

 $("ul .pagination  li a").addClass("page-link");
  function fetch() {
    var prix=0;
    var type_of_room = [];
    var space_for_rent=[];
    var accepts=[];
    var facilities=[];
    var transport;
    var parking;
    var filter;
    var filter = $("#hiddenfilter").val();
//getting the first variable Prix
  
    var active=1;

      $.ajax({
        type: "POST",
        url: "?r=site/filter&price="+prix +"&type_of_room="+type_of_room+"&space_for_rent="+space_for_rent+"&accepts="+accepts+"&facilities="+facilities+"&transport="+transport+"&parking="+parking+"&active=" + active+"&filter="+filter,
       
        data: {filter:filter},
        dataType: "html",
        beforeSend: function () {
         // $("#some_pjax_id").html(" ");
          $("#loaderDiv").show();
        },
        success: function (data) {
          
          $("#loaderDiv").hide();
          $("#some_pjax_id").html(data);
        },
      });
    
  }
fetch()

 
  
 
});


';

$this->registerJs($ls);
?>



        
   

   

  

   

   
 