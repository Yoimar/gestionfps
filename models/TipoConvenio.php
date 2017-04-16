<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_convenio".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property Convenio[] $convenios
 */
class TipoConvenio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_convenio';
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
    public function getConvenios()
    {
        return $this->hasMany(Convenio::className(), ['tipoconvenio_id' => 'id']);
    }
}
