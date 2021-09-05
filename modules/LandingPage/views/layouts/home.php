<?php

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $form yii\bootstrap4\ActiveForm */

use app\widgets\bs4\Alert;
//use yii\bootstrap4\Alert;
//use kartik\alert\Alert;
use yii\helpers\Html;
//use yii\bootstrap4\Nav;
use app\widgets\Nav;
use yii\bootstrap4\NavBar;
//use yii\bootstrap4\Breadcrumbs;
use app\assets\HomeAsset;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
//use yii\widgets\ActiveForm;
use app\models\LoginForm;
use app\models\user\RegistrationForm;
use app\models\User;

$bundle = HomeAsset::register($this);
$model = new LoginForm();
$modelRegister = new RegistrationForm();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
  <head>
    <meta charset="<?= Yii::$app->charset ?>">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->registerCsrfMetaTags() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="SARL CorpoSense">
      <?= $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/icone', 'href' => 'favicon.ico']); ?>
      <!--<link rel="stylesheet" href="../css/app.css ">-->
      <?php $this->head() ?>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
      <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,600,700,800&display=swap" rel="stylesheet">
      <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

      <!-- Plugins -->
    </head>
<body>
<?php $this->beginBody() ?>

<?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/logo.png', ['alt'=>'image', 'height'=>'60']),
        'brandUrl' => Yii::$app->homeUrl,
        'containerOptions' => [
            'id' => 'navbarNav3'
        ],
        'togglerOptions' => [
            'class' => 'bg-white', // inner button class
        ],
        'options' => [
            'id' => 'navbar-main',
            'class' => 'navbar navbar-light bg-transparent navbar-expand-md fixed-top',
//            'class' => 'navbar navbar-expand-md navbar-dark fixed-top bg-dark',
        ],
    ]);

echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
         'items' => [
          
           ['label' => 'Administration', 'url' => ['/user/admin'], 'visible' => User::isAdmin()],
            ['label' => 'Profile', 'url' => ['/user/profile', 'id' => \Yii::$app->user->id], 'visible' => User::isUser()],
            ['label' => 'Profiles', 'url' => ['/profile/index'], 'visible' => User::isAdmin()],
            ['label' => 'Partner', 'url' => ['/partner/index'], 'visible' => User::isAdmin()],
            [
               'label' => 'All Products ', 'url' => ['/product-item/index'],'visible' =>  User::isAdmin()   
            ],
            [
               'label' => 'My Products ', 'url' => ['/product-item/index'],'visible' =>User::isPartner()
                  
            ],['label' => 'Avaibility', 'url' => ['/product/available'],'visible' => User::isPartner()],
            ['label' => 'Add new product', 'url' => ['/welcome/index'],'visible' => User::isPartner()],
          //  ['label' => 'All Reservations', 'url' => ['/reservation/index'], 'visible' =>User::isAdmin()||User::isPartner()],
          //  ['label' => 'My Reservations', 'url' => ['/reservation/index'], 'visible' => !( Yii::$app->user->isGuest)&&!( User::isPartner())&&!(User::isAdmin())],
            ['label' => 'Payment', 'url' => ['/payment/index'], 'visible' => User::isAdmin()],
            ['label' => 'Subscription', 'url' => ['/subscription/index'], 'visible' => User::isAdmin()],
            ['label' => 'About Us', 'url' => ['/site/about'], 'visible' => Yii::$app->user->isGuest],
            ['label' => 'Contact', 'url' => ['/site/contact'], 'visible' => Yii::$app->user->isGuest],
            ['label' => 'Terms & Conditions', 'url' => ['/site/terms'], 'visible' => Yii::$app->user->isGuest],
            
           



            /*[ // TODO: need to secure access!
                'label' => 'Configuration',
                'items' => [
                     ['label' => 'Permission', 'url' => ['/admin/permission']],
                     ['label' => 'Route', 'url' => ['/admin/route']],
//                     ['label' => 'Menu', 'url' => ['/admin/menu']],
                     ['label' => 'Role', 'url' => ['/admin/role']],
                     ['label' => 'Assignment', 'url' => ['/admin/assignment']],
                     ['label' => 'User', 'url' => ['/admin/user']],
                ],
            ],*/
            
            
        ],
    ]);

echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'encodeLabels' => false,
        'navLinkClass' => '', // remove nav-link for <a>
        'items' => [
            [ 'label' => '<i class="fas fa-handshake prefix"></i> Become a Partner',
                'url' => ['/site/become-partner'] ,
                'linkOptions' => [
                    'class' => 'btn btn-info shadow ml-md-3 ml-md-auto mr-1',
                ],
                'visible' => User::isGuest()
            ],
            User::isGuest() ? (
                [
                    'label' => '<i class="fas fa-lock prefix"></i> LOGIN',
                    'url' => ['/user/security/login'/* '/site/login'*/],
                    'linkOptions' => [
                        'class' => 'btn btn-primary shadow ml-md-3 ml-md-auto',
                        'data-toggle' => 'modal',
                        'data-target' => '#loginModal'
                    ]
                ]
            ) : (
                '<li class=" ml-auto">'
                . Html::beginForm(['/user/security/logout'], 'post')
                . Html::submitButton(
                    'LOGOUT <i class="fas fa-sign-out-alt prefix"></i>',
                    ['class' => 'btn btn-primary shadow ml-md-3 ml-md-auto']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
?>
  <div class="container">
<?php
// TODO: need to be fixed (maybe put it inside .container)
$flashMessages = Yii::$app->session->getAllFlashes();
if ($flashMessages): ?>
<div class="row pt-5">
    <div class="col-sm-12 mt-5">
        <?= Alert::widget() ?>
    </div>
</div>
<?php endif; ?>

    <?= $content ?>
  </div><!-- .container -->

<!--Modal: Login / Register Form-->
<div class="modal fade" id="loginModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog cascading-modal" role="document">
    <!--Content-->
    <div class="modal-content">

      <!--Modal cascading tabs-->
      <div class="modal-tabs">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#panel-login" role="tab" aria-controls="panel-login" aria-selected="true"><i class="fas fa-user mr-1"></i>
              Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#panel-register" role="tab" aria-controls="panel-register" aria-selected="false"><i class="fas fa-user-plus mr-1"></i>
              Register</a>
          </li>
        </ul>
      </div>

        <!-- Tab panels -->
        <div class="tab-content" id="tab-content-login-modal">
          <!--Panel 7-->
          <div class="tab-pane fade show active" id="panel-login" role="tabpanel">

            <!--Body-->
            <div class="modal-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'action' => Url::to(['/site/login']),
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => false,
                    'fieldConfig' => [
                        'template' => "<div class=\"form-group mb-2\">{label}\n{input}\n{error}</div>",
                        'labelOptions' => ['class' => 'col-form-label'],
                    ],
                ]); ?>
                    <?= $form->field($model, 'username')->textInput(['class' => 'form-control form-control-sm validate', 'autofocus' => true]) ?>
                    <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control form-control-sm validate']) ?>
                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'template' => "<div class=\"form-check mt-2\">{input} {label}</div>\n<div class=\"col-md-8\">{error}</div>",
                    ]) ?>
                    <div class="form-group text-center mt-2">
                        <?= Html::submitButton('Login <i class="fas fa-sign-in-alt ml-1"></i>', ['class' => 'btn btn-info', 'name' => 'login-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
            <!--Footer-->
            <div class="modal-footer">
              <div class="text-center">
                <p>Forgot <a href="<?= Url::to(['user/recovery/request']) ?>" class="text-decoration-none">Password?</a></p>
              </div>
              <button type="button" class="btn btn-outline-info ml-auto" data-dismiss="modal">Close</button>
            </div>

          </div>
          <!--/.Panel Login-->

          <!--Panel Register-->
          <div class="tab-pane fade" id="panel-register" role="tabpanel">

            <!--Body-->
            <div class="modal-body">
                <?php $regForm = ActiveForm::begin([
                    'id' => 'registration-form',
                    'action' => Url::to(['/user/registration/register']),
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => true,
                    'fieldConfig' => [
                        'template' => "<div class=\"form-group mb-2\">{label}\n{input}\n{error}</div>",
                        'labelOptions' => ['class' => 'col-form-label'],
                    ],
                ]); ?>

                <?= $regForm->field($modelRegister, 'email')->input('email', ['class' => 'form-control form-control-sm validate']) ?>

                <?= $regForm->field($modelRegister, 'username')->textInput(['class' => 'form-control form-control-sm validate']) ?>

                <?= $regForm->field($modelRegister, 'password')->passwordInput(['class' => 'form-control form-control-sm validate']) ?>

                <?= $regForm->field($modelRegister, 'repeat_password')->passwordInput(['class' => 'form-control form-control-sm validate']) ?>

                <?= $regForm->field($modelRegister, 'agree')->checkbox([
                    'template' => "<div class=\"form-check mt-2\">{input} {label}\n{error}</div>",
                    'checked' => false,
                    'label' => '<label class="custom-control-label" for="register-form-agree">Accept our <a target="_blank" href="'.Url::to(['/site/terms']).'">terms and conditions</a> ?</label>',
                    'required' => true
                    ]); ?>

                <div class="form-group text-center mt-2">
                <?= Html::submitButton(Yii::t('user', 'Sign up').' <li class="fas fa-sign-in-alt ml-1"></li>', ['class' => 'btn btn-info']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>

            <!--Footer-->
            <div class="modal-footer">
              <div class="ml-1">
                <p>Have a problem? <a href="<?= Url::to(['site/contact']) ?>" class="blue-text">Contact Us</a></p>
              </div>
              <button type="button" class="btn btn-outline-info ml-auto" data-dismiss="modal">Close</button>
            </div>

          </div><!-- .tab-pane#panel-register -->

          <!--/.Panel Register-->
        </div>

    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: Login / Register Form-->

      <!-- jQuery is required -->
      <?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
