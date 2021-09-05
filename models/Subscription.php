<?php

namespace app\models;

use \app\models\base\Subscription as BaseSubscription;
use Yii;

/**
 * This is the model class for table "subscription".
 */
class Subscription extends BaseSubscription
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['start_date', 'end_date', 'partner_id'], 'required'],
            [['start_date', 'end_date'], 'safe'],
            [['partner_id', 'created_at', 'updated_at'], 'integer'],
            [['pack'], 'string', 'max' => 255]
        ]);
    }

   /** 
    * overrided 
    */ 
   public function attributeLabels() 
   { 
       return [ 
           'id' => Yii::t('app', 'ID'), 
           'start_date' => Yii::t('app', 'Start Date'), 
           'end_date' => Yii::t('app', 'End Date'), 
           'pack' => Yii::t('app', 'Pack'), 
           'partner_id' => Yii::t('app', 'Partner'), 
       ]; 
   }

}
