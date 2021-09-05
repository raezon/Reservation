<?php

use  app\views\welcome\widgets\NavStep;
use  app\views\welcome\widgets\Step2;

//print_r($ip);
/* @var $this yii\web\View */
?>

<?php $NavStep = new NavStep('step2'); ?>
<?php $NavStep->displayNav(); ?>
<?php $NavStep->displayProgress(30); ?>

<?php new Step2(); ?>
<?php Step2::container($model2, 4) ?>
