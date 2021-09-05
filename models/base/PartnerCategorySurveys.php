<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "partner_category_surveys".
 *
 * @property integer $id
 * @property string $title
 * @property integer $partner_category_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \app\models\PartnerCategory $partnerCategory
 * @property \app\models\Surveys[] $surveys
 */
class PartnerCategorySurveys extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'partner_category_id'], 'required'],
            [['partner_category_id', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['partner_category_id'], 'unique']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partner_category_surveys';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'partner_category_id' => Yii::t('app', 'Partner Category'),
        ];
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
    public function getSurveys()
    {
        return $this->hasMany(\app\models\Surveys::className(), ['partner_category_surveys_id' => 'id']);
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
     * @return \app\models\PartnerCategorySurveysQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\PartnerCategorySurveysQuery(get_called_class());
    }
}
