<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Customer;

/**
 * CustomerSearch represents the model behind the search form about `common\models\Customer`.
 */
class CustomerSearch extends Customer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'org_type', 'city'], 'integer'],
            [['org_name', 'head_position', 'head_position_dp', 'male', 'last_name', 'first_name', 'patronymic', 'last_name_dp', 'first_name_dp', 'patronimic_dp', 'contacts'], 'safe'],
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
        $query = Customer::find();

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
            'org_type' => $this->org_type,
            'city' => $this->city,
        ]);

        $query->andFilterWhere(['like', 'org_name', $this->org_name])
            ->andFilterWhere(['like', 'head_position', $this->head_position])
            ->andFilterWhere(['like', 'head_position_dp', $this->head_position_dp])
            ->andFilterWhere(['like', 'male', $this->male])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'patronymic', $this->patronymic])
            ->andFilterWhere(['like', 'last_name_dp', $this->last_name_dp])
            ->andFilterWhere(['like', 'first_name_dp', $this->first_name_dp])
            ->andFilterWhere(['like', 'patronimic_dp', $this->patronimic_dp])
            ->andFilterWhere(['like', 'contacts', $this->contacts]);

        return $dataProvider;
    }
}
