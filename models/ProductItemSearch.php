<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProductItem;
use yii\db\ActiveQuery;

/**
 * app\models\ProductItemSearch represents the model behind the search form about `app\models\ProductItem`.
 */
 class ProductItemSearch extends ProductItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'partner_category', 'people_number', 'number_of_agent', 'quantity', 'periode', 'status', 'product_id'], 'integer'],
            [['name', 'temp', 'description', 'currencies_symbol', 'languages', 'picture', 'checkbox'], 'safe'],
            [['price'], 'number'],
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
    public function search($params,$id)
    {

        $query = ProductItem::find();
        if(!empty($id)){
            $query = ProductItem::find()->where(['product_id'=>$id]);

        }
       
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
            'people_number' => $this->people_number,
            'number_of_agent' => $this->number_of_agent,
            'quantity' => $this->quantity,
            'periode' => $this->periode,
            'price' => $this->price,
            'status' => $this->status,
            'product_id' => $this->product_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'temp', $this->temp])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'currencies_symbol', $this->currencies_symbol])
            ->andFilterWhere(['like', 'languages', $this->languages])
            ->andFilterWhere(['like', 'picture', $this->picture])
            ->andFilterWhere(['like', 'checkbox', $this->checkbox]);

        return $dataProvider;
    }
}
