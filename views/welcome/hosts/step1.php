<?php

/**
 * Author:Djebabla ammar Step1 Adding a New Service By a Partner
 * 
 */

use  app\views\welcome\widgets\NavStep;
use  app\views\welcome\widgets\Step1;

?>
<style>
    .required:before {
        font-size: 15px;
        content: " *";
        color: red;
    }
</style>

<?php $NavStep = new NavStep('step1'); ?>
<?php $NavStep->displayNav(); ?>
<?php $NavStep->displayProgress(10); ?>
<?php Step1::container($model, 7) ?>