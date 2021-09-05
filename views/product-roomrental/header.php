<?php
use kartik\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use yii\helpers\ArrayHelper;
use app\models\Product;
use app\models\Plat;
use yii\bootstrap\Progress;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use app\models\Other;
use unclead\multipleinput\MultipleInput;
use kartik\money\MaskMoney;
use app\models\User;
use app\models\Partner;
?>
<?php
//add code to get the current partener_id
$id_user=User::getCurrentUser()->id;
//traying to getting partener id
$partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
$partner_id=$partner->id;
$other_types=Other::find()->andwhere(['partener_id'=>$partner_id,'type'=>1])->all();
  $i=0;
          $i=$i+6;
          foreach ($other_types as $other_type) {
            $i++;
            $Produit_type[$i]['name']=$other_type->name;
          }
          $i=$i+1;
          $Produit_type[$i]['name']="Other";
 ?>

<div class="row">
    <div class="col-md-3">
        <h4>General Information</h4>
    </div>
    <div class="col-md-3">
        <h4>Availability and Displacement</h4>
    </div>
    <div class="col-md-2">
        <h4 style="color:green;"><b>Service and Prices</b></h4>
    </div>
    <div class="col-md-1">
        <h4>Conditions</h4>
    </div>
    <div class="col-md-2">
        <h4>Payments</h4>
    </div>
    <div class="col-md-1">
        <h4>Messages</h4>
    </div>
</div>
<?php
echo Progress::widget([
    'percent' => 60,
    'barOptions' => ['class' => 'progress-bar-success'],
    'options' => ['class' => 'active progress-striped']
]);?>
<div class="row">
    <div class="col-md-12">
    <div class="page-header">
        <h4><?= $this->title ?></h4>
    </div>
</br>
    <div>
        <div class="col-md-12" >
        <div class="pull-left col-md-12">
            <button class="btn btn-sm " style="background-color:transparent; " id="1"><h4><span style="color:green; font-size: 20px;">+</span>Services</h4></button>
        </div>
    </div>
         <?php
         // use a partial vue
      Modal::begin([
              'header' => '<h4>Other option</h4>',
              'id'     => 'modal',
              'size'   => 'modal-lg'
          ]);?>

      <div class="form-group">
        <label class="sr-only" for="email">New Option:</label>
        <input type="email" class="form-control"  placeholder="Enter your new value"  name="email" id="other">
       </div>
      <input type="hidden" name="" id="category_id" value="<?php echo Yii::$app->request->get('category_id', 0);?>">
       <input type="hidden" name="" class="input-lg input-group-lg" id="step_id" value="<?php echo Yii::$app->request->get('id', 0);?>">
       <input type="hidden" name="" class="input-lg input-group-lg" id="partner_id" value="<?php echo $partner_id;?>">
     </br>
       <button type="submit" class="btn btn-success" id="save_other_option">Save</button>
      </div>
<!--button de validation-->



      <?php

          Modal::end();

      ?>
               <?php
         // use a partial vue
      Modal::begin([
              'header' => '<h4>Other type</h4>',
              'id'     => 'modal2',
              'size'   => 'modal-lg'
          ]);?>

      <div class="form-group">
        <label class="sr-only" for="email">New Type:</label>
        <input type="email" class="form-control"  placeholder="Enter your new value"  name="email" id="other_type">
       </div>
      <input type="hidden" name="" id="category_id" value="<?php echo Yii::$app->request->get('category_id', 0);?>">
       <input type="hidden" name="" class="input-lg input-group-lg" id="step_id" value="<?php echo Yii::$app->request->get('id', 0);?>">
       <input type="hidden" name="" class="input-lg input-group-lg" id="partner_id" value="<?php echo $partner_id;?>">
     </br>
       <button type="submit" class="btn btn-success" id="save_other_type">Save</button>
      </div>
<!--button de validation-->

      <?php

          Modal::end();

      ?>