<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "payment".
 *
 * @property integer $id
 * @property string $payment_date
 * @property string $amount
 * @property integer $status
 * @property integer $reservation_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \app\models\Reservation $reservation
 */
class Payment extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payment_date', 'amount', 'status', 'reservation_id'], 'required'],
            [['payment_date'], 'safe'],
            [['amount'], 'number'],
            [['status', 'reservation_id', 'created_at', 'updated_at'], 'integer']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'payment_date' => Yii::t('app', 'Payment Date'),
            'amount' => Yii::t('app', 'Amount'),
            'status' => Yii::t('app', 'Status'),
            'reservation_id' => Yii::t('app', 'Reservation ID'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservation()
    {
        return $this->hasOne(\app\models\Reservation::className(), ['id' => 'reservation_id']);
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
     * @return \app\models\PaymentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\PaymentQuery(get_called_class());
    }
}
