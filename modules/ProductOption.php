<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "product_option".
 *
 * @property integer $id
 * @property string $name
 * @property integer $product_id
 * @property integer $category_id
 *
 * @property \app\models\Product $product
 */
class ProductOption extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'product_id', 'category_id'], 'required'],
            [['product_id', 'category_id'], 'integer'],
            [['name'], 'string', 'max' => 250]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_option';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'product_id' => Yii::t('app', 'Product ID'),
            'category_id' => Yii::t('app', 'Category ID'),
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
     * @inheritdoc
     * @return \app\models\ProductOptionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ProductOptionQuery(get_called_class());
    }
}
