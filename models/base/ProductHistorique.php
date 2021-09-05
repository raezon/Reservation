<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "product_historique".
 *
 * @property integer $id
 * @property integer $partner_category
 * @property string $name
 * @property string $description
 * @property string $picture
 * @property string $price
 * @property string $number_people
 * @property string $quantity
 * @property string $duration
 * @property string $product_type_id
 * @property string $product_option_id
 * @property string $condition
 * @property string $availability
 * @property integer $partner_id
 * @property string $extra
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class ProductHistorique extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['partner_category', 'name', 'description', 'picture', 'price', 'number_people', 'duration', 'product_type_id', 'product_option_id', 'partner_id', 'extra', 'status'], 'required'],
            [['partner_category', 'partner_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description', 'picture', 'price', 'number_people', 'quantity', 'duration', 'condition', 'availability'], 'string', 'max' => 255],
            [['product_type_id', 'product_option_id'], 'string', 'max' => 1255],
            [['extra'], 'string', 'max' => 1000],
            [['status'], 'string', 'max' => 1]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_historique';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'partner_category' => Yii::t('app', 'Partner Category'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'picture' => Yii::t('app', 'Picture'),
            'price' => Yii::t('app', 'Price'),
            'number_people' => Yii::t('app', 'Number People'),
            'quantity' => Yii::t('app', 'Quantity'),
            'duration' => Yii::t('app', 'Duration'),
            'product_type_id' => Yii::t('app', 'Product Type ID'),
            'product_option_id' => Yii::t('app', 'Product Option ID'),
            'condition' => Yii::t('app', 'Condition'),
            'availability' => Yii::t('app', 'Availability'),
            'partner_id' => Yii::t('app', 'Partner ID'),
            'extra' => Yii::t('app', 'Extra'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\ProductHistoriqueQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ProductHistoriqueQuery(get_called_class());
    }
}
