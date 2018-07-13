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
use app\models\LingTerm;
use app\models\Belongs;


class SearchTermForm extends Model
{
    public $koef1; // минимальный коэффицент для поиска
    public $id_ling_var;
    public $kvant1; // квантификатор 0- - 1-не(1-прин), 2-очень(, 3-более-менее
    public $id1;
    public $and_or; // квантификатор 0-без 1- и, 2-или
    public $koef2; // минимальный коэффицент для поиска
    public $kvant2;
    public $id2;
    public $activ;


    /**
     *
     *
     * @return array the validation rules.
     */

    public function rules()
    {
        return [
            [[ 'koef1','koef2', 'id_ling_var','kvant1','id1','and_or','kvant2','id2', 'activ'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [

            'koef1' => 'Мин. принадлежность',
            'koef2' => 'Мин. принадлежность',
            'id_ling_var' => 'Линг.переменная',
            'kvant1' => 'Квантификатор',
            'id1' => 'Линг. терма',
            'and_or' => 'Добавить терму как',
            'kvant2' => 'Квантификатор',
            'id2' => 'Линг. терма',
        ];
    }
    public function id_for_terms()
    {// находим первый массив id по квантификатору

        switch ($this->kvant1) {
            case 1:

                $id_search = array_column(Belong::find()->select('id_object')->where('id_ling_term ='.$this->id1. ' and 1-own >= '.  $this->koef1)->asArray()->all(), 'id_object');

                break;
            case 2:
                $id_search = array_column(Belong::find()->select('id_object')->where('id_ling_term ='.$this->id1. ' and own*own >='.  $this->koef1)->asArray()->all(), 'id_object');
                break;
            case 3:
                $id_search = array_column(Belong::find()->select('id_object')->where('id_ling_term ='.$this->id1. ' and sqrt(own) >= '.$this->koef1)->asArray()->all(), 'id_object');
                break;
            default:
                $id_search = array_column(Belong::find()->select('id_object')->where('id_ling_term ='.$this->id1. ' and own >='.  $this->koef1)->asArray()->all(), 'id_object');
                    //->createCommand()->sql;
                break;
        }

        if($this->and_or==1)
        {
            switch ($this->kvant2) {
                case 1 :
                    $id_search1 = Belong::find()->select('id_object')->where('id_ling_term ='.$this->id2. ' and 1-own >= '.$this->koef2)
                    ->andWhere(['id_object'=>$id_search ])->asArray()->all();
                    break;
                case 2:
                    $id_search1 = Belong::find()->select('id_object')->where('zid_ling_term ='.$this->id2. ' and own*own >= '.$this->koef2)
                        ->andWhere(['id_object'=>$id_search  ])->asArray()->all();
                    break;
                case 3:
                    $id_search1 = Belong::find()->select('id_object')->where('id_ling_term ='.$this->id2. ' and sqrt(own) >='.  $this->koef2)
                        ->andWhere(['id_object'=>$id_search  ])->asArray()->all();
                    break;
                default:
                    $id_search1 = Belong::find()->select('id_object')->where('id_ling_term ='.$this->id2. ' and own >='.  $this->koef2)
                        ->andWhere(['id_object'=>$id_search  ])->asArray()->all();
                    break;
            }

            return  array_column($id_search1,'id_object');
        }else {  if($this->and_or==2)
        {
            switch ($this->kvant2) {
                case 1 :
                    $id_search1 = Belong::find()->select('id_object')->where('id_ling_term ='.$this->id2. ' and 1-own>='.  $this->koef2)
                        ->orWhere(['id_object'=>$id_search  ])->asArray()->all();
                    break;
                case 2:
                    $id_search1 = Belong::find()->select('id_object')->where('id_ling_term ='.$this->id2. ' and own*own >= '.  $this->koef2)
                        ->orWhere(['id_object'=>$id_search   ])->asArray()->all();
                    break;
                case 3:
                    $id_search1 = Belong::find()->select('id_object')->where('id_ling_term ='.$this->id2. ' and sqrt(own) >='.  $this->koef2)
                        ->orWhere(['id_object'=>$id_search  ])->asArray()->all();
                    break;
                default:
                    $id_search1 = Belong::find()->select('id_object')->where('id_ling_term ='.$this->id2. ' and own >='.  $this->koef2)
                        ->orWhere(['id_object'=>$id_search   ])->asArray()->all();
                    break;
            }
            return array_column($id_search1,'id_object');
        }else{
            return $id_search;
        }
        }

    }







}