<?php

use yii\helpers\Html;
use app\models\User;
use app\models\Partner;
use app\models\Product;
	$partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
	$id_product=\Yii::$app->request->get('id', 0);
	$product=Product::find()->andwhere(['id'=>$id_product])->one();
	$category_id=$product->partner_category;
/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Product',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>
	<!--here we going to post our code to get the category id and sent to the specific view-->
	<?php if($category_id==3){?>
	<?=$this->render('_formc', ['model' => $model,]);?>
	<?php }?>
	<?php if($category_id==2){?>
	<?=$this->render('_form_equipement', ['model' => $model,]);?>
	<?php }?>
	<?php if($category_id==1){?>
	<?=$this->render('_form_room_rental', ['model' => $model,]);?>
	<?php }?>
	<?php if($category_id==4||$category_id==5||$category_id==6||$category_id==7||$category_id==8){?>
	<?=$this->render('_form_price_day_night_and_languages', ['model' => $model,]);?>
	<?php }?>
</div>
