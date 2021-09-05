<?php

namespace app\models;

use \app\models\base\ProductType as BaseProductType;

/**
 * This is the model class for table "product_type".
 */
class ProductType extends BaseProductType
{
    /**
     * @inheritdoc
     */
    public $area;
    public $caution;
    public $event_cake;
    public $drink;
    public $External_food;
    public $External_Catering;
    public $Internal_Catering;
    public $Without_guarantee;
    public $Minimum_consumption_Price;
    public $Wifi;
    public $Board;
    public $System_Sound;
    public $Micro;
    public $To_bring_back_cake_of_the_event;
    public $To_bring_back_drinks;
    public $Parking_lot;
    public $Parking_lot_field;
    public $Video_projector;
    public $Subway;
    public $Subway_field;
    public $Train;
    public $Train_field;
    public $Bus;
    public $Bus_field;

    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['nom'], 'required'],
            [['nom'], 'string', 'max' => 1000]
        ]);
    }
        public function attributeLabels()
    {
        return [
              'event_cake'=>\Yii::t('app',''),
              'drink'=>\Yii::t('app',''),
              'External_food'=>\Yii::t('app',''),
              'External_Catering'=>\Yii::t('app',''),
              'Internal_Catering'=>\Yii::t('app',''),
              'Without_guarantee'=>\Yii::t('app',''),
              'Minimum_consumption_Price'=>\Yii::t('app',''),
              'Wifi'=>\Yii::t('app',''),
              'Board'=>\Yii::t('app',''),
              'System_Sound'=>\Yii::t('app',''),
              'Micro'=>\Yii::t('app',''),
              'To_bring_back_cake_of_the_event'=>\Yii::t('app',''),
              'To_bring_back_drinks'=>\Yii::t('app',''),
              'Parking_lot'=>\Yii::t('app',''),
              'Parking_lot_field'=>\Yii::t('app',''),
              'Subway'=>\Yii::t('app',''),
              'Subway_field'=>\Yii::t('app',''),
              'Train'=>\Yii::t('app',''),
              'Train_field'=>\Yii::t('app',''),
              'Bus'=>\Yii::t('app',''),
              'Bus_field' =>\Yii::t('app',''),
              'Video_projector' =>\Yii::t('app',''),    
              'vegan'=>\Yii::t('app',''),
              'glutenfree'=>\Yii::t('app',''),
              'Halal'=>\Yii::t('app',''),
              'Kosher'=>\Yii::t('app',''),
              'Organic'=>\Yii::t('app',''),
              'Withoutpork'=>\Yii::t('app',''),
              'nombre_de_equipement'=>\Yii::t('app','')
        ];
    }
	
}
