<?php
use  app\views\welcome\widgets\NavStep;
use  app\views\welcome\widgets\Step2;

//print_r($ip);
/* @var $this yii\web\View */
?>

<?php $NavStep = new NavStep('step3'); ?>
<?php $NavStep->displayNav(); ?>
<?php $NavStep->displayProgress(60); ?>