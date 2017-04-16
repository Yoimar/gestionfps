<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estatussasyc".
 *
 * @property string $id
 * @property string $estatus
 */
class Estatussasyc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estatussasyc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'string', 'max' => 3],
            [['estatus'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'estatus' => 'Estatus',
        ];
    }
}
