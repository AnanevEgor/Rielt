<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "object".
 *
 * @property string $id
 * @property string $id_city
 * @property string $id_street
 * @property string $num_house
 * @property string $ldg
 * @property int $type_tread
 * @property int $price
 * @property int $size_amount
 * @property int $size_life
 * @property int $size_kitchen
 * @property int $floor
 * @property int $home_floors
 * @property int $num_bathroom
 * @property int $type_bathroom
 * @property int $amount_room
 * @property int $elevator
 * @property int $distance_to_sea
 * @property int $distance_to_beach
 * @property int $distance_to_shop
 * @property int $distance_to_bus_stop
 * @property int $distance_school
 * @property int $hight_on_sea
 * @property int $viev_of_sea
 * @property string $desc
 *
 * @property Belong[] $belongs
 * @property Cities $city
 * @property Streets $street
 */
class Object extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'object';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_city', 'id_street', 'num_house', 'type_tread', 'price', 'size_amount', 'size_life', 'size_kitchen', 'floor',
                'num_bathroom', 'type_bathroom', 'amount_room', 'elevator', 'distance_to_sea', 'distance_to_beach', 'distance_to_shop',
                'distance_to_bus_stop', 'distance_school', 'hight_on_sea', 'viev_of_sea'], 'required'],
            [['id_city', 'id_street', 'type_tread', 'price', 'size_amount', 'size_life', 'size_kitchen', 'floor',
                'num_bathroom', 'type_bathroom', 'amount_room', 'elevator', 'distance_to_sea', 'distance_to_beach', 'distance_to_shop',
                'distance_to_bus_stop', 'distance_school', 'hight_on_sea', 'viev_of_sea'], 'integer'],
            [['num_house'], 'string', 'max' => 5],
            [['home_floors'], 'integer',],
            [['desc'], 'string', 'max' => 950],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_city' => 'Город',
            'id_street' => 'Улица',
            'num_house' => 'Номер дома',
            'ldg' => 'хз',
            'type_tread' => 'Тип сделки',
            'price' => 'Цена в руб.',
            'size_amount' => 'Общая площадь',
            'size_life' => 'Жилая площадь',
            'size_kitchen' => 'Площадь кухни',
            'floor' => 'Этаж',
            'home_floors' => 'Этажей в доме',
            'num_bathroom' => 'Количество санузлов',
            'type_bathroom' => 'Тип санузла',
            'amount_room' => 'Количество комнат',
            'elevator' => 'Лифт',
            'distance_to_sea' => 'Расстояние до моря',
            'distance_to_beach' => 'Расстояние до пляжа',
            'distance_to_shop' => 'Расстояние до магазина',
            'distance_to_bus_stop' => 'Расстояние до остановки',
            'distance_school' => 'Расстояние до школы',
            'hight_on_sea' => 'Высота над уровнем моря',
            'viev_of_sea' => 'Вид на море',
            'desc' => '',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBelongs()
    {
        return $this->hasMany(Belong::className(), ['id_object' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'id_city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStreet()
    {
        return $this->hasOne(Streets::className(), ['id' => 'id_street']);
    }
    /* Геттер для полного адреса по горду и улице */
    public function getFullAdres() {
        return $this->city . ' ' . $this->street;
    }

}
