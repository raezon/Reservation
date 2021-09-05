<?php

namespace app\models;

use \app\models\base\Options as BaseOptions;

/**
 * This is the model class for table "options".
 */
class Options1 extends BaseOptions
{
    /**
     * @inheritdoc
     */
       public function attributeLabels()

    {

        return [

            'id' => Yii::t('course', 'Question'),

            'question_category_id' => Yii::t('course', 'Question Category'),

            'question_course_id' => Yii::t('course', 'Course'),

            'instructor_id' => Yii::t('course', 'Instructor'),

            'question_name' => Yii::t('course', 'Question Name'),

            'question_text' => Yii::t('course', 'Question Text'),

            'default_mark' => Yii::t('course', 'Default Mark'),

            'penalty' => Yii::t('course', 'Penalty'),

            'qtype' => Yii::t('course', 'Question Type'),

            'mcq_answer_option' => Yii::t('course', 'Mcq Answer Option'),

            'is_status' => Yii::t('course', 'Is Status'),

        ];

    }


    public function getQuestionAnswers()

    {

        return $this->hasMany(\app\models\QuestionAnswers::className(), ['question_id' => 'id']);

    } 

	
}
