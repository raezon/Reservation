<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "reservation_detail".
 *
 * @property integer $id
 * @property integer $reservation_id
 * @property integer $product_id
 * @property string $quantity
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \app\models\Reservation $reservation
 * @property \app\models\Product $product
 * @property \app\models\ReservationOptions[] $reservationOptions
 */
class ReservationDetail extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reservation_id', 'product_id', 'quantity'], 'required'],
            [['reservation_id', 'product_id', 'created_at', 'updated_at'], 'integer'],
            [['quantity'], 'number']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reservation_detail';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'reservation_id' => Yii::t('app', 'Reservation ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'quantity' => Yii::t('app', 'Quantity'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservation()
    {
        return $this->hasOne(\app\models\Reservation::className(), ['id' => 'reservation_id']);
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
        return $this->hasMany(\app\models\ReservationOptions::className(), ['reservation_detail_id' => 'id']);
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
     * @return \app\models\ReservationDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ReservationDetailQuery(get_called_class());
    }
}
