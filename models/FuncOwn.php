<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "func_own".
 *
 * @property string $id
 * @property string $name
 *
 * @property LingTerm[] $lingTerms
 */
class FuncOwn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'func_own';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLingTerms()
    {
        return $this->hasMany(LingTerm::className(), ['id_func_own' => 'id']);
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
}
