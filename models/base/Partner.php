<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "partner".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $address
 * @property string $tel
 * @property string $fax
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
 * @property \app\models\Other[] $others
 * @property \app\models\PartnerCategory $category
 * @property \app\models\User $user
 * @property \app\models\Product[] $products
 * @property \app\models\QuestionsPartner[] $questionsPartners
 * @property \app\models\Subscription[] $subscriptions
 * @property \app\models\TblEvents[] $tblEvents
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
            [['name', 'description', 'address', 'fax', 'country', 'city', 'user_id', 'category_id', 'status','v'], 'required'],
            [['description','state'], 'string'],
            [['user_id', 'category_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'address', 'web_site', 'country', 'city', 'postal_code', 'keywords', 'email', 'picture'], 'string', 'max' => 255],
           
            
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
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'address' => 'Address',
            'tel' => 'Tel',
            'fax' => 'Fax',
            'web_site' => 'Web Site',
            'country' => 'Country',
            'city' => 'City',
            'postal_code' => 'Postal Code',
            'keywords' => 'Keywords',
            'email' => 'Email',
            'picture' => 'Picture',
            'user_id' => 'User ID',
            'category_id' => 'Category ID',
            'status' => 'Status',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOthers()
    {
        return $this->hasMany(\app\models\Other::className(), ['partener_id' => 'id']);
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
    public function getQuestionsPartners()
    {
        return $this->hasMany(\app\models\QuestionsPartner::className(), ['partner_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscriptions()
    {
        return $this->hasMany(\app\models\Subscription::className(), ['partner_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblEvents()
    {
        return $this->hasMany(\app\models\TblEvents::className(), ['partner_id' => 'id']);
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
