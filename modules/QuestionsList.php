<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "questions_list".
 *
 * @property integer $id
 * @property integer $partner_category_id
 *
 * @property \app\models\Questions[] $questions
 * @property \app\models\PartnerCategory $partnerCategory
 * @property \app\models\QuestionsPartner[] $questionsPartners
 */
class QuestionsList extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['partner_category_id'], 'required'],
            [['partner_category_id'], 'integer']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'questions_list';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'partner_category_id' => Yii::t('app', 'Partner Category ID'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(\app\models\Questions::className(), ['questions_list_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartnerCategory()
    {
        return $this->hasOne(\app\models\PartnerCategory::className(), ['id' => 'partner_category_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionsPartners()
    {
        return $this->hasMany(\app\models\QuestionsPartner::className(), ['questions_id' => 'id']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\QuestionsListQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\QuestionsListQuery(get_called_class());
    }
}
