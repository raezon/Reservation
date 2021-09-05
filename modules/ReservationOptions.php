<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "reservation_options".
 *
 * @property integer $id
 * @property integer $reservation_detail_id
 * @property integer $options_id
 * @property string $extra
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \app\models\ReservationDetail $reservationDetail
 * @property \app\models\Options $options
 */
class ReservationOptions extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reservation_detail_id', 'options_id', 'extra'], 'required'],
            [['reservation_detail_id', 'options_id', 'created_at', 'updated_at'], 'integer'],
            [['extra'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reservation_options';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'reservation_detail_id' => Yii::t('app', 'Reservation Detail ID'),
            'options_id' => Yii::t('app', 'Options ID'),
            'extra' => Yii::t('app', 'Extra'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservationDetail()
    {
        return $this->hasOne(\app\models\ReservationDetail::className(), ['id' => 'reservation_detail_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptions()
    {
        return $this->hasOne(\app\models\Options::className(), ['id' => 'options_id']);
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
     * @return \app\models\ReservationOptionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ReservationOptionsQuery(get_called_class());
    }
}
