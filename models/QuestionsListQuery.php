<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[QuestionsList]].
 *
 * @see QuestionsList
 */
class QuestionsListQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return QuestionsList[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return QuestionsList|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}