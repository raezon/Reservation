<?php

namespace app\models\partner;

use dektrium\user\models\RegistrationForm as BaseRegistrationForm;
//use yii\base\Model;

class RegistrationForm  extends 
// Model 
 BaseRegistrationForm
{
    /**
     * @var string
     */
    public $api_key;
    
    /**
     * @var string
     */
//    public $username;

    /**
     * @var string
     */
//    public $email;
    
    /**
     * @var string
     */
//    public $password;

    /**
     * @var string
     */
    public $repeat_password;
    
    /**
     * @var boolean
     */
    public $accept;

    /**
     * @var string
     */
//    public $name;
    
    /**
     * @var string
     */
//    public $description;
    
    /**
     * @var string
     */
//    public $address;
    
    /**
     * @var string
     */
//    public $country;
    
    /**
     * @var string
     */
//    public $city;
    
    /**
     * @var string
     */
//    public $tel;
    
    /**
     * @var string
     */
//    public $web_site;
    
    /**
     * @var string
     */
//    public $postal_code;
    
    /**
     * @var integer
     */
//    public $category_id;
    
    /**
     * @inheritdoc
     *
    public function rules()
    {
        $user = $this->module->modelMap['User'];

        return [
            // username rules
            'usernameTrim'     => ['username', 'trim'],
            'usernameLength'   => ['username', 'string', 'min' => 3, 'max' => 255],
            'usernamePattern'  => ['username', 'match', 'pattern' => $user::$usernameRegexp],
            'usernameRequired' => ['username', 'required'],
            'usernameUnique'   => [
                'username',
                'unique',
                'targetClass' => $user,
                'message' => \Yii::t('user', 'This username has already been taken')
            ],
            // email rules
            'emailTrim'     => ['email', 'trim'],
            'emailRequired' => ['email', 'required'],
            'emailPattern'  => ['email', 'email'],
            'emailUnique'   => [
                'email',
                'unique',
                'targetClass' => $user,
                'message' => \Yii::t('user', 'This email address has already been taken')
            ],
            // password rules
            'passwordRequired' => ['password', 'required', 'skipOnEmpty' => $this->module->enableGeneratingPassword],
            'passwordLength'   => ['password', 'string', 'min' => 6, 'max' => 72],
            //'repeat_password'   => ['repeat_password', 'string', 'min' => 6, 'max' => 72],
        ];
    }*/

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email'    => \Yii::t('user', 'Email'),
            'username' => \Yii::t('user', 'User Name'),
            'password' => \Yii::t('user', 'Password'),
            'repeat_password' => \Yii::t('user', 'Repeat Password'),
            'accept' => \Yii::t('app', 'Accept terms and conditions?'),
//            'name' => \Yii::t('app', 'Name'),
//            'description' => \Yii::t('app', 'Description'),
//            'address' => \Yii::t('app', 'Address'),
//            'country' => \Yii::t('app', 'Country'),
//            'city' => \Yii::t('app', 'City'),
//            'category_id' => \Yii::t('app', 'Category'),
//            'tel' => \Yii::t('app', 'Tel'),
//            'web_site' => \Yii::t('app', 'Web Site'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['api_key', 'repeat_password',/*, 'username',/* 'password', 'email'*/], 'required'];
        $rules[] = ['api_key', 'string', 'max' => 16];
//        $rules[] = [['name', 'address', 'country', 'city', 'postal_code', 'email'], 'string', 'max' => 255];
//        $rules[] = [['name', 'description', 'address', 'country', 'city', 'category_id', 'accept'], 'required'];
//        $rules[] = [['description', 'postal_code', 'web_site', 'tel'], 'string'];
//        $rules['categoryInteger'] = [['category_id'], 'integer'];
        $rules['usernameLength'] = ['username', 'string', 'min' => 3, 'max' => 255];
        $rules['passwordLength'] = ['password', 'string', 'min' => 3, 'max' => 72];
        $rules['confirmPassword'] = ['repeat_password', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match"];
        $rules['acceptRequired'] = ['accept', 'required', 'requiredValue' => 1, 'message'=>'You must agree to the terms and conditions.'];
//        $rules['telLength'] = [['tel'], 'string', 'max' => 10];
//        $rules['nameUnique'] = [['name'], 'unique'];
        
        return $rules;
    }
    
    /**
     * Registers a new user account. If registration was successful it will set flash message.
     *
     * @return bool
     */
    public function register()
    {
        if (!$this->validate()) {
            return false;
        }

        /** @var User $user */
        $user = \Yii::createObject(\app\models\User::className());
        $user->setScenario('register');
        $this->loadAttributes($user);

        if (!$user->register()) {
            return false;
        }

//        Yii::$app->session->setFlash(
//            'info',
//            Yii::t(
//                'user',
//                'Your account has been created and a message with further instructions has been sent to your email'
//            )
//        );

        return $user;
    }    
}