<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "payment".
 *
 * @property integer $id
 * @property string $payment_date
 * @property string $amount
 * @property integer $status
 * @property string $piece_jointe
 * @property integer $reservation_id
 * @property integer $created_at
 * @property integer $updated_at
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
            [['id', 'payment_date', 'amount', 'status', 'reservation_id'], 'required'],
            [['id', 'status', 'reservation_id', 'created_at', 'updated_at'], 'integer'],
            [['payment_date'], 'safe'],
            [['amount'], 'number'],
            [['piece_jointe'], 'string'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
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
     * 
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock 
     * 
     */
    public function optimisticLock() {
        return 'lock';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payment_date' => 'Payment Date',
            'amount' => 'Amount',
            'status' => 'Status',
            'piece_jointe' => 'Piece Jointe',
            'reservation_id' => 'Reservation ID',
        ];
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
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
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
     * @return \app\models\PaymentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\PaymentQuery(get_called_class());
    }
}
