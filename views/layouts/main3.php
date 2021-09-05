<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\bs3\Alert;
//use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\User;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://static.jcoc611.com/hosted/js/InputAffix.1.1.1.min.js"></script>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>


    <div class="wrap">
        <?php
        NavBar::begin([

            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        echo "<div id='NavBar_id'>";
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-left'],
            'items' => [


                Yii::$app->user->isGuest ? (
                    //                ['label' => 'Login', 'url' => ['/site/login']]
                    ['label' => 'Login', 'url' => ['/user/security/login']]) : ('<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>')
            ],
        ]);

        echo "</div>";


        NavBar::end();


        ?>



        <div class="container">


            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
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
</body>

</html>
<?php $this->endPage() ?>