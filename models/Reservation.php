<?php

namespace app\models;

use \app\models\base\Reservation as BaseReservation;
use Yii;

/**
 * This is the model class for table "reservation".
 */
class Reservation extends BaseReservation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['reservation_date', 'user_id'], 'required'],
            [['reservation_date', 'start_date', 'end_date'], 'safe'],
            [['status', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['observation'], 'string'],
            [['country', 'city'], 'string', 'max' => 255]
        ]);
    }
    
    /**
     * overrrided
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'reservation_date' => Yii::t('app', 'Reservation Date'),
            'start_date' => Yii::t('app', 'Start Date'),
            'end_date' => Yii::t('app', 'End Date'),
            'status' => Yii::t('app', 'Status'),
            'observation' => Yii::t('app', 'Observation'),
            'country' => Yii::t('app', 'Country'),
            'city' => Yii::t('app', 'City'),
            'user_id' => Yii::t('app', 'User'),
        ];
    }	
}
