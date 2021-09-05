<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PaymentCondition;

/**
 * PaymentConditionSearch represents the model behind the search form of `app\models\PaymentCondition`.
 */
class PaymentConditionSearch extends PaymentCondition
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'iban', 'bic', 'partner_id'], 'integer'],
            [['bankname', 'bankcountry', 'File', 'condition1', 'condition2'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = PaymentCondition::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'iban' => $this->iban,
            'bic' => $this->bic,
            'partner_id' => $this->partner_id,
        ]);

        $query->andFilterWhere(['like', 'bankname', $this->bankname])
            ->andFilterWhere(['like', 'bankcountry', $this->bankcountry])
            ->andFilterWhere(['like', 'File', $this->File])
            ->andFilterWhere(['like', 'condition1', $this->condition1])
            ->andFilterWhere(['like', 'condition2', $this->condition2]);

        return $dataProvider;
    }
}
