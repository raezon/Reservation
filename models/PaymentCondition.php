<?php

namespace app\models;

use \app\models\base\PaymentCondition as BasePaymentCondition;

/**
 * This is the model class for table "payment_condition".
 */
class PaymentCondition extends BasePaymentCondition
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(
            parent::rules(),
            [
                [['iban', 'bic', 'bankname', 'bankcountry', 'File', 'condition1', 'condition2', 'partner_id'], 'required'],
                [['iban', 'bic', 'partner_id'], 'integer'],
                [['bankname', 'bankcountry', 'File', 'condition1', 'condition2'], 'string', 'max' => 255]
            ]
        );
    }
}
