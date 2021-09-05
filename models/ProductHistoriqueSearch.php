<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProductHistorique;

/**
 * app\models\ProductHistoriqueSearch represents the model behind the search form about `app\models\ProductHistorique`.
 */
 class ProductHistoriqueSearch extends ProductHistorique
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'partner_category', 'partner_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description', 'picture', 'price', 'number_people', 'quantity', 'duration', 'product_type_id', 'product_option_id', 'condition', 'availability', 'extra', 'status'], 'safe'],
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
        $query = ProductHistorique::find();

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
            'partner_category' => $this->partner_category,
            'partner_id' => $this->partner_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'picture', $this->picture])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'number_people', $this->number_people])
            ->andFilterWhere(['like', 'quantity', $this->quantity])
            ->andFilterWhere(['like', 'duration', $this->duration])
            ->andFilterWhere(['like', 'product_type_id', $this->product_type_id])
            ->andFilterWhere(['like', 'product_option_id', $this->product_option_id])
            ->andFilterWhere(['like', 'condition', $this->condition])
            ->andFilterWhere(['like', 'availability', $this->availability])
            ->andFilterWhere(['like', 'extra', $this->extra])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
