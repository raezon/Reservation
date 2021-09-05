<?php

namespace app\models;

use \app\models\base\Other as BaseOther;

/**
 * This is the model class for table "other".
 */
class Other extends BaseOther
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['name', 'category_id', 'type', 'partener_id'], 'required'],
            [['category_id', 'type', 'partener_id'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ]);
    }
	
}
