<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "requerimientos".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $cod_item
 * @property string $cod_cta
 * @property integer $tipo_requerimiento_id
 * @property integer $tipo_ayuda_id
 * @property integer $version
 * @property string $created_at
 * @property string $updated_at
 *
 * @property TipoAyudas $tipoAyuda
 * @property TipoRequerimientos $tipoRequerimiento
 */
class Requerimientos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'requerimientos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'cod_cta', 'tipo_requerimiento_id', 'tipo_ayuda_id', 'created_at', 'updated_at'], 'required'],
            [['tipo_requerimiento_id', 'tipo_ayuda_id', 'version'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre', 'descripcion'], 'string', 'max' => 500],
            [['cod_item'], 'string', 'max' => 10],
            [['cod_cta'], 'string', 'max' => 14],
            [['tipo_ayuda_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoAyudas::className(), 'targetAttribute' => ['tipo_ayuda_id' => 'id']],
            [['tipo_requerimiento_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoRequerimientos::className(), 'targetAttribute' => ['tipo_requerimiento_id' => 'id']],
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
            'cod_item' => 'Cod Item',
            'cod_cta' => 'Cod Cta',
            'tipo_requerimiento_id' => 'Tipo Requerimiento ID',
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
    public function getTipoRequerimiento()
    {
        return $this->hasOne(TipoRequerimientos::className(), ['id' => 'tipo_requerimiento_id']);
    }
}
