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
            [[ 'payment_date', 'amount', 'reservation_id'], 'required'],
            [['id', 'status', 'reservation_id', 'created_at', 'updated_at'], 'integer'],
            [['payment_date'], 'safe'],
            [['amount'], 'number'],
         
          
        ]);
    }
	
}
