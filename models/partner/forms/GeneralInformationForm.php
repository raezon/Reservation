<?php

namespace app\models\forms;

class GeneralInformationForm extends \yii\base\Model
{
    public $firstName;
    public $lastName;
    public $tel;
    public $mobile;
    public $fax;
    public $email;
    public $companyName;
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
            // username rules
            [['firstName', 'lastName', 'mobile', 'email', 'companyName', 'companyAddress', 'companyAddress_N', 'search', 'postalCode', 'schedule', 'schedule.Distance', 'schedule.Price', 'country', 'city','delai'], 'required'],
            [['cat_id', 'idi'], 'safe'],
            [['tel', 'mobile', 'fax'], 'string'],
            ['email', 'email']

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'firstName' => \Yii::t('app', 'First Name'),
            'lastName' => \Yii::t('app', 'Last Name'),
            'tel' => \Yii::t('app', 'Tel'),
            'mobile' => \Yii::t('app', 'Mobile manager'),
            'fax' => \Yii::t('app', 'Fax'),
            'email' => \Yii::t('app', 'Email'),
            'companyName' => \Yii::t('app', 'Company Name'),
            'search' => \Yii::t('app', 'Search'),
            'companyAddress' => \Yii::t('app', 'Company Address'),
            'postalCode' => \Yii::t('app', 'Postal Code'),
            'country' => \Yii::t('app', 'Country'),
            'city' => \Yii::t('app', 'City'),
            'idi' => \Yii::t('app', 'idi'),
            'cat_id' => \Yii::t('app', 'Category_id'),
            'schedule' => \Yii::t('app', ''),




        ];
    }
}
