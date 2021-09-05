<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "options".
 *
 * @property integer $id
 * @property string $name
 * @property string $price
 * @property integer $product_id
 * @property integer $updated_at
 *
 * @property \app\models\Product $product
 * @property \app\models\ReservationOptions[] $reservationOptions
 */
class Options extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'price', 'product_id'], 'required'],
            [['price'], 'number'],
            [['product_id', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'options';
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
            'product_id' => Yii::t('app', 'Product ID'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(\app\models\Product::className(), ['id' => 'product_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservationOptions()
    {
        return $this->hasMany(\app\models\ReservationOptions::className(), ['options_id' => 'id']);
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
     * @return \app\models\OptionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\OptionsQuery(get_called_class());
    }
}
