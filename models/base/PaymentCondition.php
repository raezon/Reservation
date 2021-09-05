<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "payment_condition".
 *
 * @property integer $id
 * @property integer $iban
 * @property integer $bic
 * @property string $bankname
 * @property string $bankcountry
 * @property string $File
 * @property string $condition1
 * @property string $condition2
 * @property integer $partner_id
 *
 * @property \app\models\Partner $partner
 */
class PaymentCondition extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['iban', 'bic', 'bankname', 'bankcountry', 'File', 'condition1', 'condition2', 'partner_id'], 'required'],
            [['iban', 'bic', 'partner_id'], 'integer'],
            [['bankname', 'bankcountry', 'File', 'condition1', 'condition2'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_condition';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'iban' => 'Iban',
            'bic' => 'Bic',
            'bankname' => 'Bankname',
            'bankcountry' => 'Bankcountry',
            'File' => 'File',
            'condition1' => 'Condition1',
            'condition2' => 'Condition2',
            'partner_id' => 'Partner ID',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartner()
    {
        return $this->hasOne(\app\models\Partner::className(), ['id' => 'partner_id']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\PaymentConditionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\PaymentConditionQuery(get_called_class());
    }
}
