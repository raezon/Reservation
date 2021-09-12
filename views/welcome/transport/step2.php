<?php

use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use yii\helpers\Url;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use yii\helpers\Html;
use yii\bootstrap\Progress;
use app\models\base\TblEvents;
use yii\bootstrap\Modal;
use unclead\multipleinput\MultipleInput;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\Partner;
use kartik\money\MaskMoney;
use  app\views\welcome\widgets\NavStep;
use  app\views\welcome\widgets\Step2;

//print_r($ip);
/* @var $this yii\web\View */
?>

<?php $NavStep = new NavStep('step2'); ?>
<?php $NavStep->displayNav(); ?>
<?php $NavStep->displayProgress(30); ?>

<?php new Step2(); ?>
<?php Step2::container($model2, 2) ?>

<!--                          <p>Lat: <span id="geo-lat"></span></p>
                          <p>Lng: <span id="geo-lng"></span></p>-->
</div>
