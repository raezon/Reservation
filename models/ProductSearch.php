<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * app\models\ProductSearch represents the model behind the search form about `app\models\Product`.
 */
 class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'partner_category', 'number_people', 'duration', 'product_type_id', 'product_option_id', 'partner_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description', 'picture', 'currencies_symbol', 'condition', 'availability', 'extra', 'status'], 'safe'],
            [['price', 'quantity'], 'number'],
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
        $query = Product::find();

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
            'price' => $this->price,
            'number_people' => $this->number_people,
            'quantity' => $this->quantity,
            'duration' => $this->duration,
            'product_type_id' => $this->product_type_id,
            'product_option_id' => $this->product_option_id,
            'partner_id' => $this->partner_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'picture', $this->picture])
            ->andFilterWhere(['like', 'currencies_symbol', $this->currencies_symbol])
            ->andFilterWhere(['like', 'condition', $this->condition])
            ->andFilterWhere(['like', 'availability', $this->availability])
            ->andFilterWhere(['like', 'extra', $this->extra])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
