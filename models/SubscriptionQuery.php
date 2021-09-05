<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Subscription]].
 *
 * @see Subscription
 */
class SubscriptionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Subscription[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Subscription|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}