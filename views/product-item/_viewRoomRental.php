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
        'label' => 'Partner Category',
      ],
      'name',
      [
        'attribute' => 'temp',
        'label' => 'Produit nom',
        'value' => function ($model) {
        
              $name=json_decode( $model->temp,true);
              return $name[0];
          
        }

      ],
      [
        'attribute' => 'description',
        'label' => 'Produit options',
        'value' => function ($model) {
        
          $name=json_decode( $model->description,true);
          return $name[0];
      
}
      ],

     
      'number_of_agent',
      'quantity',
      'periode',
      'currencies_symbol',
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

      [
        'label' => Yii::t('app', 'Area'),
        'value' => $area . 'm²',
        'format' => 'html',
      ],
     /*[
        'label' => Yii::t('app', 'Caution'),
        'value' => $caution . '' . $model->currencies_symbol
      ],
       [
        'label' => Yii::t('app', 'Minimal Consomation'),
        'value' => $minimal . '' . $model->currencies_symbol
      ],*/
      [
        'label' => Yii::t('app', 'Rental information'),
        'value' => $Rental_information,
        'format' => 'raw',
      ],
      [
        'attribute' => 'html',
        'label' => Yii::t('app', 'Rental Facilities'),
        'value' => $Facilities,
        'format' => 'raw',
      ],
      [
        'attribute' => 'html',
        'label' => Yii::t('app', 'Transport'),
        'value' => $transport,
        'format' => 'raw',

      ],

      [
        'attribute' => 'status',
        'format' => 'html',
        'label' => 'Status',
        'value' => function ($model) {
          if ($model->status == "0") {
            $status = "not active";
          } else {
            $status = "active";
          }
          return $status;
        },

      ],
      [
        'attribute' => 'html',
        'label' => Yii::t('app', 'Minimum rental period (in hour)'),
        'value' => function($model){
          $affichage="";
          $checkbox=json_decode($model->checkbox,true);
          $checkbox=$checkbox[0];
         
         
        return  $checkbox;
        },
        'format' => 'raw',
      ],
      [
        'attribute' => 'html',
        'label' => Yii::t('app', 'Maximum rental period (in hour)'),
        'value' => function($model){
          $affichage="";
          $checkbox=json_decode($model->checkbox,true);
          $checkbox=$checkbox[1];
         
         
        return  $checkbox;
        },
        'format' => 'raw',
      ],
      [
        'attribute' => 'html',
        'label' => Yii::t('app', 'Minimum number of guests to ordery'),
        'value' => function($model){
          $affichage="";
          $checkbox=json_decode($model->checkbox,true);
          $checkbox=$checkbox[2];
         
         
        return  $checkbox;
        },
        'format' => 'raw',
      ],
       [
        'attribute' => 'Maximum number of guests / accommodation capacity',
        'format' => 'html',
        'label' => 'Maximum number of guests / accommodation capacity',
        'value' => function ($model) {
         
          return  $model->people_number;
        },

      ],
      [
        'attribute' => 'html',
        'label' => Yii::t('app', 'Closed day'),
        'value' => function($model){
          $affichage="";
          $checkbox=json_decode($model->checkbox,true);
          $checkbox=$checkbox[4];
         
         
        return  $checkbox;
        },
        'format' => 'raw',
      ],
      [
        'attribute' => 'html',
        'label' => Yii::t('app', 'Rental periods and the price by person for each period'),
        'value' => function($model){
          $affichage="";
          $checkbox=json_decode($model->checkbox,true);
          $checkbox=$checkbox[8];
          $affichage.="<table style=''>";
          $affichage.="
          <thead>
            <tr>
              <th>From</th>
              <th>To</th>
              <th>Banquet \Dinner</th>
              <th>Cinema</th>
              <th>Cocktail</th>
              <th>Conference</th>
              <th>Meeting</th>
              <th>Theater</th>
            </tr>
          </thead>";
          $affichage.="<tbody >";
          foreach($checkbox as $e){
            $affichage.="<tr>";
            $affichage.="<td>".$e['From']."</td>";
            $affichage.="<td>".$e['To']."</td>";
            $affichage.="<td>".$e['Banquet \ Dinner']." €</td>";
            $affichage.="<td>".$e['Cinema']." €</td>";
            $affichage.="<td>".$e['Cocktail']." €</td>";
            $affichage.="<td>".$e['Conference']." €</td>";
            $affichage.="<td>".$e['Meeting']." €</td>";
            $affichage.="<td>".$e['Theater']." €</td>";
            $affichage.="</tr>";
          }
          $affichage.="</tbody></table>";
        return  $affichage;
        },
        'format' => 'raw',
      ],

      [
        'attribute' => 'product_id',
        'format' => 'html',
        'label' => 'extra',
        'value' => function ($model) {
          $product_parent = ProductParent::find()->andwhere(['id' => $model])->One();
          $array_extra = "";
          $i = 0;


          $array_type_caterss = json_decode($product_parent->extra, true);
          if (!is_array($array_type_caterss))
            $array_type_caterss = array();


          foreach ($array_type_caterss as $array_type_caters) {

            if (array_key_exists('Description', $array_type_caters)) {
              if ($array_type_caters['Description'] != '0')
                $array_extra .= 'Description :' . $array_type_caters['Description'] . ",";
            }
            if (array_key_exists('Quantity', $array_type_caters)) {
              if ($array_type_caters['Quantity'] != '0')
                $array_extra .= "Quantity :" . $array_type_caters['Quantity'] . ",";
            }
            if (array_key_exists("Price", $array_type_caters)) {
              if ($array_type_caters['Price'] != '0')
                $array_extra .= "Price :" . $array_type_caters['Price'] . "<br>";
            }
            $i++;
          }

          return $array_extra;
        },
      ]

    ];
    echo DetailView::widget([
      'model' => $model,
      'attributes' => $gridColumn
    ]);
    ?>
  </div>
</div>