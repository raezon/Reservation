<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "product_extra".
 *
 * @property integer $id
 * @property string $description
 * @property double $quantity
 * @property double $price
 */
class ProductExtra extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'quantity', 'price'], 'required'],
            [['quantity', 'price'], 'number'],
            [['description'], 'string', 'max' => 255],
           
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_extra';
    }

    /**
     * 
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock 
     * 
     */
   

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'quantity' => 'Quantity',
            'price' => 'Price',
        ];
    }

/**
     * @inheritdoc
     * @return array mixed
     */ 
  

    /**
     * @inheritdoc
     * @return \app\models\ProductExtraQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ProductExtraQuery(get_called_class());
    }
}
