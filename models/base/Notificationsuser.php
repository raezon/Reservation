<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "notificationsuser".
 *
 * @property integer $id
 * @property string $class
 * @property string $key
 * @property string $key2
 * @property string $message
 * @property string $answer
 * @property string $route
 * @property integer $seen
 * @property integer $read
 * @property string $user_id
 * @property integer $sender_id
 * @property string $created_at
 */
class Notificationsuser extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class', 'key', 'key2', 'message', 'answer', 'route', 'sender_id'], 'required'],
            [['user_id', 'sender_id', 'created_at'], 'integer'],
            [['class'], 'string', 'max' => 64],
            [['key'], 'string', 'max' => 32],
            [['key2'], 'string', 'max' => 5000],
            [['message', 'answer', 'route'], 'string', 'max' => 255],
            [['seen', 'read'], 'string', 'max' => 1]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notificationsuser';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'class' => 'Class',
            'key' => 'Key',
            'key2' => 'Key2',
            'message' => 'Message',
            'answer' => 'Answer',
            'route' => 'Route',
            'seen' => 'Seen',
            'read' => 'Read',
            'user_id' => 'User ID',
            'sender_id' => 'Sender ID',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\NotificationsuserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\NotificationsuserQuery(get_called_class());
    }
}
