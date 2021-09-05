<?php

namespace app\models;

use \app\models\base\Payment as BasePayment;
use Yii;

/**
 * This is the model class for table "payment".
 */
class Payment extends BasePayment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['payment_date', 'amount', 'status', 'reservation_id'], 'required'],
            [['payment_date'], 'safe'],
            [['amount'], 'number'],
            [['status', 'reservation_id', 'created_at', 'updated_at'], 'integer']
        ]);
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
            'reservation_id' => Yii::t('app', 'Reservation'),
        ];
    }

}
