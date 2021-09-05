<?php 
use \yii\helpers\Html;
use \yii\helpers\Url;
/**
 * model: Partner object
 */



?>

<div class="col-<?= 12 / $perPage ?> float-left">
    <div class="card mb-2">   
        <div class="card-body">
          <h4 class="card-title"><?= Html::encode($model1->name) ?></h4>
          <p class="card-text"><?= $model1->price ?></p>
          <a class="btn btn-info shadow" href="<?= Url::to(['site/product', 'id' => $model1->id]) ?>">Details</a>
        </div>


    </div>
</div>