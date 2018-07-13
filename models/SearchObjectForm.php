<?php
/**
 * Created by PhpStorm.
 * User: Egor
 * Date: 25.04.2018
 * Time: 13:26
 */

namespace app\models;
use Yii;
use yii\base\Model;



class SearchObjectForm extends Model
{
    public $id_city;
    public $id_street;
    public $type_tread;
    public $num_bathroom;
    public $type_bathroom;
    public $amount_room;
    public $elevator;
    public $viev_of_sea;

    /**
     *
     *
     * @return array the validation rules.
     */

    public function rules()
    {
        return [
            [[  'id_city' , 'id_street','type_tread',  'type_bathroom' ,'amount_room', 'amount_room', 'elevator', 'viev_of_sea' ,], 'safe'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'id_city' => 'Город',
            'id_street' => 'Улица',
            'type_tread' => 'Тип сделки',
            'num_bathroom' => 'Количество санузлов',
            'type_bathroom' => 'Тип санузла',
            'amount_room' => 'Количество комнат',
            'elevator' => 'Лифт',
            'viev_of_sea' => 'Вид на море',

        ];
    }


}