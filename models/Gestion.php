<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gestion".
 *
 * @property integer $id
 * @property integer $programaevento_id
 * @property integer $solicitud_id
 * @property integer $convenio_id
 * @property integer $estatus3_id
 * @property string $militar
 * @property string $afrodescendiente
 * @property string $indigena
 * @property string $sexodiversidad
 * @property integer $trabajador_id
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property integer $tipodecontacto_id
 *
 * @property Convenio $convenio
 * @property Estatus3 $estatus3
 * @property Programaevento $programaevento
 * @property Solicitudes $solicitud
 * @property Tipodecontacto $tipodecontacto
 * @property Trabajador $trabajador
 */
class Gestion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gestion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['programaevento_id', 'solicitud_id', 'convenio_id', 'estatus3_id', 'trabajador_id', 'created_by', 'updated_by', 'tipodecontacto_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['militar', 'afrodescendiente', 'indigena', 'sexodiversidad'], 'string', 'max' => 2],
            [['convenio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Convenio::className(), 'targetAttribute' => ['convenio_id' => 'id']],
            [['estatus3_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus3::className(), 'targetAttribute' => ['estatus3_id' => 'id']],
            [['programaevento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Programaevento::className(), 'targetAttribute' => ['programaevento_id' => 'id']],
            [['solicitud_id'], 'exist', 'skipOnError' => true, 'targetClass' => Solicitudes::className(), 'targetAttribute' => ['solicitud_id' => 'id']],
            [['tipodecontacto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tipodecontacto::className(), 'targetAttribute' => ['tipodecontacto_id' => 'id']],
            [['trabajador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Trabajador::className(), 'targetAttribute' => ['trabajador_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'programaevento_id' => 'Programaevento ID',
            'solicitud_id' => 'Solicitud ID',
            'convenio_id' => 'Convenio ID',
            'estatus3_id' => 'Estatus3 ID',
            'militar' => 'Militar',
            'afrodescendiente' => 'Afrodescendiente',
            'indigena' => 'Indigena',
            'sexodiversidad' => 'Sexodiversidad',
            'trabajador_id' => 'Trabajador ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'tipodecontacto_id' => 'Tipodecontacto ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConvenio()
    {
        return $this->hasOne(Convenio::className(), ['id' => 'convenio_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstatus3()
    {
        return $this->hasOne(Estatus3::className(), ['id' => 'estatus3_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramaevento()
    {
        return $this->hasOne(Programaevento::className(), ['id' => 'programaevento_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitud()
    {
        return $this->hasOne(Solicitudes::className(), ['id' => 'solicitud_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipodecontacto()
    {
        return $this->hasOne(Tipodecontacto::className(), ['id' => 'tipodecontacto_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrabajador()
    {
        return $this->hasOne(Trabajador::className(), ['id' => 'trabajador_id']);
    }
}
