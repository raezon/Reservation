<?php

namespace app\models;

use \app\models\base\ProductExtra as BaseProductExtra;

/**
 * This is the model class for table "product_extra".
 */
class ProductExtra extends BaseProductExtra
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['description', 'quantity', 'price'], 'required'],
            [['quantity', 'price'], 'number'],
            [['description'], 'string', 'max' => 255],
          //  [['lock'], 'default', 'value' => '0'],
           // [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
