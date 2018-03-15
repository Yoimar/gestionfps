<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "centro_tipo".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property Centro[] $centros
 */
class Centrotipo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'centro_tipo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'nombre' => 'Tipo de Centro',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCentros()
    {
        return $this->hasMany(Centro::className(), ['centro_tipo_id' => 'id']);
    }
}
