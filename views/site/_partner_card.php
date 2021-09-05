<?php
use \yii\helpers\Html;
use \yii\helpers\Url;
use yii\helpers\HtmlPurifier;
/**
 * model: Partner object
 */
Yii::setAlias('@productImgUrl','img/products');

?>

<div class="col-<?= 12 / $perPage ?> float-left">
    <div class="card mb-2">
         
    	<?php 
            if($model1->partner_category==4){
                
                $images=json_decode($model1->picture,true);
                if(is_array($images))
                    $path=Yii::getAlias('@productImgUrl').'/'.$images[0];

                 else
                     $path=Yii::getAlias('@productImgUrl').'/'.$model1->picture;
                            }else{
                $path=Yii::getAlias('@productImgUrl').'/'.$model1->picture;
            }
     
      
    	if($model1->picture!="") {
        echo  Html::img($path,['width'=>'auto','height'=>150]);
    	}
    	 ?>
        <div class="card-body">

          <h4 class="card-title"><?= Html::encode($model1->name) ?></h4>
          <?php
          if($model1->partner_category==7||$model1->partner_category==8||$model1->partner_category==5){?>
           
            <p class="card-text"><?= $model1->price_day.''.$model1->currencies_symbol ?></p>
            <p class="card-text"><?= $model1->price_night.''.$model1->currencies_symbol ?></p>
            <a class="btn btn-info shadow" href="<?=Url::to(['site/product', 'id' => $model1->id])?>">Details</a>
             



          
            <?php
            // Url::to(['site/product', 'id' => $model1->id])
          }else{
            ?>
            <p class="card-text"><?= $model1->price.''.$model1->currencies_symbol ?></p>
            <a class="btn btn-info shadow" href="<?=Url::to(['site/product', 'id' => $model1->id])?>">Details</a>
            <?php
          }
             ?>


        </div>

    </div>
  </div>
