<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "profile".
 *
 * @property integer $user_id
 * @property string $name
 * @property string $public_email
 * @property string $gravatar_email
 * @property string $gravatar_id
 * @property string $location
 * @property string $website
 * @property string $bio
 * @property string $timezone
 *
 * @property \app\models\User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['bio'], 'string'],
            [['name', 'public_email', 'gravatar_email', 'location', 'website'], 'string', 'max' => 255],
            [['gravatar_id'], 'string', 'max' => 32],
            [['timezone'], 'string', 'max' => 40]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'name' => Yii::t('app', 'Name'),
            'public_email' => Yii::t('app', 'Public Email'),
            'gravatar_email' => Yii::t('app', 'Gravatar Email'),
            'gravatar_id' => Yii::t('app', 'Gravatar ID'),
            'location' => Yii::t('app', 'Location'),
            'website' => Yii::t('app', 'Website'),
            'bio' => Yii::t('app', 'Bio'),
            'timezone' => Yii::t('app', 'Timezone'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'user_id']);
    }
    
/**
     * @inheritdoc
     * @return array mixed
     */ 
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\ProfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ProfileQuery(get_called_class());
    }
}
