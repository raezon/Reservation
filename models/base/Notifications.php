<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "notifications".
 *
 * @property integer $id
 * @property string $class
 * @property string $key
 * @property string $key2
 * @property string $message
 * @property integer $reservation_id
 * @property string $route
 * @property integer $seen
 * @property integer $read
 * @property integer $user_id
 * @property integer $created_at
 *
 * @property \app\models\Reservation $reservation
 */
class Notifications extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class', 'key', 'key2', 'message', 'reservation_id', 'route'], 'required'],
            [['key'], 'string'],
            [['reservation_id', 'user_id', 'created_at'], 'integer'],
            [['class'], 'string', 'max' => 64],
            [['key2'], 'string', 'max' => 5000],
            [['message', 'route'], 'string', 'max' => 255],
            [['seen', 'read'], 'string', 'max' => 1]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notifications';
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
            'reservation_id' => 'Reservation ID',
            'route' => 'Route',
            'seen' => 'Seen',
            'read' => 'Read',
            'user_id' => 'User ID',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservation()
    {
        return $this->hasOne(\app\models\Reservation::className(), ['id' => 'reservation_id']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\NotificationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\NotificationsQuery(get_called_class());
    }
}
