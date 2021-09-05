<?php

namespace app\models;

use \app\models\base\QuestionsList as BaseQuestionsList;

/**
 * This is the model class for table "questions_list".
 */
class QuestionsList extends BaseQuestionsList
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['partner_category_id'], 'required'],
            [['partner_category_id'], 'integer'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
