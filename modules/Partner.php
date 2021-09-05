<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "partner".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $address
 * @property string $tel
 * @property string $web_site
 * @property string $country
 * @property string $city
 * @property string $postal_code
 * @property string $keywords
 * @property string $email
 * @property string $picture
 * @property integer $user_id
 * @property integer $category_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \app\models\PartnerCategory $category
 * @property \app\models\User $user
 * @property \app\models\Product[] $products
 * @property \app\models\Subscription[] $subscriptions
 */
class Partner extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'address', 'country', 'city', 'user_id', 'category_id', 'status'], 'required'],
            [['description'], 'string'],
            [['user_id', 'category_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'address', 'web_site', 'country', 'city', 'postal_code', 'keywords', 'email', 'picture'], 'string', 'max' => 255],
            [['tel'], 'string', 'max' => 10],
            [['name']]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partner';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'address' => Yii::t('app', 'Address'),
            'tel' => Yii::t('app', 'Tel'),
            'web_site' => Yii::t('app', 'Web Site'),
            'country' => Yii::t('app', 'Country'),
            'city' => Yii::t('app', 'City'),
            'postal_code' => Yii::t('app', 'Postal Code'),
            'keywords' => Yii::t('app', 'Keywords'),
            'email' => Yii::t('app', 'Email'),
            'picture' => Yii::t('app', 'Picture'),
            'user_id' => Yii::t('app', 'User ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(\app\models\PartnerCategory::className(), ['id' => 'category_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'user_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(\app\models\Product::className(), ['partner_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscriptions()
    {
        return $this->hasMany(\app\models\Subscription::className(), ['partner_id' => 'id']);
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
     * @return \app\models\PartnerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\PartnerQuery(get_called_class());
    }
}
