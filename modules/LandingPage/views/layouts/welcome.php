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
    <?= Html::csrfMetaTags() ?>
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
    </style>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => //'<img src="logo.png" style="display:inline; vertical-align: top; height:32px;">'.
        'Welcome Partner!',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    
    $items = [];
    $category_id = Yii::$app->request->get('category_id');
    $page_id = Yii::$app->request->get('id');
    $category = \app\models\PartnerCategory::find()->where(['id' => $category_id])->one();
    if ($category){
        $questionsList = QuestionsList::find()->where(['partner_category_id'=>$category->id])->one();
       /* if ($questionsList){
            $questions = Questions::find()->where(['questions_list_id' => $questionsList->partner_category_id])->all();

            // add all menu items for selected category
            $i = 0;
            foreach ($questions as $question) {
                $i++;
                array_push($items, ['label' => $question->name, 'url' => $question->url, 'active' => ($i==$page_id)]);
            }                
        } else {
            die('<h1>This Category is not ready yet.</h1>');
        }*/
    } 
    // add login/logout button
    array_push($items, Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/user/security/login' /* or '/site/login'*/]]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            ));
    
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
        
        <?php if (isset($errors)): ?>
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

        <p class="pull-right"><?= Yii::$app->params['POWERED_BY']?></p>
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
