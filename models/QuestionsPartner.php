<?php

namespace app\models;

use \app\models\base\QuestionsPartner as BaseQuestionsPartner;

/**
 * This is the model class for table "questions_partner".
 */
class QuestionsPartner extends BaseQuestionsPartner
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['id', 'questions_id', 'partner_id', 'status', 'created_at', 'updated_at'], 'required'],
            [['id', 'questions_id', 'partner_id', 'status', 'created_at', 'updated_at'], 'integer']
        ]);
    }
	
}
