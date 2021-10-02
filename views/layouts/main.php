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
    <script src="js/notifications.js"></script>
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
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        echo "<div id='NavBar_id'>";
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-left'],
            'items' => [

                ['label' => 'Administration', 'url' => ['/user/admin'], 'visible' => User::isAdmin()],
          //['label' => 'Profile', 'url' => ['/user/profile', 'id' => \Yii::$app->user->id], 'visible' => User::isUser()],
                ['label' => 'Ajouter nouveau produit', 'linkOptions' => [], 'url' => ['/welcome/index'], 'visible' => User::isPartner()],
            
                [
                    'label' => 'Tous les produits ', 'linkOptions' => [], 'url' => ['/product-item/index'], 'visible' => User::isAdmin()
            
                ],
                [
                    'label' => 'Mes produits ', 'linkOptions' => [], 'url' => ['/product-item/index'], 'visible' => User::isPartner()
            
                ],            
                ['label' => 'Achats', 'url' => ['/reservation/index'], 'visible' =>  User::isUser()],
                ['label' => 'Ordres', 'url' => ['/reservation/index'], 'visible' =>    User::isPartner()],
                ['label' => 'Payment', 'url' => ['/payment/index'], 'visible' => User::isAdmin() or User::isPartner()],
                ['label' => 'Messagerie', 'linkOptions' => [], 'url' => ['/messagerie/index'], 'visible' =>    User::isAdmin()],
                ['label' => 'About Us', 'url' => ['/site/about'], 'visible' => Yii::$app->user->isGuest],
                ['label' => 'Contact', 'url' => ['/site/contact'], 'visible' => Yii::$app->user->isGuest],
                ['label' => 'Terms & Conditions', 'url' => ['/site/terms'], 'visible' => Yii::$app->user->isGuest],
                app\widgets\Notifications::widget(),

            ],
        ]);
        if (User::isAdmin()) {
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left'],
                'items' => [

                    \webzop\notifications\widgets\Notifications::widget(),



                ],
            ]);
        }
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