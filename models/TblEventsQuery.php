<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[TblEvents]].
 *
 * @see TblEvents
 */
class TblEventsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return TblEvents[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TblEvents|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
