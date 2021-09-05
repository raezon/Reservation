<?php

namespace app\models;

use \app\models\base\ReservationOptions as BaseReservationOptions;

/**
 * This is the model class for table "reservation_options".
 */
class ReservationOptions extends BaseReservationOptions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['reservation_detail_id', 'options_id', 'extra'], 'required'],
            [['reservation_detail_id', 'options_id', 'created_at', 'updated_at'], 'integer'],
            [['extra'], 'string', 'max' => 255]
        ]);
    }
	
}
