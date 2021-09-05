<?php

namespace app\models\user;

use dektrium\user\models\RegistrationForm as BaseRegistrationForm;

class RegistrationForm extends BaseRegistrationForm
{
    /**
     * @var string
     */
    public $api_key;

    /**
     * @var string
     */
    public $repeat_password;

    /**
     * @var boolean
     */
    public $agree;

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
            'agree' => \Yii::t('app', 'Accept terms and conditions?'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = ['api_key', 'required'];
        $rules[] = ['api_key', 'string', 'max' => 16];
        $rules['usernameLength'] = ['username', 'string', 'min' => 3, 'max' => 255];
        $rules['passwordLength'] = ['password', 'string', 'min' => 3, 'max' => 72];
        $rules['confirmPassword'] = ['repeat_password', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"];
        $rules['agreeRequired'] = ['agree', 'required', 'requiredValue' => 1, 'message' => 'You must agree to the terms and conditions.'];

        return $rules;
    }
}
