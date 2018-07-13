<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ling_var".
 *
 * @property string $id
 * @property string $name
 * @property string $range_left
 * @property string $range_right
 *
 * @property LingTerm[] $lingTerms
 */
class LingVar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ling_var';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['range_left', 'range_right'], 'number'],
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
            'range_left' => 'Range Left',
            'range_right' => 'Range Right',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLingTerms()
    {
        return $this->hasMany(LingTerm::className(), ['id_ling_var' => 'id']);
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
