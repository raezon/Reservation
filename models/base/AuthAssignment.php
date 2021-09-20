<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "auth_assignment".
 *
 * @property string $item_name
 * @property string $user_id
 * @property integer $created_at
 */
class AuthAssignment extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id'], 'required'],
            [['created_at'], 'integer'],
            [['item_name', 'user_id'], 'string', 'max' => 64]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_assignment';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_name' => 'Item Name',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\AuthAssignmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\AuthAssignmentQuery(get_called_class());
    }
}
