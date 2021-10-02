<?php

use yii\helpers\Html;
use app\models\ProductItem;
use app\models\ProductParent;

/* @var $this yii\web\View */
/* @var $model app\models\ProductItem */

$this->title = 'Modifier Produit: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Item', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="product-item-update">

    <h1><?= Html::encode($this->title) ?></h1>
	<?php

	$product=ProductItem::find()->andwhere(['id'=>$_GET['id']])->one();
	$product_parent=ProductParent::find()->andwhere(['id'=>$product->product_id])->One();
	
	
	if($product->partner_category=="1")
	{
	 ?>
	<?=	$this->render('_formRoomRental.php', [
        'model3' => new \app\models\forms\ServicesAndPriceForm(),
		'product_parent'=>$product_parent,
		'model'=>$model
		
    ])?>
    <?php 
	}
	  if($product->partner_category=="8")
	{
	 ?>
	<?=	$this->render('_formtransport', [
        'model' => $model,
        'product_parent'=>$product_parent
    ])?>
    <?php 
	}
	if($product->partner_category=="9")
	{
	 ?>
	<?=	$this->render('_formother', [
        'model' => $model,
        'product_parent'=>$product_parent
    ])?>
    <?php 
	}
   if($product->partner_category=="7")
	{
	 ?>
	<?=	$this->render('_formhost', [
        'model' => $model,
        'product_parent'=>$product_parent
    ])?>
    <?php 
	}
	if($product->partner_category=="2")
	{
	 ?>
	<?=	$this->render('_formequipement', [
        'model' => $model,
        'product_parent'=>$product_parent
    ])?>
    <?php 
	}
	if($product->partner_category=="3")
	{
	 ?>
	<?=	$this->render('_formcaters', [
        'model' => $model,
        'product_parent'=>$product_parent
    ])?>
    <?php 
	}

		if($product->partner_category=="4")
	{
	 ?>
	<?=	$this->render('_formphoto', [
        'model' => $model,
        'product_parent'=>$product_parent
    ])?>
    <?php 
	}if($product->partner_category=="5")
	{
	 ?>
	<?=	$this->render('_formanimation', [
        'model' => $model,
        'product_parent'=>$product_parent
    ])?>
    <?php 
	}if($product->partner_category=="6")
	{
	 ?>
	<?=	$this->render('_formsecurity', [
        'model' => $model,
        'product_parent'=>$product_parent
    ])?>
    <?php 
	}?>

</div>
