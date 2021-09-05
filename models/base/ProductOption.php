<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "product_option".
 *
 * @property integer $id
 * @property string $name
 *
 * @property \app\models\Product[] $products
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
            [['name'], 'required'],
            [['name'], 'string', 'max' => 1000],
           // [['lock'], 'default', 'value' => '0'],
            //[['lock'], 'mootensai\components\OptimisticLockValidator']
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
            'name' => 'Name',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(\app\models\Product::className(), ['product_option_id' => 'id']);
    }
    
/**
     * @inheritdoc
     * @return array mixed
     */ 
   /* public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }*/

    /**
     * @inheritdoc
     * @return \app\models\ProductOptionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ProductOptionQuery(get_called_class());
    }
     public function all($db = null)
    {
        return parent::all($db);
    }
}
