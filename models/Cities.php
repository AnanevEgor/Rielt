<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cities".
 *
 * @property string $id
 * @property string $name
 *
 * @property Object[] $objects
 * @property Streets[] $streets
 */
class Cities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjects()
    {
        return $this->hasMany(Object::className(), ['id_city' => 'id']);
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
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStreets()
    {
        return $this->hasMany(Streets::className(), ['id_city' => 'id']);
    }
}
