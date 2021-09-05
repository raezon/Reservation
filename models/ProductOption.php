<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_option".
 *
 * @property int $id
 * @property string $name
 * @property float $price_day
 * @property float $price_night
 * @property int $partner_id
 *
 * @property Product[] $products
 */
class ProductOption extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_option';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
    
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
  
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['product_option_id' => 'id']);
    }
}
