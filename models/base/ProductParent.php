<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "product_parent".
 *
 * @property integer $id
 * @property integer $partner_id
 * @property integer $partner_category
 * @property string $name
 * @property string $kind_of_food
 * @property string $min
 * @property string $description
 * @property string $extra
 * @property string $currencies_symbol
 * @property string $IBAN
 * @property string $BIC_SWIFT
 * @property string $Bank_name
 * @property string $Bank_country
 * @property string $File
 */
class ProductParent extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['partner_id', 'partner_category', 'name', 'kind_of_food', 'min', 'extra', 'currencies_symbol', 'description'], 'required'],
            [['IBAN', 'BIC_SWIFT', 'Bank_name', 'Bank_country', 'File'], 'safe'],
            [['partner_id', 'partner_category'], 'integer'],
            [['name', 'kind_of_food', 'min', 'extra', 'currencies_symbol'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_parent';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'partner_id' => 'Partner ID',
            'partner_category' => 'Partner Category',
            'name' => 'Name',
            'kind_of_food' => 'Kind Of Food',
            'min' => 'Min',
            'description' => 'Description',
            'extra' => 'Extra',
            'currencies_symbol' => 'Currencies Symbol',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartnerCategory()
    {
        return $this->hasOne(\app\models\PartnerCategory::className(), ['id' => 'partner_category']);
    }
    /**
     * @inheritdoc
     * @return \app\models\ProductParentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ProductParentQuery(get_called_class());
    }
}
