<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Other]].
 *
 * @see Other
 */
class OtherQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Other[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Other|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}