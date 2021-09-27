<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "avis".
 *
 * @property int $id
 * @property string $commentaire
 * @property string $date
 */
class Avis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'avis';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['commentaire', 'date'], 'required'],
            [['commentaire'], 'string'],
      
            [['date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'commentaire' => 'Commentaire',
            'note' => 'Note',
            'date' => 'Date',
        ];
    }
}
