<?php

namespace app\models\forms;

class AvailabilityForm extends \yii\base\Model
{
    public $country;
    public $region;
    public $department;
    public $price;
    public $region2;
    public $department2;
    public $price2;

    public function rules()
    {
        return [
            // username rules
           // [['country', 'region', 'department', 'price'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'country' => \Yii::t('app', 'Country'),
            'region' => \Yii::t('app', 'Region'),
            'department' => \Yii::t('app', 'Department'),
            'price' => \Yii::t('app', 'Price'),
            'country' => \Yii::t('app', 'Country 2'),
            'region' => \Yii::t('app', 'Region 2'),
            'department' => \Yii::t('app', 'Department 2'),
            'price' => \Yii::t('app', 'Price 2'),
        ];
    }

}