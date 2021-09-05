<?php

namespace app\models;

use \app\models\base\ProductParent as BaseProductParent;

/**
 * This is the model class for table "product_parent".
 */

class ProductParent extends BaseProductParent
{
    /**
     * @inheritdoc
     */
    public $picutre;
    public $IBAN;
    public $BIC_SWIFT;
    public $Bank_name;
    public $Bank_country;
    public $File;
    public function rules()
    {
        return
            [
                [['partner_id', 'picutre', 'partner_category', 'name', 'kind_of_food', 'min', 'description', 'currencies_symbol'], 'required'],
                [['IBAN', 'BIC_SWIFT', 'Bank_name', 'Bank_country', 'File'], 'safe'],
                [['extra'], 'safe'],
                [['partner_id', 'partner_category'], 'integer'],
                [['name', 'kind_of_food', 'extra'], 'string', 'max' => 255]
            ];
    }
}
