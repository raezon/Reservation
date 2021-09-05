<?php

namespace app\models;

use \app\models\base\PartnerCategorySurveys as BasePartnerCategorySurveys;

/**
 * This is the model class for table "partner_category_surveys".
 */
class PartnerCategorySurveys extends BasePartnerCategorySurveys
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['title', 'partner_category_id'], 'required'],
            [['partner_category_id', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['partner_category_id'], 'unique']
        ]);
    }
	
}
