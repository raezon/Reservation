<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProductHistorique]].
 *
 * @see ProductHistorique
 */
class ProductHistoriqueQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ProductHistorique[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProductHistorique|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}