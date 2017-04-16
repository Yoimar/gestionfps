<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "organismos".
 *
 * @property integer $id
 * @property string $nombre
 * @property boolean $ind_externo
 * @property integer $version
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Solicitudes[] $solicitudes
 */
class Organismos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organismos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'created_at', 'updated_at'], 'required'],
            [['ind_externo'], 'boolean'],
            [['version'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 200],
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
            'ind_externo' => 'Ind Externo',
            'version' => 'Version',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudes()
    {
        return $this->hasMany(Solicitudes::className(), ['organismo_id' => 'id']);
    }
}
