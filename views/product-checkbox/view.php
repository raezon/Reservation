vide<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
header('Content-type:application/json;charset=utf-8');

/* @var $this yii\web\View */
/* @var $model app\models\ProductItem */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-item-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Product Item'.' '. Html::encode($this->title) ?></h2>
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

    <div class="row">

<?php 
    $caters="";
    $c=$model->checkbox;
    
   //var_dump($c);
      
    // after using extract() function 
    //$json = json_decode(file_get_contents($c), true);
    //print_r($json);
   // echo  $c["vegan"];
        $j=array();
        $j[]=$c;
    /*$jsonData = trim($j);*/

   
    $array_caters=json_decode($c,true);
   
    
  /*  $json = utf8_encode($j);
$data = json_decode($json);
    var_dump($data);
     $json=array();*/
    
   if (array_key_exists("vegan",$array_caters))
                  {
                    if($array_caters['vegan']!="vide")
                      $caters.=$array_caters['vegan'].'  </br>';
                  }
    if (array_key_exists("Vegetarian",$array_caters))
                  {
                    if($array_caters['Vegetarian']!="vide")
                      $caters.=$array_caters['Vegetarian'].'  </br>';
                  }
    if (array_key_exists("Organic",$array_caters))
                  {
                    if($array_caters['Organic']!="vide")
                      $caters.=$array_caters['Organic'].'  </br>';
                  }
    if (array_key_exists("Gluten_free",$array_caters))
                  {
                     if($array_caters['Gluten_free']!="vide")
                      $caters.=$array_caters['Gluten_free'].'  </br>';
                  }
    if (array_key_exists("Halal",$array_caters))
                  {
                     if($array_caters['Halal']!="vide")
                      $caters.=$array_caters['Halal'].'  </br>';
                  }
    if (array_key_exists("Cacher",$array_caters))
                  {
                     if($array_caters['Cacher']!="vide")
                      $caters.=$array_caters['Cacher'].'  </br>';
                  }
    if (array_key_exists("Without_porc",$array_caters))
                  {
                     if($array_caters['Without_porc']!="vide")
                      $caters.=$array_caters['Without_porc'].'  </br>';
                  }
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'partner_category',
        'name',
        'temp',
          [
                'attribute' => 'html',
                'label' => Yii::t('app', 'food checked'),
                'value' => $caters,
                'format'=>'raw',

            ],
        [
            'attribute' => 'product.name',
            'label' => 'Product',
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>