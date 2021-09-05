<?php

namespace app\models;

use \app\models\base\Options as BaseOptions;

/**
 * This is the model class for table "options".
 */
class Options extends BaseOptions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['name', 'price', 'product_id'], 'required'],
            [['price'], 'number'],
            [['product_id', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ]);
    }
	
}
