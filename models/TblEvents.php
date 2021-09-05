<?php

namespace app\models;

use \app\models\base\TblEvents as BaseTblEvents;

/**
 * This is the model class for table "tbl_events".
 */
class TblEvents extends BaseTblEvents
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return
            [
                [['title', 'partner_id', 'start'], 'required'],
                [['partner_id'], 'integer'],
                [['start', 'end'], 'safe'],
                [['title'], 'string', 'max' => 255]
            ];
    }
}
