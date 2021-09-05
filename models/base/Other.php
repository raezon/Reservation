<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "other".
 *
 * @property integer $id
 * @property string $name
 * @property integer $category_id
 * @property integer $type
 * @property integer $partener_id
 *
 * @property \app\models\Partner $partener
 */
class Other extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'category_id', 'type', 'partener_id'], 'required'],
            [['category_id', 'type', 'partener_id'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'other';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'category_id' => 'Category ID',
            'type' => 'Type',
            'partener_id' => 'Partener ID',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartener()
    {
        return $this->hasOne(\app\models\Partner::className(), ['id' => 'partener_id']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\OtherQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\OtherQuery(get_called_class());
    }
}
