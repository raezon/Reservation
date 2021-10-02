<?php

namespace app\models;

use \app\models\base\Partner as BasePartner;

/**
 * This is the model class for table "partner".
 */
class Partner extends BasePartner
{
    /**
     * @inheritdoc
     */
    public $companyAddress;
    public $companyAddress_N;
    public $latitude;
    public $longitude;
    public $piece_jointe;
    
  
    public function rules()
    {
        return
            [
                [['name', 'description', 'address', 'fax', 'country', 'city', 'user_id', 'category_id', 'status'], 'required'],
                [['companyAddress', 'companyAddress_N','state'], 'safe'],
                [['description'], 'string'],
                [['user_id', 'category_id', 'status', 'created_at', 'updated_at'], 'integer'],
                [['name', 'address', 'web_site', 'country', 'city', 'postal_code', 'keywords', 'email', 'picture'], 'string', 'max' => 255]
            ];
    }
}
