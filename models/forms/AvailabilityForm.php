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
    public $idi;
    public $cat_id;
    public $schedule;

    public function rules()
    {
        return [
            //  rules
            [['search', 'postalCode', 'state', 'city'], 'required'],
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
            'postalCode' => \Yii::t('app', 'Code Postal'),
            'state' => \Yii::t('app', 'Willaya'),
            'city' => \Yii::t('app', 'comune'),
            'schedule' => \Yii::t('app', ''),
        ];
    }
}
