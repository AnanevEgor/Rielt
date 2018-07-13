<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "belong".
 *
 * @property string $id
 * @property string $id_ling_term
 * @property string $id_object
 * @property string $own
 *
 * @property LingTerm $lingTerm
 * @property Object $object
 */
class Belong extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'belong';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ling_term', 'id_object'], 'integer'],
            [['own'], 'number'],
            [['id_ling_term'], 'exist', 'skipOnError' => true, 'targetClass' => LingTerm::className(), 'targetAttribute' => ['id_ling_term' => 'id']],
            [['id_object'], 'exist', 'skipOnError' => true, 'targetClass' => Object::className(), 'targetAttribute' => ['id_object' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ling_term' => 'Id Ling Term',
            'id_object' => 'Id Object',
            'own' => 'Own',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLingTerm()
    {
        return $this->hasOne(LingTerm::className(), ['id' => 'id_ling_term']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(Object::className(), ['id' => 'id_object']);
    }
}
