<?php

namespace app\models;

use \app\models\base\ProductLanguages as BaseProductLanguages;

/**
 * This is the model class for table "product_languages".
 */
class ProductLanguages extends BaseProductLanguages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['french', 'russian', 'italian', 'german', 'chinese', 'japanese', 'arabic', 'product_name'], 'required'],
            [['french', 'russian', 'italian', 'german', 'chinese', 'japanese', 'arabic'], 'string', 'max' => 10],
            [['product_name'], 'string', 'max' => 255],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
