<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Object;

/**
 * ObjectSearch represents the model behind the search form of `app\models\Object`.
 */
class ObjectSearch extends Object
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_city', 'id_street', 'type_tread', 'price', 'size_amount', 'size_life',
                'size_kitchen', 'floor', 'home_floors', 'num_bathroom', 'type_bathroom', 'amount_room',
                'elevator', 'distance_to_sea', 'distance_to_beach', 'distance_to_shop', 'distance_to_bus_stop',
                'distance_school', 'hight_on_sea', 'viev_of_sea'], 'integer'],
            [['num_house', 'ldg', 'desc'], 'safe'],
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
        $query = Object::find();

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
            'id_city' => $this->id_city,
            'id_street' => $this->id_street,
            'type_tread' => $this->type_tread,
            'price' => $this->price,
            'size_amount' => $this->size_amount,
            'size_life' => $this->size_life,
            'size_kitchen' => $this->size_kitchen,
            'floor' => $this->floor,
            'home_floors' => $this->home_floors,
            'num_bathroom' => $this->num_bathroom,
            'type_bathroom' => $this->type_bathroom,
            'amount_room' => $this->amount_room,
            'elevator' => $this->elevator,
            'distance_to_sea' => $this->distance_to_sea,
            'distance_to_beach' => $this->distance_to_beach,
            'distance_to_shop' => $this->distance_to_shop,
            'distance_to_bus_stop' => $this->distance_to_bus_stop,
            'distance_school' => $this->distance_school,
            'hight_on_sea' => $this->hight_on_sea,
            'viev_of_sea' => $this->viev_of_sea,
        ]);

        $query->andFilterWhere(['like', 'num_house', $this->num_house])
            ->andFilterWhere(['like', 'ldg', $this->ldg])
            ->andFilterWhere(['like', 'desc', $this->desc]);

        return $dataProvider;
    }
}
