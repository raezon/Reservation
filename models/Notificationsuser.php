<?php

namespace app\models;

use \app\models\base\Notificationsuser as BaseNotificationsuser;

/**
 * This is the model class for table "notificationsuser".
 */
class Notificationsuser extends BaseNotificationsuser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['class', 'key', 'key2', 'message', 'answer', 'route', 'sender_id'], 'required'],
            [['user_id', 'sender_id', 'created_at'], 'integer'],
            [['class'], 'string', 'max' => 64],
            [['key'], 'string', 'max' => 32],
            [['key2'], 'string', 'max' => 5000],
            [['message', 'answer', 'route'], 'string', 'max' => 255],
            [['seen', 'read'], 'string', 'max' => 1]
        ]);
    }
	
}
