<?php
use \yii\helpers\Html;
use \yii\helpers\Url;
use yii\helpers\HtmlPurifier;
/**
 * model: Partner object
 */
Yii::setAlias('@productImgUrl','uploads/bien');

?>

<div class="col-<?= 12 / $perPage ?> float-left">
    <div class="card mb-2">
         
    	<?php 
      switch ($model1->partner_category) {
        case '1':
          $path=Yii::getAlias('@productImgUrl').'/'.'hotel.jpg';
          break;
        case '2':
          $path=Yii::getAlias('@productImgUrl').'/'.'vitrine.jpg';
          break;
        case '3':
          $path=Yii::getAlias('@productImgUrl').'/'.'restaurant.jpg';
          break;
        case '8':
          $path=Yii::getAlias('@productImgUrl').'/'.'transport.jpg';
          break;

        default:
          # code...
          break;
      }

     
      

        echo  Html::img($path,['width'=>'auto','height'=>150]);
    	
    	 ?>
        <div class="card-body">

        <h4 class="card-title"><?= Html::encode('Vitrine') ?></h4>

          <a class="btn btn-info shadow" href="<?=Url::to(['site/product', 'id' => $model1->id])?>">Voir Produit</a>
             
             


        </div>

    </div>
  </div>
