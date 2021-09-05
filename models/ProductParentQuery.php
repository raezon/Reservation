<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProductParent]].
 *
 * @see ProductParent
 */
class ProductParentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ProductParent[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProductParent|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}