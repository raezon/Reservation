<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "product".
 *
 * @property integer $id
 * @property integer $partner_category
 * @property string $name
 * @property string $description
 * @property string $picture
 * @property string $price
 * @property string $currencies_symbol
 * @property integer $number_people
 * @property string $quantity
 * @property integer $duration
 * @property integer $product_type_id
 * @property integer $product_option_id
 * @property string $condition
 * @property string $availability
 * @property integer $partner_id
 * @property string $extra
 * @property string $extra_option_information
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \app\models\Options[] $options
 * @property \app\models\Partner $partner
 * @property \app\models\PartnerCategory $partnerCategory
 * @property \app\models\ProductOption $productOption
 * @property \app\models\ProductType $productType
 * @property \app\models\ReservationDetail[] $reservationDetails
 */
class Product extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public $facilities;
    public $Possibility_check_name;
    public $Transportation_name;

    public function rules()
    {
        return [
            [['image','facilities','Possibility_check_name','Transportation_name','number_of_road'],'safe'],
            [['partner_category', 'name', 'description', 'picture', 'price', 'currencies_symbol', 'number_people', 'duration', 'product_option_id', 'partner_id', 'extra','status'], 'required'],
            [['partner_category', 'number_people', 'duration', 'product_type_id', 'product_option_id', 'partner_id', 'created_at', 'updated_at'], 'integer'],
            [['price', 'quantity'], 'number'],
            [['name', 'description', 'picture','image', 'condition', 'availability'], 'string', 'max' => 255],
            [['currencies_symbol'], 'string', 'max' => 7],
            [['extra'], 'string', 'max' => 1000],
            [['status'], 'string', 'max' => 1]
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
            'id' => 'ID',
            'partner_category' => 'Partner Category',
            'name' => 'Name',
            'description' => 'Description',
            'picture' => 'Picture',
            'price' => 'Price',
            'currencies_symbol' => 'Currencies Symbol',
            'number_people' => 'Number People',
            'quantity' => 'Quantity',
            'duration' => 'Duration',
            'product_type_id' => 'Product Type ID',
            'product_option_id' => 'Product Option ID',
            'condition' => 'Condition',
            'availability' => 'Availability',
            'partner_id' => 'Partner ID',
            'extra' => 'Extra',
            'extra_option_information' => 'Extra Option Information',
            'status' => 'Status',
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
    public function getPartnerCategory()
    {
        return $this->hasOne(\app\models\PartnerCategory::className(), ['id' => 'partner_category']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductOption()
    {
        return $this->hasOne(\app\models\ProductOption::className(), ['id' => 'product_option_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductType()
    {
        return $this->hasOne(\app\models\ProductType::className(), ['id' => 'product_type_id']);
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
     * @return \app\models\ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ProductQuery(get_called_class());
    }
}
