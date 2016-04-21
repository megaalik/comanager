<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Performer;

/**
 * PerformerSearch represents the model behind the search form about `common\models\Performer`.
 */
class PerformerSearch extends Performer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'singer'], 'integer'],
            [['last_name', 'first_name', 'patronymic', 'position', 'phone_num', 'mobile_num', 'email', 'sign_image'], 'safe'],
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
        $query = Performer::find();

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
            'singer' => $this->singer,
        ]);

        $query->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'patronymic', $this->patronymic])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'phone_num', $this->phone_num])
            ->andFilterWhere(['like', 'mobile_num', $this->mobile_num])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'sign_image', $this->sign_image]);

        return $dataProvider;
    }
}
