<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\bs3\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\StepAsset;
use app\models\User;

use app\models\base\QuestionsList;
use app\models\base\Questions;
use app\models\Partner;


//$this->params['breadcrumbs'] = [];

StepAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--  jquery script  -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" crossorigin="anonymous"></script>

    <title><?= Html::encode($this->title) ?></title>
    <style>
        #gmap-map-canvas {
            margin: 30px 0px 10px 5px;
            height: auto;
            width: auto;
            border: solid #6f42c1 2px;
        }

        .category-card {
            height: 400px;
        }

        .img-thumbnail {
            margin-top: 15px;
            margin-bottom: 5px;

        }

        .grid-container {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            margin-top: 5%;
            margin-left: 6%;
            margin-right: 5%;

        }

        .grid-item {
            width: 14.28%;
        }

        #marginVegan {
            margin-left: -10px;
        }

        #marginVegetarian {
            margin-left: -10px;
        }

        #marginOrganic {
            margin-left: -10px;
        }

        #marginGlutenFree {
            margin-left: -13px;
        }

        #marginHalal {
            margin-left: -10px;
        }

        #marginCacher {
            margin-left: -13px;
        }

        #marginWithoutPorc {
            margin-left: -25px;
        }
        .help-block-error{
            color:red
        }
    </style>
    <?php $this->head() ?>


</head>

<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => //'<img src="logo.png" style="display:inline; vertical-align: top; height:32px;">'.
            'Welcome Modérateur!',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);

        $items = [];
        $category_id = Yii::$app->request->get('category_id');
        $page_id = Yii::$app->request->get('id');
        $category = \app\models\PartnerCategory::find()->where(['id' => $category_id])->one();
    
        // add login/logout button
        array_push($items, Yii::$app->user->isGuest ? (['label' => 'Login', 'url' => ['/user/security/login' /* or '/site/login'*/]]) : ('<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>'));

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-left'],
            'items' => $items
        ]);
        NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>

            <?= Alert::widget() ?>

            <?php if (isset($errors)) : ?>
                <!-- alert errors -->
                <div class="alter alert-danger">
                    <?php
                    //                    foreach ($errors as $error) {
                    var_dump($errors);
                    //                        echo "<p>$error</p>";
                    //                    }
                    ?>
                </div>
            <?php endif; ?>

            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left"><?= Yii::$app->name ?> &copy; <?= date('Y') ?></p>

            <p class="pull-right"><?= Yii::$app->params['POWERED_BY'] ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>

    <?php
    $js = <<<JS
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })        
JS;
    $this->registerJs($js);

    ?>
</body>

</html>
<?php $this->endPage() ?>