<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Partner]].
 *
 * @see Partner
 */
class PartnerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Partner[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Partner|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}