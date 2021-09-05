<?php

namespace webzop\notifications\channels;

use Yii;
use webzop\notifications\Channel;
use webzop\notifications\Notification;

class ScreenChannel extends Channel
{
    public function send(Notification $notification)
    {
        $db = Yii::$app->getDb();
        $className = $notification->className();
        $currTime = time();
        $db->createCommand()->insert('{{%notifications}}', [
            'class' => strtolower(substr($className, strrpos($className, '\\')+1, -12)),
            'key' => $notification->key,
            'key2'=> $notification->key2,
            'message' => (string)$notification->getTitle(),
            'route' => serialize($notification->getRoute()),
            'user_id' => $notification->userId,
            'created_at' => $currTime,
        ])->execute();
//create my table and save the data of update and save and i need to get the data from the key 2
//transforming the notification->key2 that is the conntent of the message that is the property of the product
        $array_msg=json_decode($notification->key2,true);
        if($array_msg[0]["number_people"]==0)
          $array_msg[0]["number_people"]=1;
        if($array_msg[0]["duration"]==0)
            $array_msg[0]["duration"]=1;
        if($array_msg[0]["status"]==s)
                $array_msg[0]["status"]=1;




            /*    $array_msg[0]["partner_category"]=(int)$array_msg[0]["partner_category"];
                $array_msg[0]["name"]=(string)$array_msg[0]["name"];
                $array_msg[0]["description"]=(string)$array_msg[0]["description"];
                $array_msg[0]["picture"]=(string)$array_msg[0]["picture"];
                $array_msg[0]["price"]=(string)$array_msg[0]["price"];
                $array_msg[0]["number_people"]=(string)$array_msg[0]["number_people"];
                $array_msg[0]["quantity"]=(string)$array_msg[0]["quantity"];
                $array_msg[0]["duration"]=(string)$array_msg[0]["duration"];
                $array_msg[0]["type"]=(string)$array_msg[0]["type"];
                $array_msg[0]["option"]=(string) $array_msg[0]["option"];
                $array_msg[0]["condition"]=(string)$array_msg[0]["condition"];
                $array_msg[0]["availability"]=(string)$array_msg[0]["availability"];
                $array_msg[0]["partner_id"]=(int)$array_msg[0]["partner_id"];
                $array_msg[0]["extra"]=(string)$array_msg[0]["extra"];
                $array_msg[0]["status"]=(int)$array_msg[0]["status"];
                $array_msg[0]["created_at"]=(int)$array_msg[0]["created_at"];
                $array_msg[0]["updated_at"]=(int)$array_msg[0]["updated_at"];*/
                ///
                echo gettype( $array_msg[0]["partner_category"]);
                echo gettype( $array_msg[0]["name"]);
                echo gettype( $array_msg[0]["description"]);
                echo gettype( $array_msg[0]["picture"]);
                echo gettype( $array_msg[0]["price"]);
                echo gettype( $array_msg[0]["number_people"]);
                echo gettype( $array_msg[0]["quantity"]);
                echo gettype( $array_msg[0]["duration"]);
                echo gettype( $array_msg[0]["type"]);
                echo gettype( $array_msg[0]["option"]);
                echo gettype( $array_msg[0]["condition"]);
                echo gettype( $array_msg[0]["availability"]);
                echo gettype( $array_msg[0]["partner_id"]);
                echo gettype( $array_msg[0]["extra"]);
                echo gettype( $array_msg[0]["status"]);
                echo gettype( $array_msg[0]["created_at"]);
                echo gettype( $array_msg[0]["updated_at"]);
                die();

        $db->createCommand()->insert('{{%product_historique}}', [
                 'partner_category' => $array_msg[0]["partner_category"],
                 'name'=> $array_msg[0]["name"],
                 'description'=> $array_msg[0]["description"],
                 'picture'=> $array_msg[0]["picture"],
                 'price'=> $array_msg[0]["price"],
                 'number_people'=> $array_msg[0]["number_people"],
                 'quantity'=> $array_msg[0]["quantity"],
                 'duration'=> $array_msg[0]["duration"],
                 'product_type_id'=> $array_msg[0]["type"],
                 'product_option_id'=> $array_msg[0]["option"],
                 'condition'=> $array_msg[0]["condition"],
                 'availability'=> $array_msg[0]["availability"],
                 'partner_id'=> $array_msg[0]["partner_id"],
                 'extra'=> $array_msg[0]["extra"],
                 'status'=> $array_msg[0]["status"],
                 'created_at'=> $array_msg[0]["created_at"],
                 'updated_at'=> $array_msg[0]["updated_at"]
             ])->execute();









    }

}
