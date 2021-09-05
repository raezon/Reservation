<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "questions".
 *
 * @property int $id
 * @property int $questions_list_id
 * @property string $name
 * @property int $status
 * @property string $url
 *
 * @property QuestionsList $questionsList
 * @property QuestionsPartner[] $questionsPartners
 */
class Questions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'questions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['questions_list_id', 'name', 'status', 'url'], 'required'],
            [['questions_list_id', 'status'], 'integer'],
            [['name', 'url'], 'string', 'max' => 255],
            [['questions_list_id'], 'exist', 'skipOnError' => true, 'targetClass' => QuestionsList::className(), 'targetAttribute' => ['questions_list_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'questions_list_id' => 'Questions List ID',
            'name' => 'Name',
            'status' => 'Status',
            'url' => 'Url',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionsList()
    {
        return $this->hasOne(QuestionsList::className(), ['id' => 'questions_list_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionsPartners()
    {
        return $this->hasMany(QuestionsPartner::className(), ['questions_id' => 'id']);
    }
}
