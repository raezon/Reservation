<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "questions_partner".
 *
 * @property integer $id
 * @property integer $questions_id
 * @property integer $partner_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \app\models\Partner $partner
 * @property \app\models\QuestionsList $questions
 */
class QuestionsPartner extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'questions_id', 'partner_id', 'status', 'created_at', 'updated_at'], 'required'],
            [['id', 'questions_id', 'partner_id', 'status', 'created_at', 'updated_at'], 'integer']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'questions_partner';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'questions_id' => Yii::t('app', 'Questions ID'),
            'partner_id' => Yii::t('app', 'Partner ID'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartner()
    {
        return $this->hasOne(\app\models\Partner::className(), ['id' => 'partner_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasOne(\app\models\QuestionsList::className(), ['id' => 'questions_id']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\QuestionsPartnerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\QuestionsPartnerQuery(get_called_class());
    }
}
