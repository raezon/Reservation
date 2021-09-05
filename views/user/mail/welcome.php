<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */


use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\User;

/**
 * @var dektrium\user\models\User $user
 * @var dektrium\user\models\Token $token
 */
?>

<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
	<?php
if(User::isPartner()){
	?>
	 <?= Yii::t('user', 'Dear Partner ') ?>,
	<?php
}if(!(User::isPartner()&&User::isUser())) {
	?>

	 <?= Yii::t('user', 'Dear Client ') ?>,
	<?php
}

 ?>
   
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    <?= Yii::t('user', 'Welcome to CLICANGOEVENT.com and thank you for starting the registration process.') ?>.
    <?= Yii::t('user',' For your security, access your registration by clicking on the button below ') ?>.
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
   

 
    <?= Html::a('<button type="button" class="btn btn-primary">Confirmate</button>',$token->url) ?>
  

    
    
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    <?= Yii::t('user', 'We are impatient to get back to you with reservations ') ?>.
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    <?= Yii::t('user', 'See you soon ') ?>.
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    <?= Yii::t('user', 'The CLICANGOEVENT.com team ') ?>.
</p