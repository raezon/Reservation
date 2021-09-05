<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[QuestionsPartner]].
 *
 * @see QuestionsPartner
 */
class QuestionsPartnerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return QuestionsPartner[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return QuestionsPartner|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}