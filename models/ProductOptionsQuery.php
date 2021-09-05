<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProductOptions]].
 *
 * @see ProductOptions
 */
class ProductOptionsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ProductOptions[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProductOptions|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}