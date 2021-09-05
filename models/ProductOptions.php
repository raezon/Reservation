<?php

namespace app\models;

use \app\models\base\ProductOptions as BaseProductOptions;

/**
 * This is the model class for table "product_options".
 */
class ProductOptions extends BaseProductOptions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['price_day', 'price_night', 'partner_id'], 'required'],
            [['price_day', 'price_night', 'partner_id'], 'number'],
            //[['lock'], 'default', 'value' => '0'],
            //[['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
