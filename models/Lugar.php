<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lugar".
 *
 * @property int $id
 * @property string $nombre
 * @property int $centro_clasificacion_id
 * @property string $google_place_gps
 * @property string $nombre_slug
 * @property int $parroquia_id
 * @property string $direccion
 * @property string $telefono1
 * @property string $telefono2
 * @property string $telefono3
 * @property string $notas
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 *
 * @property CentroClasificacion $centroClasificacion
 * @property Parroquias $parroquia
 * @property User $createdBy
 * @property User $updatedBy
 */
class Lugar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lugar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'centro_clasificacion_id', 'google_place_gps', 'parroquia_id'], 'required'],
            [['centro_clasificacion_id', 'parroquia_id', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['centro_clasificacion_id', 'parroquia_id', 'created_by', 'updated_by'], 'integer'],
            [['google_place_gps', 'nombre_slug', 'notas'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 200],
            [['direccion'], 'string', 'max' => 500],
            [['telefono1', 'telefono2', 'telefono3'], 'string', 'max' => 12],
            [['nombre_slug'], 'unique'],
            [['centro_clasificacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Centroclasificacion::className(), 'targetAttribute' => ['centro_clasificacion_id' => 'id']],
            [['parroquia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Parroquias::className(), 'targetAttribute' => ['parroquia_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
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
            'centro_clasificacion_id' => 'Centro Clasificacion ID',
            'google_place_gps' => 'Google Place Gps',
            'nombre_slug' => 'Nombre Slug',
            'parroquia_id' => 'Parroquia ID',
            'direccion' => 'Direccion',
            'telefono1' => 'Telefono1',
            'telefono2' => 'Telefono2',
            'telefono3' => 'Telefono3',
            'notas' => 'Notas',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCentroClasificacion()
    {
        return $this->hasOne(CentroClasificacion::className(), ['id' => 'centro_clasificacion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParroquia()
    {
        return $this->hasOne(Parroquias::className(), ['id' => 'parroquia_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
