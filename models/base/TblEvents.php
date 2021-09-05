<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "tbl_events".
 *
 * @property integer $id
 * @property string $title
 * @property integer $partner_id
 * @property string $start
 * @property string $end
 *
 * @property \app\models\Partner $partner
 */
class TblEvents extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'partner_id', 'start'], 'required'],
            [['partner_id'], 'integer'],
            [['start', 'end'], 'safe'],
            [['title'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_events';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'partner_id' => 'Partner ID',
            'start' => 'Start',
            'end' => 'End',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartner()
    {
        return $this->hasOne(\app\models\Partner::className(), ['id' => 'partner_id']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\TblEventsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\TblEventsQuery(get_called_class());
    }
}
