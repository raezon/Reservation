<?php

namespace app\models;

use \app\models\base\PartnerCategory as BasePartnerCategory;

/**
 * This is the model class for table "partner_category".
 */
class PartnerCategory extends BasePartnerCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['name'], 'required'],
            [['commision'], 'number'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ]);
    }
    
    public function getDirectoryName() {
        
        return /*'./uploads/'.*/str_replace('/', '-', strtolower($this->name));
    }
	
}
