<?php

namespace app\models;

use Yii;

/**
 * This is the model display in map.
 *
 * @property float $latitude_départ
 * @property float $longitude_départ
 * @property float $latitude_arriver
 * @property float $longitude_arriver

 */
class modelMap extends \yii\base\Model
{


    /**
     * {@inheritdoc}
     */
    public $latitude_départ;
    public $longitude_départ;
    public $latitude_arriver;
    public $longitude_arriver;

    public function rules()
    {
        return [
            [['latitude_départ', 'longitude_départ', 'latitude_arriver', 'longitude_arriver'], 'required'],

            [['latitude_départ', 'longitude_départ', 'latitude_arriver', 'longitude_arriver'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'latitude_départ' => 'Latitude',
            'longitude_départ' => 'Longitude',
            'latitude_arriver' => 'Latitude',
            'longitude_arriver' => 'Longitude',


        ];
    }
}
