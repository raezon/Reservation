<?php

namespace app\models;

use \app\models\base\Notifications as BaseNotifications;

/**
 * This is the model class for table "notifications".
 */
class Notifications extends BaseNotifications
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['class', 'key', 'key2', 'message', 'reservation_id', 'route'], 'required'],
            [['key'], 'string'],
            [['reservation_id', 'user_id', 'created_at'], 'integer'],
            [['class'], 'string', 'max' => 64],
            [['key2'], 'string', 'max' => 5000],
            [['message', 'route'], 'string', 'max' => 255],
            [['seen', 'read'], 'string', 'max' => 1]
        ]);
    }
	
}
