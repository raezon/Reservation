 <?php
//CATERERS
use kartik\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Progress


//$this->title = 'General Information';
/* @var $this yii\web\View */
?>
<div class="row">
    <div class="col-md-2">
        <h4>General Information</h4>
    </div>
    <div class="col-md-3">
        <h4>Availability and Displacement</h4>
    </div>
    <div class="col-md-2">
        <h4>Service and Prices</h4>
    </div>
    <div class="col-md-1 ">
        <h4>Conditions</h4>
    </div>
    <div class="col-md-2">
        <h4>Payments</h4>
    </div>
    <div class="col-md-2">
        <h4 style="color:green"><b>Messages</b></h4>
    </div>
</div>
<?php
echo Progress::widget([
    'percent' => 100,
    'barOptions' => ['class' => 'progress-bar-success'],
    'options' => ['class' => 'active progress-striped']
]);?>

<div class="row">

    <div class="col-md-12">

    <div class="page-header">
        <h4><?= $this->title ?></h4>

    </div>
    <?php $form = ActiveForm::begin([
        'id' => 'partner-registration-form',
//      'enableAjaxValidation' => true,
        'enableClientValidation' => true,
    ]); ?>

        <?= Html::hiddenInput('category_id', \Yii::$app->request->get('category_id', 0)) ?>

        <!-- jumbotron -->
      <div class="container">
          <div class="alert alert-success" style="border:solid 1px #aaa">
            <strong>Success!</strong> Indicates a successful or positive action.
          </div>
          <br>
          <div style="background:rgb(136, 235, 186) " class="jumbotron" >
           <h1>Partner</h1>
           <p>Congratulations! You've successfully registered...</p>

          </div>
      </div>
      <!-- jumbotron /////////////// End-->
       <div class="form-group">
        <div class="pull-right">
              <?=Html::a('Go to your space',Url::to(['product-item/index']),['class'=>'btn btn-lg btn-success','data-method'=>'POST'])?>
        </div>
    </div>
    <div class="form-group">
        <div class="pull-left">
            <?=Html::a('back',Url::to(['welcome/step','id'=>5,'category_id'=>Yii::$app->request->get('category_id', 0)]),['class'=>'btn btn-lg btn-primary','data-method'=>'POST'])?>
        </div>
    </div>

    <?php ActiveForm::end() ?>

    </div><!-- .col-md-12 -->

</div><!-- .row -->
