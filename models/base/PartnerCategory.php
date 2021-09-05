<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "partner_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $commision
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \app\models\Partner[] $partners
 */
class PartnerCategory extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['commision'], 'number'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partner_category';
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
            'commision' => Yii::t('app', 'Commision'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartners()
    {
        return $this->hasMany(\app\models\Partner::className(), ['category_id' => 'id']);
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
     * @return \app\models\PartnerCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\PartnerCategoryQuery(get_called_class());
    }
}
