<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ComponentSearch represents the model behind the search form about `common\models\Component`.
 */
class ComponentSearch extends Component
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'price'], 'integer'],
            [['artcode', 'name', 'price_date', 'eng_desc', 'rus_desc'], 'safe'],
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
        $query = Component::find();

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
            'price' => $this->price,
            'price_date' => $this->price_date,
        ]);

        $query->andFilterWhere(['like', 'artcode', $this->artcode])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'eng_desc', $this->eng_desc])
            ->andFilterWhere(['like', 'rus_desc', $this->rus_desc]);

        return $dataProvider;
    }
}
