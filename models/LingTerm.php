<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ling_term".
 *
 * @property string $id
 * @property string $name
 * @property string $id_func_own
 * @property string $id_ling_var
 * @property int $a
 * @property int $b
 * @property int $c
 * @property int $d
 *
 * @property Belong[] $belongs
 * @property LingVar $lingVar
 * @property FuncOwn $funcOwn
 */
class LingTerm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ling_term';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_func_own', 'id_ling_var', 'a', 'b',], 'required'],
            [['c','d'],'safe'],
            [['name'], 'string', 'max' => 50],
            [['id_ling_var'], 'exist', 'skipOnError' => true, 'targetClass' => LingVar::className(), 'targetAttribute' => ['id_ling_var' => 'id']],
            [['id_func_own'], 'exist', 'skipOnError' => true, 'targetClass' => FuncOwn::className(), 'targetAttribute' => ['id_func_own' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название термы',
            'id_func_own' => 'Функция принадлежности',
            'id_ling_var' => 'Лингвистическая переменная',
            'a' => 'A',
            'b' => 'B',
            'c' => 'C',
            'd' => 'D',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBelongs()
    {
        return $this->hasMany(Belong::className(), ['id_ling_term' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLingVar()
    {
        return $this->hasOne(LingVar::className(), ['id' => 'id_ling_var']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFuncOwn()
    {
        return $this->hasOne(FuncOwn::className(), ['id' => 'id_func_own']);
    }

    public static function dropdown()
    {
        static $dropdown;
        if ($dropdown === null) {
            $models = static::find()->all();
            foreach ($models as $model) {
                $dropdown[$model->id] = $model->name;
            }
        }
        return $dropdown;
    }
}
