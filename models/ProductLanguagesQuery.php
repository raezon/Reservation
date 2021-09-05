<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProductLanguages]].
 *
 * @see ProductLanguages
 */
class ProductLanguagesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ProductLanguages[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProductLanguages|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}