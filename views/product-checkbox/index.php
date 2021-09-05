<?php


use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = 'Product caters and security';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
  $('.search-form').toggle(1000);
  return false;
});";
$this->registerJs($search);
?>
<div class="product-item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php 
      
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'partner_category',
        'name',
         [
                'attribute' => 'checkbox',
                'label' => 'checkbox',
                'value' => function($model){
                    $caters="";
                    $c=$model->checkbox;
                    $j=array();
                    $j[]=$c;

                                       $array_caters=json_decode($c,true);


                   if (array_key_exists("vegan",$array_caters['0']))
                                  {
                                    if($array_caters['0']['vegan']!="vide")
                                      $caters.=$array_caters['0']['vegan'].'  </br>';
                                  }
                    if (array_key_exists("Vegetarian",$array_caters['0']))
                                  {
                                    if($array_caters['0']['Vegetarian']!="vide")
                                      $caters.=$array_caters['0']['Vegetarian'].'  </br>';
                                  }
                    if (array_key_exists("Organic",$array_caters['0']))
                                  {
                                    if($array_caters['0']['Organic']!="vide")
                                      $caters.=$array_caters['0']['Organic'].'  </br>';
                                  }
                    if (array_key_exists("Gluten_free",$array_caters['0']))
                                  {
                                     if($array_caters['0']['Gluten_free']!="vide")
                                      $caters.=$array_caters['0']['Gluten_free'].'  </br>';
                                  }
                    if (array_key_exists("Halal",$array_caters['0']))
                                  {
                                     if($array_caters['0']['Halal']!="vide")
                                      $caters.=$array_caters['0']['Halal'].'  </br>';
                                  }
                    if (array_key_exists("Cacher",$array_caters['0']))
                                  {
                                     if($array_caters['0']['Cacher']!="vide")
                                      $caters.=$array_caters['0']['Cacher'].'  </br>';
                                  }
                    if (array_key_exists("Without_porc",$array_caters['0']))
                                  {
                                     if($array_caters['0']['Without_porc']!="vide")
                                      $caters.=$array_caters['0']['Without_porc'].'  </br>';
                                  }
                                    return $caters;
                                },
                'format'=>'raw'
               
            ],
     
        [
            'class' => 'yii\grid\ActionColumn',
        ],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-product-item']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        'export' => false,
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Full',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">Export All Data</li>',
                    ],
                ],
                'exportConfig' => [
                    ExportMenu::FORMAT_PDF => false
                ]
            ]) ,
        ],
    ]); ?>


</div>



