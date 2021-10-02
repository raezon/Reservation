<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use kartik\money\MaskMoney;
use app\models\ProductParent;

/* @var $this yii\web\View */
/* @var $model app\models\ProductItem */
echo '
<style>
  table, th, td {
    border: 1px solid black;
  }
</style>
';
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Item', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-item-view">

  <div class="row">
    <div class="col-sm-9">
      <h2><?= 'Product Item' . ' ' . Html::encode($this->title) ?></h2>
    </div>
    <div class="col-sm-3" style="margin-top: 15px">

      <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
      <?= Html::a('Delete', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
          'confirm' => 'Are you sure you want to delete this item?',
          'method' => 'post',
        ],
      ])
      ?>
    </div>
  </div>
  <?php
  /* $array_type_room_rental[0]["services_facilities"]['name']= $services_facilities['Description'][0];
          $array_type_room_rental[0]["services_facilities"]['name']= $services_facilities['Description'][1];
          $array_type_room_rental[0]["services_facilities"]['name']= $services_facilities['Description'][2];
          $array_type_room_rental[0]["services_facilities"]['name']= $services_facilities['Description'][3];
          $array_type_room_rental[0]["services_facilities"]['name']= $services_possiblity['Possibility_check_name'][0];
          $array_type_room_rental[0]["services_possiblity"]['name']= $services_possiblity['Possibility_check_name'][1];
          $array_type_room_rental[0]["services_possiblity"]['name']= $services_possiblity['Possibility_check_name'][2];
          $array_type_room_rental[0]["services_possiblity"]['name']= $services_possiblity['Possibility_check_name'][3];
          ;
          $array_type_room_rental[0]["services_transport"]['name']= $services_transport[0]['Transportation_name'];
          $array_type_room_rental[0]["services_transport"]['field']=$services_transport[0]['route number'];
          $array_type_room_rental[0]["services_transport"]['name']= $services_transport[1]['Transportation_name'];
          $array_type_room_rental[0]["services_transport"]['field']=$services_transport[1]['route number'];
          $array_type_room_rental[0]["services_transport"]['name']= $services_transport[2]['Transportation_name'];
          $array_type_room_rental[0]["services_transport"]['field']=$services_transport[2]['route number'];
          $array_type_room_rental[0]["services_transport"]['name']= $services_transport[3]['Transportation_name'];
          $array_type_room_rental[0]["services_transport"]['field']=$services_transport[3]['route number'];*/

  ?>

  <div class="row">
    <?php

    $array_type_room_rental = json_decode($model->product_type, true);


    if (is_array($array_type_room_rental)) {
      $Caters = "";
      $area = 0;
      $caution = 0;
      $Rental_information = " ";
      $minimal = "";
      //this variable is form some chebox in the room rental in the section Information
      $Facilities = "";
      // print_r($array_type_room_rental);
      // echo $array_type_room_rental['0']['caution'];
      // die();
      if (array_key_exists("area", $array_type_room_rental['0'])) {

        $area .= $array_type_room_rental['0']['area'] . '</br>';
      }

      if (array_key_exists("caution", $array_type_room_rental['0'])) {
        $caution = $array_type_room_rental['0']['caution'];
      }

      if (array_key_exists("Minimum_consumption_Price", $array_type_room_rental['0'])) {
        $minimal = $array_type_room_rental['0']['Minimum_consumption_Price'];
      }

      if (array_key_exists("event_cake", $array_type_room_rental['0'])) {
        if ($array_type_room_rental['0']['event_cake'] != '0')
          $Rental_information .= $array_type_room_rental['0']['event_cake'] . '  </br>';
      }
      if (array_key_exists("drink", $array_type_room_rental['0'])) {
        if ($array_type_room_rental['0']['drink'] != '0')
          $Rental_information .= $array_type_room_rental['0']["drink"] . "<br>";
      }
      if (array_key_exists("External_food", $array_type_room_rental['0'])) {
        if ($array_type_room_rental['0']['External_food'] != '0')
          $Rental_information .= $array_type_room_rental['0']['External_food'] . '</br>';
      }
      if (array_key_exists("External_Catering", $array_type_room_rental['0'])) {
        if ($array_type_room_rental['0']['External_Catering'] != '0')
          $Rental_information .= $array_type_room_rental['0']['External_Catering'] . '</br>';
      }
      if (array_key_exists("Internal_Catering", $array_type_room_rental['0'])) {
        if ($array_type_room_rental['0']['Internal_Catering'] != '0')
          $Rental_information .= $array_type_room_rental['0']['Internal_Catering'] . '</br>';
      }
      if (array_key_exists("Without_guarantee", $array_type_room_rental['0'])) {
        if ($array_type_room_rental['0']['Without_guarantee'] != '0')
          $Rental_information .= $array_type_room_rental['0']['Without_guarantee'] . '</br>';
      }
      if (array_key_exists("Possibility_check_name", $array_type_room_rental[0][0]["services_possiblity"])) {
        if ($array_type_room_rental[0][0]["services_possiblity"]['Possibility_check_name'] != '0')
          $Rental_information .= $array_type_room_rental[0][0]["services_possiblity"]['Possibility_check_name'] . '  </br>';
      }
      if (array_key_exists("Possibility_check_name", $array_type_room_rental[0][1]["services_possiblity"])) {
        if ($array_type_room_rental[0][1]["services_possiblity"]['Possibility_check_name'] != '0')
          $Rental_information .= $array_type_room_rental[0][1]["services_possiblity"]['Possibility_check_name'] . '  </br>';
      }
      if (array_key_exists("Possibility_check_name", $array_type_room_rental[0][2]["services_possiblity"])) {
        if ($array_type_room_rental[0][2]["services_possiblity"]['Possibility_check_name'] != '0')
          $Rental_information .= $array_type_room_rental[0][2]["services_possiblity"]['Possibility_check_name'] . '</br>';
      }
      if (array_key_exists("Possibility_check_name", $array_type_room_rental[0][3]["services_possiblity"])) {
        if ($array_type_room_rental[0][3]["services_possiblity"]['Possibility_check_name'] != '0')
          $Rental_information .= $array_type_room_rental[0][3]["services_possiblity"]['Possibility_check_name'] . '  </br>';
      }
      if (array_key_exists("Possibility_check_name", $array_type_room_rental[0][4]["services_possiblity"])) {
        if ($array_type_room_rental[0][4]["services_possiblity"]['Possibility_check_name'] != '0')
          $Rental_information .= $array_type_room_rental[0][4]["services_possiblity"]['Possibility_check_name'] . '  </br>';
      }
      if (array_key_exists("Possibility_check_name", $array_type_room_rental[0][5]["services_possiblity"])) {
        if ($array_type_room_rental[0][5]["services_possiblity"]['Possibility_check_name'] != '0')
          $Rental_information .= $array_type_room_rental[0][5]["services_possiblity"]['Possibility_check_name'] . '  </br>';
      }
      if (array_key_exists("Possibility_check_name", $array_type_room_rental[0][6]["services_possiblity"])) {
        if ($array_type_room_rental[0][6]["services_possiblity"]['Possibility_check_name'] != '0')
          $Rental_information .= $array_type_room_rental[0][6]["services_possiblity"]['Possibility_check_name'] . '</br>';
      }
      if (array_key_exists("Possibility_check_name", $array_type_room_rental[0][7]["services_possiblity"])) {
        if ($array_type_room_rental[0][7]["services_possiblity"]['Possibility_check_name'] != '0')
          $Rental_information .= $array_type_room_rental[0][7]["services_possiblity"]['Possibility_check_name'] . '  </br>';
      }


      ////////////////////////////////////////////////////////////////////////////////////
      $Facilities = "";

      if (array_key_exists(" Wifi", $array_type_room_rental['0'])) {
        if ($array_type_room_rental['0']['Wifi'] != '0')
          $Facilities .= $array_type_room_rental['0']['Wifi'] . '</br>';
      }
      if (array_key_exists("Board", $array_type_room_rental['0'])) {
        if ($array_type_room_rental['0']['Board'] != '0')
          $Facilities .= $array_type_room_rental['0']['Board'] . '</br>';
      }
      if (array_key_exists("event_cake", $array_type_room_rental['0'])) {
        if ($array_type_room_rental['0']['event_cake'] != '0')
          $Facilities .= $array_type_room_rental['0']['event_cake'] . '</br>';
      }
      if (array_key_exists("System_Sound", $array_type_room_rental['0'])) {
        if ($array_type_room_rental['0']['System_Sound'] != '0')
          $Facilities .= $array_type_room_rental['0']['System_Sound'] . '</br>';
      }
      if (array_key_exists("Micro", $array_type_room_rental['0'])) {
        if ($array_type_room_rental['0']['Micro'] != '0')
          $Facilities .= $array_type_room_rental['0']['Micro'] . '</br>';
      }
      if (array_key_exists("Video projector", $array_type_room_rental['0'])) {
        if ($array_type_room_rental['0']['Video projector'] != '0')
          $Facilities .= $array_type_room_rental['0']['Video projector'] . '</br>';
      }
      if (array_key_exists("Internal_Catering", $array_type_room_rental['0'])) {
        if ($array_type_room_rental['0']['Internal_Catering'] != '0')
          $Facilities .= $array_type_room_rental['0']['Internal_Catering'] . '  </br>';
      }
      if (array_key_exists("Without_guarantee", $array_type_room_rental['0'])) {
        if ($array_type_room_rental['0']['Without_guarantee'] != '0')
          $Facilities .= $array_type_room_rental['0']['Without_guarantee'] . '  </br>';
      }
      //extra facilities
      if (array_key_exists("name", $array_type_room_rental[0][0]["services_facilities"])) {
        if ($array_type_room_rental[0][0]["services_facilities"]['name'] != '0')
          $Facilities .= $array_type_room_rental[0][0]["services_facilities"]['name'] . '  </br>';
      }
      if (array_key_exists("name", $array_type_room_rental[0][1]["services_facilities"])) {
        if ($array_type_room_rental[0][1]["services_facilities"]['name'] != '0')
          $Facilities .= $array_type_room_rental[0][1]["services_facilities"]['name'] . '  </br>';
      }
      if (array_key_exists("name", $array_type_room_rental[0][2]["services_facilities"])) {
        if ($array_type_room_rental[0][2]["services_facilities"]['name'] != '0')
          $Facilities .= $array_type_room_rental[0][2]["services_facilities"]['name'] . '  </br>';
      }
      if (array_key_exists("name", $array_type_room_rental[0][3]["services_facilities"])) {
        if ($array_type_room_rental[0][3]["services_facilities"]['name'] != '0')
          $Facilities .= $array_type_room_rental[0][3]["services_facilities"]['name'] . '  </br>';
      }
      if (array_key_exists("name", $array_type_room_rental[0][4]["services_facilities"])) {
        if ($array_type_room_rental[0][4]["services_facilities"]['name'] != '0')
          $Facilities .= $array_type_room_rental[0][4]["services_facilities"]['name'] . '  </br>';
      }
      if (array_key_exists("name", $array_type_room_rental[0][5]["services_facilities"])) {
        if ($array_type_room_rental[0][5]["services_facilities"]['name'] != '0')
          $Facilities .= $array_type_room_rental[0][5]["services_facilities"]['name'] . '  </br>';
      }
      if (array_key_exists("name", $array_type_room_rental[0][6]["services_facilities"])) {
        if ($array_type_room_rental[0][6]["services_facilities"]['name'] != '0')
          $Facilities .= $array_type_room_rental[0][6]["services_facilities"]['name'] . '  </br>';
      }
      if (array_key_exists("name", $array_type_room_rental[0][7]["services_facilities"])) {
        if ($array_type_room_rental[0][7]["services_facilities"]['name'] != '0')
          $Facilities .= $array_type_room_rental[0][7]["services_facilities"]['name'] . '  </br>';
      }



      //////////////////////////////////////////////////////////////////////////////





      ////////////////////////////////////////////////////////////
      $transport = "";
      if (array_key_exists("Subway", $array_type_room_rental['0'])) {
        if ($array_type_room_rental['0']['Subway']['name'] != '0')
          $transport .= $array_type_room_rental['0']['Subway']["name"] . ' Route: ' . $array_type_room_rental['0']['Subway']['field'] . '  </br>';
      }

      if (array_key_exists("bus", $array_type_room_rental['0'])) {
        if ($array_type_room_rental['0']['bus']['name'] != '0')
          $transport .= $array_type_room_rental['0']['bus']["name"] . ' Route: ' . $array_type_room_rental['bus']['field'] . '  </br>';
      }
      if (array_key_exists("train", $array_type_room_rental['0'])) {
        if ($array_type_room_rental['0']['train']['name'] != '0')
          $transport .= $array_type_room_rental['0']['train']["name"] . ' Route: ' . $array_type_room_rental['train']['field'] . '  </br>';
      }
      if (array_key_exists("Parking_lot", $array_type_room_rental['0'])) {
        if ($array_type_room_rental['0']['Parking_lot']['name'] != '0')
          $transport .= $array_type_room_rental['0']['Parking_lot']["name"] . ' Route: ' . $array_type_room_rental['0']['Parking_lot']['field'];
      }
      //extra transport array

      if (array_key_exists("Transportation_name", $array_type_room_rental['0']['0']["services_transport"])) {
        if ($array_type_room_rental[0][0]["services_transport"]['Transportation_name'] != '')
          $transport .= $array_type_room_rental[0][0]["services_transport"]['Transportation_name'] . "Route:" . $array_type_room_rental[0][0]["services_transport"]['route number'] . '</br>';
      }
      if (array_key_exists("Transportation_name", $array_type_room_rental[0][1]["services_transport"])) {
        if ($array_type_room_rental[0][1]["services_transport"]['Transportation_name'] != '')
          $transport .= $array_type_room_rental[0][1]["services_transport"]['Transportation_name'] . "Route:" . $array_type_room_rental[0][0]["services_transport"]['route number'] . '</br>';
      }
      if (array_key_exists("Transportation_name", $array_type_room_rental[0][2]["services_transport"])) {
        if ($array_type_room_rental[0][2]["services_transport"]['Transportation_name'] != '')
          $transport .= $array_type_room_rental[0][2]["services_transport"]['Transportation_name'] . "Route:" . $array_type_room_rental[0][0]["services_transport"]['route number'] . '</br>';
      }
      if (array_key_exists("Transportation_name", $array_type_room_rental[0][3]["services_transport"])) {
        if ($array_type_room_rental[0][3]["services_transport"]['Transportation_name'] != '')
          $transport .= $array_type_room_rental[0][3]["services_transport"]['Transportation_name'] . "Route:" . $array_type_room_rental[0][0]["services_transport"]['route number'] . ' </br>';
      }
      if (array_key_exists("Transportation_name", $array_type_room_rental['0']['4']["services_transport"])) {
        if ($array_type_room_rental[0][4]["services_transport"]['Transportation_name'] != '')
          $transport .= $array_type_room_rental[0][4]["services_transport"]['Transportation_name'] . "Route:" . $array_type_room_rental[0][0]["services_transport"]['route number'] . '</br>';
      }
      if (array_key_exists("Transportation_name", $array_type_room_rental[0][5]["services_transport"])) {
        if ($array_type_room_rental[0][5]["services_transport"]['Transportation_name'] != '')
          $transport .= $array_type_room_rental[0][5]["services_transport"]['Transportation_name'] . "Route:" . $array_type_room_rental[0][0]["services_transport"]['route number'] . '</br>';
      }
      if (array_key_exists("Transportation_name", $array_type_room_rental[0][6]["services_transport"])) {
        if ($array_type_room_rental[0][6]["services_transport"]['Transportation_name'] != '')
          $transport .= $array_type_room_rental[0][6]["services_transport"]['Transportation_name'] . "Route:" . $array_type_room_rental[0][0]["services_transport"]['route number'] . '</br>';
      }
      if (array_key_exists("Transportation_name", $array_type_room_rental[0][7]["services_transport"])) {
        if ($array_type_room_rental[0][7]["services_transport"]['Transportation_name'] != '')
          $transport .= $array_type_room_rental[0][7]["services_transport"]['Transportation_name'] . "Route:" . $array_type_room_rental[0][0]["services_transport"]['route number'] . ' </br>';
      }
    }
    ?>
    <?php
    $gridColumn = [
      ['attribute' => 'id', 'visible' => false],
      [
        'attribute' => 'partnerCategory.name',
        'label' => 'Nom du bien',
      ],
      [
        'attribute' => 'name',
        'label' => 'Nom du produit',
      ],
  
      [
        'attribute' => 'temp',
        'label' => 'Type produit',
        'value' => function ($model) {
        
              $name=json_decode( $model->temp,true);
              return $name[0];
          
        }

      ],


     
      'price',
      'quantity',
   
     
      [
        'attribute' => 'picture',
        'format' => 'html',
        'label' => 'Image',
        'value' => function ($model) {
          $img_name = (string)$model->picture;
          $images = json_decode($model->picture, true);
          $img_name = (string)$images[0];
          return Html::img('img/products/' . $img_name, ['width' => 100, 'height' => 100]);
        },

      ],


 





    ];
    echo DetailView::widget([
      'model' => $model,
      'attributes' => $gridColumn
    ]);
    ?>
  </div>
</div>