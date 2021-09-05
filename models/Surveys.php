<?php

namespace app\models;

use \app\models\base\Surveys as BaseSurveys;

/**
 * This is the model class for table "surveys".
 */
class Surveys extends BaseSurveys
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['survey_order', 'survey_id', 'partner_category_surveys_id'], 'required'],
            [['survey_order', 'survey_id', 'partner_category_surveys_id', 'created_at', 'updated_at'], 'integer']
        ]);
    }
	
}
