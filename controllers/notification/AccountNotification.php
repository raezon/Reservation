<?php

namespace app\controllers\notification;


use Yii;
use app\models\User;
Use app\models\Partner;
use webzop\notifications\Notification;

class AccountNotification extends Notification
{
 const KEY_NEW_ACCOUNT = 'new_account';

 const KEY_NEW_PRODUCT = 'new_reservation';

 const KEY_Answer_PRODUCT = 'answer_reservation';

 const KEY_UPDATE_PRODUCT = 'update_product';

 const KEY_USER_MESSAGE = 'user_message';

 const KEY_RESET_PASSWORD ='reset_password';

/**
 * @var \yii\web\User the user object
 */
 public $user;
 public $reservation_id;
 public $key1;
 public $key2;
 public $key3;
 public $key4;

/**
 * @inheritdoc
 */
//i can pass here as an argument the name of the partnair
 public function getTitle(){
	 
 switch($this->key){
 case self::KEY_NEW_ACCOUNT:
 	return Yii::t('app', 'New account {users} created', ['users' => '#'.$this->key3]);
 case self::KEY_RESET_PASSWORD:
 return Yii::t('app', 'Instructions to reset the password');
 case self::KEY_NEW_PRODUCT:
 return Yii::t('app', 'New product created by {partner} his name is {user} ', ['user'=>$this->key4,'partner' => '#'.$this->key3]);
  case self::KEY_UPDATE_PRODUCT:
 return Yii::t('app', 'Update product by {users} ', ['users' => '#'.$this->key3]);
 case self::KEY_USER_MESSAGE:
 return Yii::t('app', 'message by {users} ', ['users' => '#'.$this->key3]);
 }
 }

/**
 * @inheritdoc
 */
 public function getRoute(){
 	//try to get the Cuurent User and partner
 	$user_id=User::getCurrentUser()->id;
 	if($user_id!=1){
 		$partner_id=Partner::find()->andwhere(['user_id' =>$user_id])->one();
 	$id=(string)$partner_id->id;
 	//$url='/product-historique/index&id='.$partner_id;
 return ['product-historique/notification&id='.$id];
 	}
 	
 }
}
?>