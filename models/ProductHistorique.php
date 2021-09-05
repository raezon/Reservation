<?php

namespace app\models;

use \app\models\base\ProductHistorique as BaseProductHistorique;

/**
 * This is the model class for table "product_historique".
 */
class ProductHistorique extends BaseProductHistorique
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['partner_category', 'name', 'description', 'picture', 'price', 'number_people', 'duration', 'product_type_id', 'product_option_id', 'partner_id', 'extra', 'status'], 'required'],
            [['partner_category', 'partner_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description', 'picture', 'price', 'number_people', 'quantity', 'duration', 'condition', 'availability'], 'string', 'max' => 255],
            [['product_type_id', 'product_option_id'], 'string', 'max' => 1255],
            [['extra'], 'string', 'max' => 1000],
            [['status'], 'string', 'max' => 1]
        ]);
    }
	
}
