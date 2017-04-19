<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "programaevento".
 *
 * @property integer $id
 * @property integer $origenid
 * @property integer $nprograma
 * @property string $fechaprograma
 * @property integer $trabajadoracargo_id
 * @property integer $referencia_id
 * @property integer $parroquia_id
 * @property string $descripcion
 * @property string $fecharecibido
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property Gestion[] $gestions
 * @property Origen $origen
 * @property Parroquias $parroquia
 * @property Referencia $referencia
 * @property Trabajador $trabajadoracargo
 * @property SolicitudesRecibidas[] $solicitudesRecibidas
 */
class Programaevento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'programaevento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['origenid', 'nprograma', 'trabajadoracargo_id', 'referencia_id', 'parroquia_id', 'created_by', 'updated_by'], 'integer'],
            [['fechaprograma', 'fecharecibido', 'created_at', 'updated_at'], 'safe'],
            [['descripcion'], 'string', 'max' => 255],
            [['origenid'], 'exist', 'skipOnError' => true, 'targetClass' => Origen::className(), 'targetAttribute' => ['origenid' => 'id']],
            [['parroquia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Parroquias::className(), 'targetAttribute' => ['parroquia_id' => 'id']],
            [['referencia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Referencia::className(), 'targetAttribute' => ['referencia_id' => 'id']],
            [['trabajadoracargo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Trabajador::className(), 'targetAttribute' => ['trabajadoracargo_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'origenid' => 'Origenid',
            'nprograma' => 'Nprograma',
            'fechaprograma' => 'Fechaprograma',
            'trabajadoracargo_id' => 'Trabajadoracargo ID',
            'referencia_id' => 'Referencia ID',
            'parroquia_id' => 'Parroquia ID',
            'descripcion' => 'Descripcion',
            'fecharecibido' => 'Fecharecibido',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGestions()
    {
        return $this->hasMany(Gestion::className(), ['programaevento_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrigen()
    {
        return $this->hasOne(Origen::className(), ['id' => 'origenid']);
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
    public function getReferencia()
    {
        return $this->hasOne(Referencia::className(), ['id' => 'referencia_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrabajadoracargo()
    {
        return $this->hasOne(Trabajador::className(), ['id' => 'trabajadoracargo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudesRecibidas()
    {
        return $this->hasMany(SolicitudesRecibidas::className(), ['programaevento_id' => 'id']);
    }
}
