<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProductLanguages;

/**
 * app\models\ProductLanguagesSearch represents the model behind the search form about `app\models\ProductLanguages`.
 */
 class ProductLanguagesSearch extends ProductLanguages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id'], 'integer'],
            [['french', 'russian', 'italian', 'german', 'chinese', 'japanese', 'arabic'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ProductLanguages::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'product_id' => $this->product_id,
        ]);

        $query->andFilterWhere(['like', 'french', $this->french])
            ->andFilterWhere(['like', 'russian', $this->russian])
            ->andFilterWhere(['like', 'italian', $this->italian])
            ->andFilterWhere(['like', 'german', $this->german])
            ->andFilterWhere(['like', 'chinese', $this->chinese])
            ->andFilterWhere(['like', 'japanese', $this->japanese])
            ->andFilterWhere(['like', 'arabic', $this->arabic]);

        return $dataProvider;
    }
}
