<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "product".
 *
 * @property integer $id
 * @property string $name
 * @property string $price
 * @property string $quantity
 * @property string $type
 * @property string $condition
 * @property string $availability
 * @property integer $partner_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \app\models\Options[] $options
 * @property \app\models\Partner $partner
 * @property \app\models\ReservationDetail[] $reservationDetails
 */
class Product extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'price', 'partner_id'], 'required'],
            [['price', 'quantity'], 'number'],
            [['partner_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'type', 'condition', 'availability'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'price' => Yii::t('app', 'Price'),
            'quantity' => Yii::t('app', 'Quantity'),
            'type' => Yii::t('app', 'Type'),
            'condition' => Yii::t('app', 'Condition'),
            'availability' => Yii::t('app', 'Availability'),
            'partner_id' => Yii::t('app', 'Partner ID'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptions()
    {
        return $this->hasMany(\app\models\Options::className(), ['product_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartner()
    {
        return $this->hasOne(\app\models\Partner::className(), ['id' => 'partner_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservationDetails()
    {
        return $this->hasMany(\app\models\ReservationDetail::className(), ['product_id' => 'id']);
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
     * @return \app\models\ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ProductQuery(get_called_class());
    }
}
