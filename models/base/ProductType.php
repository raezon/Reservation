<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "product_type".
 *
 * @property integer $id
 * @property string $nom
 */
class ProductType extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nom'], 'required'],
            [['nom'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_type';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nom' => Yii::t('app', 'Nom'),
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\ProductTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ProductTypeQuery(get_called_class());
    }
}
