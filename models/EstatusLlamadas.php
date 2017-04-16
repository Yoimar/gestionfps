<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estatus_llamadas".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property Llamada[] $llamadas
 */
class EstatusLlamadas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estatus_llamadas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLlamadas()
    {
        return $this->hasMany(Llamada::className(), ['estatusllamada_id' => 'id']);
    }
}
