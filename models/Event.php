<?php

namespace app\models;

use \app\models\base\Event as BaseEvent;

/**
 * This is the model class for table "event".
 */
class Event extends BaseEvent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['title', 'partener_id', 'created_date'], 'required'],
            [['partener_id'], 'integer'],
            [['created_date'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
