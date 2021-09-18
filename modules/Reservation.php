<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "reservation".
 *
 * @property integer $id
 * @property string $reservation_date
 * @property string $start_date
 * @property string $end_date
 * @property integer $status
 * @property string $country
 * @property string $city
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \app\models\Payment[] $payments
 * @property \app\models\User $user
 * @property \app\models\ReservationDetail[] $reservationDetails
 */
class Reservation extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reservation_date', 'user_id'], 'required'],
            [['reservation_date', 'start_date', 'end_date'], 'safe'],
            [['status', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['country', 'city'], 'string', 'max' => 255]            
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reservation';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'reservation_date' => Yii::t('app', 'Reservation Date'),
            'start_date' => Yii::t('app', 'Start Date'),
            'end_date' => Yii::t('app', 'End Date'),
            'status' => Yii::t('app', 'Status'),
         
            'country' => Yii::t('app', 'Country'),
            'city' => Yii::t('app', 'City'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(\app\models\Payment::className(), ['reservation_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'user_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservationDetails()
    {
        return $this->hasMany(\app\models\ReservationDetail::className(), ['reservation_id' => 'id']);
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
     * @return \app\models\ReservationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ReservationQuery(get_called_class());
    }
}
