<?php

use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use kartik\tabs\TabsX;


$categoriesNames = [];
$items = [];
echo
'<style>
.has-star{
  display:none;
  }

</style>';
Pjax::begin([
  'id' => 'pjax',
  'enablePushState' => true,  // I would like the browser to change link
  'timeout' => 10000 // Timeout needed
]);


$content = ListView::widget([
  'dataProvider' => $dataProvider,
  'itemView' => function ($model, $key, $index, $widget) {
    return $this->render("_filter_card", ['model1' => $model,'subCategory'=>$_SESSION['subcategory'] , 'qte_search' => $_SESSION['nbr_persson'], 'deliveryPrice' => $_SESSION["deliveryPrice"]]);

    // or just do some echo
    // return $model->title . ' posted by ' . $model->author;
  }, // this is where you have to specify the view file


  'layout' => '{items}{pager}', // here you can specify how the listview should render your custom view file. {items} is the list items and {pager} is the pagination component
  'itemOptions' => [
    'id' => 'member_tab',
    'tag' => false, // we don't want the wrapping div for each item

  ],

  // itemOptions is the place where we can add Html attribute for the wrapper element
]);


$label = ['<div class="dropdown">
<button class="btn  dropdown-toggle bg-purple" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <span style="color:#fff;">Sort by:</span>
</button>
<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
  <button class="dropdown-item" id="ascending" type="button" value="ascending">price ascending</button>
  <button class="dropdown-item" id="desending" type="button" value="desending">price desending</button>
</div>
</div>', 'Popular', 'Customer rating'];
for ($i = 0; $i < 3; $i++) {
  array_push($items, [
    'label' => $label[$i],
    'id' => 'MyTabs',
    'content' => $content,
    'active' => count($items) == 0
  ]);
}

echo TabsX::widget([
  "id" => "tabs",
  'position' => TabsX::POS_ABOVE,
  'align' => TabsX::ALIGN_LEFT,
  'bordered' => true,
  'encodeLabels' => false,
  'items' => $items
  //              [
  //                  [ 'label' => 'One', 'content' => 'Anim pariatur cliche...', 'active' => true ],
  //                  [ 'label' => 'Two', 'content' => 'Anim pariatur cliche...', 'headerOptions' => [], 'options' => ['id' => 'myveryownID'], ],
  //               ],
]);

$ts = '
  $( document ).ready(function() {
   
   
 
     $("li.prev.disabled span").empty();
 
     });
 ';
$this->registerJs($ts);
if (isset($_SESSION['active1'])) {

  echo '<div id="namiro1" style="display:none">' . $_SESSION['active1'] . '</div>';
} else {

  echo '<div id="namiro1" style="display:none">' . $_SESSION['active'] . '</div>';
}

echo '<div id="namiro" style="display:none"></div>';
//here traitement of each appropriate function

include('action/action_sort_price.php');
$this->registerJs($ms);
if (empty($filter))
  $filter = $category;
if (isset($_SESSION['filter']))
  $filter = $_SESSION['filter'];

if ($filter == 1) {
  include('action/action_room_rental.php');
  $this->registerJs($ls);
}

if ($filter == 2) {
  include('action/action_equipement.php');
  $this->registerJs($ls);
}
if ($filter == 3) {
  include('action/action_caters.php');
  $this->registerJs($ls);
}
if ($filter == 4) {
  include('action/action_photo.php');
  $this->registerJs($ls);
}
if ($filter == 5) {
  include('action/action_room_rental.php');
  $this->registerJs($ls);
}
if ($filter == 6) {
  include('action/action_Security.php');
  $this->registerJs($ls);
}
if ($filter == 7) {

  include('action/action_host.php');
  $this->registerJs($ls);
}
if ($filter == 9) {
  include('action/action_Other.php');
  $this->registerJs($ls);
}

echo '<input type="hidden" id="browser" value="' . $filter . '">';


//}
Pjax::end();
