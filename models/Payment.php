<?php

namespace app\models;

use \app\models\base\Payment as BasePayment;

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
            [['id', 'payment_date', 'amount', 'status', 'reservation_id'], 'required'],
            [['id', 'status', 'reservation_id', 'created_at', 'updated_at'], 'integer'],
            [['payment_date'], 'safe'],
            [['amount'], 'number'],
            [['piece_jointe'], 'string'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
