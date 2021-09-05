<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use app\modules\survey\models\Survey;

/**
 * This is the base model class for table "surveys".
 *
 * @property integer $id
 * @property integer $survey_order
 * @property integer $survey_id
 * @property integer $partner_category_surveys_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \app\models\PartnerCategorySurveys $partnerCategorySurveys
 * @property \app\models\Survey $survey
 */
class Surveys extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['survey_order', 'survey_id', 'partner_category_surveys_id'], 'required'],
            [['survey_order', 'survey_id', 'partner_category_surveys_id', 'created_at', 'updated_at'], 'integer']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'surveys';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'survey_order' => Yii::t('app', 'Survey Order'),
            'survey_id' => Yii::t('app', 'Survey'),
            'partner_category_surveys_id' => Yii::t('app', 'Partner Category Surveys'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartnerCategorySurveys()
    {
        return $this->hasOne(\app\models\PartnerCategorySurveys::className(), ['id' => 'partner_category_surveys_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurvey()
    {
        return $this->hasOne(Survey::className(), ['survey_id' => 'survey_id']);
    }
    
/**
     * @inheritdoc
     * @return array mixed
     */ 
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\SurveysQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\SurveysQuery(get_called_class());
    }
}
