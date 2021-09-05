<?php

namespace app\models;

use \app\models\base\Product as BaseProduct;

/**
 * This is the model class for table "product".
 */
class Product extends BaseProduct
{
    /**
     * @inheritdoc
     */
    public $facilities;
    public $Possibility_check_name;
    public $Transportation_name;
    public $image;

    public function rules()
    {
        return [
            [['image','facilities','Possibility_check_name','Transportation_name','number_of_road'],'safe'],
            [['partner_category', 'name', 'description', 'picture', 'price', 'currencies_symbol', 'number_people', 'duration', 'product_option_id', 'partner_id', 'extra','status'], 'required'],
            [['partner_category', 'number_people', 'duration', 'product_type_id', 'product_option_id', 'partner_id', 'created_at', 'updated_at'], 'integer'],
            [['price', 'quantity'], 'number'],
            [['name', 'description', 'picture','image', 'condition', 'availability'], 'string', 'max' => 255],
            [['currencies_symbol'], 'string', 'max' => 7],
            [['extra'], 'string', 'max' => 1000],
            [['status'], 'string', 'max' => 1]
        ];
    }
	
}
