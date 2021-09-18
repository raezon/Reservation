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
 * @property string $piece_jointe
 * @property integer $reservation_id
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
            [[ 'payment_date', 'amount', 'reservation_id'], 'required'],
            [['id',  'reservation_id'], 'integer'],
            [['payment_date'], 'safe'],
            [['amount'], 'number'],
         
           
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
