 <?php
//CATERERS
use kartik\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Progress;
use app\models\Product;
use app\models\ProductItem;
use  app\views\welcome\widgets\NavStep;
?>

<?php $NavStep = new NavStep('step6'); ?>
<?php $NavStep->displayNav(); ?>
<?php $NavStep->displayProgress(100); ?>

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
          <h1>Moderateur</h1>
           <p>Toutes nos félicitations! Vous vous êtes inscrit avec succès......</p>

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
