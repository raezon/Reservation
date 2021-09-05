<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PartnerCategory]].
 *
 * @see PartnerCategory
 */
class PartnerCategoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return PartnerCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PartnerCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}