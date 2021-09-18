<?php

namespace app\models;

use \app\models\base\Reservation as BaseReservation;

/**
 * This is the model class for table "reservation".
 */
class Reservation extends BaseReservation
{
    /**
     * @inheritdoc
     */
    public $file;
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['reservation_date', 'piece_jointe', 'user_id', 'product_item_id'], 'required'],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'file,pdf'],
            [['reservation_date'], 'safe'],
            [['piece_jointe'], 'string'],
            [['status', 'user_id', 'product_item_id'], 'integer'],
            [['montant'], 'number']
        ]);
    }
	
}
