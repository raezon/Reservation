<?php

namespace app\models\forms;

class AvailabilityForm extends \yii\base\Model
{

    public $search;
    public $companyAddress_N;
    public $companyAddress;
    public $city;
    public $state;
    public $postalCode;
    public $country;
    public $delai;
    public $idi;
    public $cat_id;
    public $schedule;

    public function rules()
    {
        return [
            //  rules
            [['companyAddress', 'companyAddress_N', 'search', 'postalCode', 'schedule', 'schedule.Distance', 'schedule.Price', 'country', 'city', 'delai'], 'required'],
            [['cat_id', 'idi'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'search' => \Yii::t('app', 'Search'),
            'companyAddress' => \Yii::t('app', 'Company Address'),
            'postalCode' => \Yii::t('app', 'Postal Code'),
            'country' => \Yii::t('app', 'Country'),
            'city' => \Yii::t('app', 'City'),
            'schedule' => \Yii::t('app', ''),
        ];
    }
}
