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
    public $idi;
    public $id;
    public $cat_id;
    public $companyName;



    public function rules()
    {
        return [
            // username rules
            //      [['firstName', 'lastName', 'mobile', 'email', 'companyName', 'companyAddress', 'companyAddress_N', 'search', 'postalCode', 'schedule', 'schedule.Distance', 'schedule.Price', 'country', 'city','delai'], 'required'],
            [['firstName', 'lastName', 'mobile', 'email', 'companyName'], 'required'],
            [['cat_id', 'idi','id'], 'safe'],
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
            'idi' => \Yii::t('app', 'idi'),
            'cat_id' => \Yii::t('app', 'Category_id'),




        ];
    }
}
