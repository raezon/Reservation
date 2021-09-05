<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Notificationsuser]].
 *
 * @see Notificationsuser
 */
class NotificationsuserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Notificationsuser[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Notificationsuser|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}