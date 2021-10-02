<?php

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $form yii\bootstrap4\ActiveForm */

use app\widgets\bs4\Alert;
//use yii\bootstrap4\Alert;
//use kartik\alert\Alert;
use yii\helpers\Html;
use kartik\select2\Select2;
//use yii\bootstrap4\Nav;
use app\widgets\Nav;
use yii\bootstrap4\NavBar;
//use yii\bootstrap4\Breadcrumbs;
use app\assets\DetailAsset;
use yii\helpers\Url;
use kartik\form\ActiveForm;
use kartik\daterange\DateRangePicker;
//use yii\widgets\ActiveForm;
use app\models\LoginForm;
use app\models\user\RegistrationForm;
use app\models\User;


$bundle = DetailAsset::register($this);
$model = new LoginForm();
$modelRegister = new RegistrationForm();
$categoriesNames = [];
$items = [];
$categories = \app\models\PartnerCategory::find()->all();
foreach ($categories as $category) {
    array_push($categoriesNames, $category->name);
    $model1 =  new \app\models\forms\SearchForm();
}
//sessions 

/*/$model1->category = $_SESSION['category'];
$model1->date_depart = $_SESSION['date_depart'];
$model1->date_arriver = $_SESSION['date_arriver'];
$model1->nbr_persson = $_SESSION['nbr_persson'];
$model1->place = $_SESSION['place'];*/
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language  ?>">

<head>
    <script>
    alert = function() {};
  </script>
  
    <script src="/mainrepo_old/web/js/angular/angular.min.js"></script>
    <script language="javascript" src="/mainrepo_old/web/js/angular/app.js"></script>


    <meta charset="<?= Yii::$app->charset ?>">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->registerCsrfMetaTags() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="SARL CorpoSense">
    <?= $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/icone', 'href' => 'favicon.ico']); ?>
    <!--<link rel="stylesheet" href="../css/app.css "> old angular 1.6.9-->
    <?php $this->head() ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://static.jcoc611.com/hosted/js/InputAffix.1.1.1.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,600,700,800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />



    <style>
        .bg-purple {
            /* background-color: #4a4677*/
            background-image: -webkit-linear-gradient(left,#21a2fd,#7967fe 52%,#2b9bfd);
          
            /*  background-image: linear-gradient(to left, #484078, #4e3d79, #553a79, #5c3779, #633378, #613479, #603479, #5e357a, #523a7c, #473e7c, #3c417a, #324478);
            background-image: linear-gradient(to right, #484078, #4e3d79, #553a79, #5c3779, #633378, #613479, #603479, #5e357a, #523a7c, #473e7c, #3c417a, #324478);*/
        }

        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            /* Safari */
            animation: spin 2s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .has-star {
            display: none;
        }

        .carousel-control-next-icon {

            width: 20px;
            height: 20px;
            margin-left: 100px;
            margin-top: 150px;
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='rgb(74, 70, 119)' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E");
        }

        .carousel-control-prev-icon {

            width: 20px;
            height: 20px;
            margin-top: 150px;
            margin-left: -100px;
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='rgb(74, 70, 119)' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E");
        }



        .carousel-indicators li {

            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: rgb(200, 138, 42) !important;
        }

        .carousel-indicators .active {

            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: rgb(74, 70, 119) !important;

        }

        .carousel-inner>img {
            /* width: 500px;
            height: 360px;*/
        }

        .carousel-inner img {
            /*  width: 50%;
            margin: auto;*/
        }

        .carousel {
            height: 360px;

        }

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            padding-top: 0px;
            margin-top: 5px;
            /*  width: 50%;*/
        }


        tr {
            overflow: hidden;
            height: 14px;
            white-space: nowrap;
        }

        .line_break {

            border: none;
            border-bottom: 3px solid black;
        }

        .panel-footer span {
            width: calc(100%/3);
            float: left;
            text-align: center;
        }

        .panel-footer span:first-child {
            text-align: left;
        }

        .panel-footer span:last-child {
            text-align: right;
        }

        .vl:before {
            position: absolute;
            content: '';
            left: 0px;
            height: 28px;
            width: 2px;
            background: #000000;
            top: 3px;
        }

        .table1 {
            border-collapse: collapse;
            border-left-style: hidden;
            border-right-style: hidden;
        }

        .td1 {
            border: 1px solid #ccc;
        }

        thead th {
            border-collapse: collapse;
            border-bottom-style: hidden;
        }

        .nav-item {
            height: 65px;
        }

        .navbar-brand {
            padding-top: 0px;
            padding-bottom: 0px;
        }

        .Billing {
            height: 600px;
            width: 500px;
        }

        /**Css for the Filter  */
        #FilterBy {
            font-weight: bold;

            margin-top: 20px;
        }

        /**Filter Title Design with a simple linear gradiant */
        h2 {

            background-color: #f3ec78;
            background-image: linear-gradient(#484078, #4e3d79, #553a79, #5c3779, #633378, #613479, #603479, #5e357a, #523a7c, #473e7c, #3c417a, #324478);
            ;
            background-size: 100%;
            -webkit-background-clip: text;
            -moz-background-clip: text;
            -webkit-text-fill-color: transparent;
            -moz-text-fill-color: transparent;
        }

        /**Css For a traingle */

        .triangle-right {
            width: 0;
            height: 0;
            border-top: 5px solid transparent;
            border-left: 8px solid #555;
            border-bottom: 5px solid transparent;
            display: inline-block;
            margin-left: 5px;
            padding-right: 5px;

        }

        .triangle-right {
            width: 0;
            height: 0;
            border-top: 5px solid transparent;
            border-left: 8px solid #613479;
            border-bottom: 5px solid transparent;
            display: inline-block;
            margin-left: 5px;
            padding-right: 5px;

        }
    </style>
    <!-- Plugins -->

</head>

<body ng-app="myApp" ng-init="qty=1" ng-controller="myCntrl">
    <?php $this->beginBody() ?>

    <?php
    NavBar::begin([
        'brandLabel' => '',
        'brandUrl' => Yii::$app->homeUrl,
        'containerOptions' => [
            'id' => 'navbarNav3',

        ],
        'togglerOptions' => [
            'class' => 'bg-white col-sm-5 ', // inner button class
        ],
        'options' => [
            'id' => 'navbar-main',
            'class' => 'navbar navbar-light bg-transparent navbar-expand-md',
            'class' => 'navbar navbar-expand-md navbar-dark  bg-purple',
            'style' => 'padding-top:0px;padding-bottom:0px;margin-top:0px;',
        ],
    ]);
    $location = 'location';
    $equipement = 'equipement';
    $caters = 'caters';
    $photo = 'photo';
    $animation = 'animation';
    $security = 'security';
    $host = 'host';
    $other = 'other';
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav  mt-2'],
        'encodeLabels' => false,
        'navLinkClass' => '', // remove nav-link for <a>
        'items' => [
            ['label' => '<div style="opacity:0;">_</div>'],
            ['label' => '<div style="opacity:0;">_</div>'],
            ['label' => '<div style="opacity:0;">_</div>'],
            ['label' => '<div style="opacity:0;">_</div>'],
            ['label' => '<div style="opacity:0;">_</div>'],
            ['label' => '<div style="opacity:0;">_</div>'],
            ['label' => '<div style="opacity:0;">_</div>'],
            ['label' => '<div style="opacity:0;">_</div>'],
            ['label' => '<div style="opacity:0;">_</div>'],
            ['label' => '<div style="opacity:0;">_</div>'],
            ['label' => '<div style="opacity:0;">_</div>'],
            ['label' => '<div style="opacity:0;">_</div>'],
            ['label' => "<div  onmouseover='hover(\"$location\");' onmouseout='unhover(\"$location\");'   style='color:#fff' > " . Html::img('@web/img/logos/location.png', ['alt' => '', 'height' => '28', 'class' => 'center', 'id' => 'location']) . '<label style="font-size:13px;" id="locationText" >Hotel</label></div>', 'url' => ['/site/redirect', 'filter' => 1]],
            ['label' => '<div style="opacity:0;">_</div>'],
            ['label' => '<div style="opacity:0;">_</div>'],
            ['label' => '<div style="opacity:0;">_</div>'],
            ['label' => "<div  onmouseover='hover(\"$equipement\");' onmouseout='unhover(\"$equipement\");'   style='color:#fff' > " . Html::img('@web/img/logos/equipement.png', ['alt' => '', 'height' => '28', 'class' => 'center', 'id' => 'equipement']) . '<label style="font-size:13px;" id="equipementText">Equiment</label></div>', 'url' => ['/site/redirect', 'filter' => 2]],
            ['label' => '<div style="opacity:0;">_</div>'],
            ['label' => '<div style="opacity:0;">_</div>'],
            ['label' => '<div style="opacity:0;">_</div>'],
            ['label' => "<div  onmouseover='hover(\"$caters\");' onmouseout='unhover(\"$caters\");'   style='color:#fff' > " . Html::img('@web/img/logos/caters.png', ['alt' => '', 'height' => '28', 'class' => 'center', 'id' => 'caters']) . '<label style="font-size:13px;" id="catersText">Restaurant</label></div>', 'url' => ['/site/redirect', 'filter' => 3]],
            ['label' => '<div style="opacity:0;">_</div>'],
            ['label' => '<div style="opacity:0;">_</div>'],
            ['label' => '<div style="opacity:0;">_</div>'],
            ['label' => "<div  onmouseover='hover(\"$other\");' onmouseout='unhover(\"$other\");'   style='color:#fff' > " . Html::img('@web/img/logos/transport.png', ['alt' => '', 'height' => '28', 'class' => 'center', 'id' => 'other']) . '<label style="font-size:13px;" id="otherText">Transport</label></div>', 'url' => ['/site/redirect', 'filter' => 8]],
        ],
    ]);


    echo Nav::widget([

        'options' => ['class' => 'navbar-nav ml-auto  mt-2'],
        'encodeLabels' => false,
        'navLinkClass' => '', // remove nav-link for <a>
        'items' => [
            [
                'label' => '<i class="fas fa-handshake prefix"></i> Devenir Modérateur',
                'url' => ['/site/become-partner'],
                'linkOptions' => [
                    'class' => 'btn btn-info shadow ml-md-3 ml-md-auto mr-1',
                ],
                'visible' => User::isGuest()
            ],
            User::isGuest() ? ([
                'label' => '<i class="fas fa-lock prefix"></i> LOGIN',
                'url' => ['/user/security/login'/* '/site/login'*/],
                'linkOptions' => [
                    'class' => 'btn  btn-info shadow ml-md-3 ml-md-auto',
                    'data-toggle' => 'modal',
                    'data-target' => '#loginModal'
                ]
            ]) : ('<li class=" ml-auto">'
                . Html::beginForm(['/user/security/logout'], 'post')
                . Html::submitButton(
                    'LOGOUT <i class="fas fa-sign-out-alt prefix"></i>',
                    ['class' => 'btn btn-primary shadow ml-md-3 ml-md-auto']
                )
                . Html::endForm()
                . '</li>')
        ],
    ]);


    NavBar::end();
    ?>


    <div class="container">
        <?php
        // TODO: need to be fixed (maybe put it inside .container)
        $flashMessages = Yii::$app->session->getAllFlashes();
        if ($flashMessages) : ?>
            <div class="row pt-5">
                <div class="col-sm-12 mt-5">
                    <?= Alert::widget() ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col mt-12 pt-12">

                <!--search for client i will create an activeForm with a model -->

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12 text-center">

                        </div>
                    </div>
                </div>
                </br>
                </br>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card" style=" background-color: rgb(244, 244, 244)">
                            <div class="card-body">
                                <?php $form = ActiveForm::begin([
                                    'id' => 'partner-registration-form',
                                    //'enableAjaxValidation' => true,
                                    'enableClientValidation' => true,
                                    'method' => 'post',
                                    'action' => ['site/send']
                                ]); ?>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <h3 style="color:  -webkit-linear-gradient(left,#21a2fd,#7967fe 52%,#2b9bfd);"><b>Rechercher</b></h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="dropdown">
                                                <!-- input name="category" class="form-control" placeholder="Category" data-toggle="dropdown" class="dropdown-toggle" -->

                                                <?php echo $form->field($model1, 'category')->widget(Select2::classname(), ([
                                                    'name' => 'partner_category',
                                                    'data' => $categoriesNames,
                                                    'options' => ['placeholder' => 'Select a Category...'],
                                                    'pluginOptions' => [
                                                        'allowClear' => true,
                                                        //'multiple' => true,
                                                    ],
                                                ])); ?>

                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <!-- input name="date_reservation" class="form-control" placeholder="CHOOSE A DATE?" -->

                                            <?php echo $form->field($model1, 'date_depart', [
                                                'addon' => ['prepend' => ['content' => '<i class="fas fa-calendar-alt"></i>']],
                                                'options' => ['class' => 'drp-container form-group']
                                            ])->widget(DateRangePicker::classname(), ([
                                                'name' => 'date_range_3',
                                                'value' => '2015-10-19 12:00 AM - 2015-11-03 01:00 PM',
                                                'convertFormat' => true,
                                                'pluginOptions' => [
                                                    'timePicker' => true,
                                                    'timePickerIncrement' => 15,
                                                    'locale' => ['format' => 'Y-m-d h:i ']
                                                ],
                                                'options' => ['placeholder' => 'Select range...']
                                            ]));
                                            ?>


                                        </div>

                                        <div class="col-sm-12">
                                            <?php
                                            echo $form->field($model1, 'place')->textInput([
                                                'id' => 'autocomplete',
                                                'class' => 'form-control ',
                                                'placeholder' => 'NEAR TO?',



                                            ]); ?>
                                        </div>
                                        <div class="col-sm-12">
                                            <!--<input type="submit" class="btn btn-primary shadow ml-sm-auto" value="SEARCH...">-->
                                            <?= Html::submitButton('SEARCH...', ['class' => 'btn bg-purple shadow ml-sm-auto col-sm-12', 'style' => 'color:#fff;']) ?>
                                        </div>
                                    </div>



                                </div><!-- .form-group -->

                                <?php ActiveForm::end() ?>

                            </div>

                            <!--i will put my conditions to add the right filter -->



                        </div>

                    </div><!-- .container -->
                    <div class="col-sm-9">
                        <?= $content ?>
                    </div>

                </div>
            </div>
        </div>
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
                                    <?= $form->field($model, 'username')->textInput(['class' => 'form-control form-control-sm validate', 'autofocus' => true])->label('Nom utilisateur') ?>
                                    <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control form-control-sm validate'])->label('Mot de passe') ?>
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
                                    'label' => '<label class="custom-control-label" for="register-form-agree">Accept our <a target="_blank" href="' . Url::to(['/site/terms']) . '">terms and conditions</a> ?</label>',
                                    'required' => true
                                ]); ?>

                                <div class="form-group text-center mt-2">
                                    <?= Html::submitButton(Yii::t('user', 'Sign up') . ' <li class="fas fa-sign-in-alt ml-1"></li>', ['class' => 'btn btn-info']) ?>
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
<script>
    // This sample uses the Autocomplete widget to help the user select a
    // place, then it retrieves the address components associated with that
    // place, and then it populates the form fields with those details.
    // This sample requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script
    // src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
    var placeSearch, autocomplete;

    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.

        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('autocomplete'), {
                types: ['geocode']
            });

        // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.
        autocomplete.setFields(['address_component']);

        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);



        // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.
        //autocomplete.setFields(['address_component']);

        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        //autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
            }
        }
    }

    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7Iz5ZKGr0_5l_LD47xNf9umU7GSiUVuw&libraries=places&callback=initAutocomplete" async defer></script>