<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "streets".
 *
 * @property string $id
 * @property string $name
 * @property string $id_city
 *
 * @property Object[] $objects
 * @property Cities $city
 */
class Streets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'streets';
    }

    public static function dropdown()
    {
        static $dropdown;
        if($dropdown===null)
        {
            $models = static::find()->all();

            foreach ($models as $model)
            {
                $dropdown[$model->id] = $model->name;
            }
        }
        return $dropdown;
    }

    public function ListStreets($id)
    {

        $street = Streets::find()->where(['id_city'=>$id])->orderBy('id DESC')->all();
        $ret[]="";
        foreach($street as $result)  $ret[$result->id] = $result->name;
        return $ret;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'id_city'], 'required'],
            [['id_city'], 'integer'],
            [['name'], 'string', 'max' => 70],
            [['id_city'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['id_city' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'id_city' => 'Город',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjects()
    {
        return $this->hasMany(Object::className(), ['id_street' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'id_city']);
    }
}
