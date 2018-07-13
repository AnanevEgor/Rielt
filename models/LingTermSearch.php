<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LingTerm;

/**
 * LingTermSearch represents the model behind the search form of `app\models\LingTerm`.
 */
class LingTermSearch extends LingTerm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_func_own', 'id_ling_var'], 'integer'],
            [['name'], 'safe'],
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
        $query = LingTerm::find();

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
            'id_func_own' => $this->id_func_own,
            'id_ling_var' => $this->id_ling_var,
            'a' => $this->a,
            'b' => $this->b,
            'c' => $this->c,
            'd' => $this->d,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
