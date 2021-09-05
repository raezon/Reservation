<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "subscription".
 *
 * @property integer $id
 * @property string $start_date
 * @property string $end_date
 * @property string $pack
 * @property integer $partner_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \app\models\Partner $partner
 */
class Subscription extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_date', 'end_date', 'partner_id'], 'required'],
            [['start_date', 'end_date'], 'safe'],
            [['partner_id', 'created_at', 'updated_at'], 'integer'],
            [['pack'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscription';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'start_date' => Yii::t('app', 'Start Date'),
            'end_date' => Yii::t('app', 'End Date'),
            'pack' => Yii::t('app', 'Pack'),
            'partner_id' => Yii::t('app', 'Partner ID'),
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
     * @return \app\models\SubscriptionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\SubscriptionQuery(get_called_class());
    }
}
