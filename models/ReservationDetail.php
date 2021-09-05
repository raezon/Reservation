<?php

namespace app\models;

use \app\models\base\ReservationDetail as BaseReservationDetail;

/**
 * This is the model class for table "reservation_detail".
 */
class ReservationDetail extends BaseReservationDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['reservation_id', 'product_id', 'quantity'], 'required'],
            [['reservation_id', 'product_id', 'created_at', 'updated_at'], 'integer'],
            [['quantity'], 'number']
        ]);
    }
	
}
