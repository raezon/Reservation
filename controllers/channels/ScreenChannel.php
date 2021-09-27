<?php

namespace app\controllers\channels;

use webzop\notifications\channels\ScreenChannel as Base;
use webzop\notifications\Notification;
use Yii;


class ScreenChannel extends Base
{
    public function send(Notification $notification)
    {
        $db = Yii::$app->getDb();
        $className = $notification->class;
        $currTime = time();
    
   
        try {
            echo 'sss';
            $db->createCommand()->insert('{{%notifications}}', [
                'class' => strtolower(substr($className, strrpos($className, '\\') + 1, -12)),
                'key' => $notification->key,
                'message' => (string)$notification->getTitle(null),
                'route' => serialize($notification->getRoute()),
                'user_id' => $notification->user,
                'reservation_id' => (int) $notification->reservation_id,
                'created_at' => $currTime,
            ])->execute();
        } catch (\Exception $e) {
           
            var_dump($e->getMessage());
            die();
            

        }
        
    }
}
