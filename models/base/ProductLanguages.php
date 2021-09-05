<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "product_languages".
 *
 * @property integer $id
 * @property string $french
 * @property string $russian
 * @property string $italian
 * @property string $german
 * @property string $chinese
 * @property string $japanese
 * @property string $arabic
 * @property string $product_name
 */
class ProductLanguages extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['french', 'russian', 'italian', 'german', 'chinese', 'japanese', 'arabic', 'product_name'], 'required'],
            [['french', 'russian', 'italian', 'german', 'chinese', 'japanese', 'arabic'], 'string', 'max' => 10],
            [['product_name'], 'string', 'max' => 255],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_languages';
    }

    /**
     * 
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock 
     * 
     */
    public function optimisticLock() {
        return 'lock';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'french' => 'French',
            'russian' => 'Russian',
            'italian' => 'Italian',
            'german' => 'German',
            'chinese' => 'Chinese',
            'japanese' => 'Japanese',
            'arabic' => 'Arabic',
            'product_name' => 'Product Name',
        ];
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
    }

    /**
     * @inheritdoc
     * @return \app\models\ProductLanguagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ProductLanguagesQuery(get_called_class());
    }
}
