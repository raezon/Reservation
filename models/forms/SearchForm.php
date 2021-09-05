<?php

namespace app\models\forms;

class SearchForm extends \yii\base\Model
{
    public $category;
    public $date_depart;
    public $date_arriver;
    public $nbr_persson;
    public $place;
    public $subcategory;
    public function rules()
    {
        return [
            // username rules
            [['category', 'date_depart', 'date_arriver', 'nbr_persson', 'place'], 'required'],
            [['subcategory'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category' => \Yii::t('app', ''),
            'subcaeogry'=> \Yii::t('app', ''),
            'date_depart' => \Yii::t('app', ''),
            'date_arriver' => \Yii::t('app', ''),
            'nbr_persson' => \Yii::t('app', ''),
            'place' => \Yii::t('app', ''),

        ];
    }
}
