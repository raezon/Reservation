<?php

namespace app\models;

use \app\models\base\Options as BaseOptions;

/**
 * This is the model class for table "options".
 */
class QuestionAnswers extends BaseOptions
{
    /**
     * @inheritdoc
     */
        const UPDATE_TYPE_CREATE = 'create';

    const UPDATE_TYPE_UPDATE = 'update';

    const UPDATE_TYPE_DELETE = 'delete';


    const SCENARIO_BATCH_UPDATE = 'batchUpdate';




    private $_updateType;


    public function getUpdateType()

    {

        if (empty($this->_updateType)) {

            if ($this->isNewRecord) {

                $this->_updateType = self::UPDATE_TYPE_CREATE;

            } else {

                $this->_updateType = self::UPDATE_TYPE_UPDATE;

            }

        }


        return $this->_updateType;

    }


    public function setUpdateType($value)

    {

        $this->_updateType = $value;

    }


    public function rules()

    {

        return [

            ['updateType', 'required', 'on' => self::SCENARIO_BATCH_UPDATE],

            ['updateType',

                'in',

                'range' => [self::UPDATE_TYPE_CREATE, self::UPDATE_TYPE_UPDATE, self::UPDATE_TYPE_DELETE],

                'on' => self::SCENARIO_BATCH_UPDATE]

            ,            

            [['question_id'], 'integer'],

            //allowing it to be empty because it will be filled by the QuestionController

            ['question_id', 'required', 'except' => self::SCENARIO_BATCH_UPDATE],            

            [['answer'], 'required', 'message' => ''],

            [['answer', 'feedback'], 'string'],

            [['fraction'], 'number'],

            [['question_id', 'answer'], 'unique', 'targetAttribute' => ['question_id', 'answer'], 'message' => yii::t('course', 'Answer already exist for this Question.')],

        ];

    }


    public function attributeLabels()

    {

        return [

            'id' => 'Question Answer',

            'question_id' => 'Question',

            'answer' => 'Answer',

            'fraction' => 'Fraction',

            'feedback' => 'Feedback',

        ];

    }


    public function getQuestions()

    {

        return $this->hasOne(\app\modules\course\models\Questions::className(), ['id' => 'question_id']);

    } 
	
}
