<?php

use yii\helpers\Html;
use app\models\ProductItem;
use app\models\ProductParent;

/* @var $this yii\web\View */
/* @var $model app\models\ProductItem */

$product=ProductItem::find()->andwhere(['id'=>$_GET['id']])->one();
$product_parent=ProductParent::find()->andwhere(['id'=>$product->product_id])->One();
$name=$model->name;
if($product->partner_category=="6"){
	$name=json_decode($model->name,true);
	$name=$name[0];	
}
$this->title = 'Update Product Item: ' . ' ' .$name ;
$this->params['breadcrumbs'][] = ['label' => 'Product Item', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="product-item-update">

    <h1><?= Html::encode($this->title) ?></h1>
	<?php


	
	
	if($product->partner_category=="1")
	{
	 ?>
	<?=	$this->render('_viewRoomRental.php', [
        'model' => $model,
        'product_parent'=>$product_parent
    ])?>
    <?php 
	}
  
   	if($product->partner_category=="3")
	{
	 ?>
	<?=	$this->render('_viewcaters.php', [
        'model' => $model,
        'product_parent'=>$product_parent
    ])?>
    <?php 
	}

		 	if($product->partner_category=="4"||$product->partner_category=="5"||$product->partner_category=="7"||$product->partner_category=="8")
	{
	 ?>
	<?=	$this->render('_viewpricedayandnight.php', [
        'model' => $model,
        'product_parent'=>$product_parent
    ])?>
    <?php 
	}
	 if($product->partner_category=="9"||$product->partner_category=="6"||$product->partner_category=="2"){
	 ?>
	<?=	$this->render('_view', [
        'model' => $model,
    ])?>
    <?php 
	}


	?>

</div>
