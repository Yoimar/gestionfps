<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "areas".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property integer $tipo_ayuda_id
 * @property integer $version
 * @property string $created_at
 * @property string $updated_at
 *
 * @property TipoAyudas $tipoAyuda
 * @property Solicitudes[] $solicitudes
 * @property SolicitudesRecibidas[] $solicitudesRecibidas
 */
class Areas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'areas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'tipo_ayuda_id', 'created_at', 'updated_at'], 'required'],
            [['tipo_ayuda_id', 'version'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 500],
            [['tipo_ayuda_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoAyudas::className(), 'targetAttribute' => ['tipo_ayuda_id' => 'id']],
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
            'descripcion' => 'Descripcion',
            'tipo_ayuda_id' => 'Tipo Ayuda ID',
            'version' => 'Version',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoAyuda()
    {
        return $this->hasOne(TipoAyudas::className(), ['id' => 'tipo_ayuda_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudes()
    {
        return $this->hasMany(Solicitudes::className(), ['area_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudesRecibidas()
    {
        return $this->hasMany(SolicitudesRecibidas::className(), ['area_id' => 'id']);
    }
}
