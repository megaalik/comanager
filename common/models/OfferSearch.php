<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Offer;

/**
 * OfferSearch represents the model behind the search form about `common\models\Offer`.
 */
class OfferSearch extends Offer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'provider_costs', 'delivery_costs', 'local_delivery_costs', 'service_costs', 'registration_costs', 'currency_rate', 'total_price', 'total_price_nds', 'customer_id', 'city_id', 'user_id'], 'integer'],
            [['offer_date', 'delivery_conditions', 'price_type', 'currency', 'performer_id'], 'safe'],
            [['customs_duty', 'nds', 'income_rate', 'marketing_costs'], 'number'],
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
        $query = Offer::find();

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
            'offer_date' => $this->offer_date,
            'provider_costs' => $this->provider_costs,
            'delivery_costs' => $this->delivery_costs,
            'local_delivery_costs' => $this->local_delivery_costs,
            'customs_duty' => $this->customs_duty,
            'nds' => $this->nds,
            'service_costs' => $this->service_costs,
            'income_rate' => $this->income_rate,
            'registration_costs' => $this->registration_costs,
            'marketing_costs' => $this->marketing_costs,
            'currency_rate' => $this->currency_rate,
            'total_price' => $this->total_price,
            'total_price_nds' => $this->total_price_nds,
            'customer_id' => $this->customer_id,
            'city_id' => $this->city_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'delivery_conditions', $this->delivery_conditions])
            ->andFilterWhere(['like', 'price_type', $this->price_type])
            ->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'performer_id', $this->performer_id]);

        return $dataProvider;
    }
}
