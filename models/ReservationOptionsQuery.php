<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ReservationOptions]].
 *
 * @see ReservationOptions
 */
class ReservationOptionsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ReservationOptions[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ReservationOptions|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}