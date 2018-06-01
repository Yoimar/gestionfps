<?php

namespace app\models;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

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
    public $estado_id;
    public $municipio_id;
    public $dateprograma;

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
            [['trabajadoracargo_id', 'referencia_id', 'parroquia_id', 'descripcion', 'fechaprograma'], 'required'],
            [['fechaprograma', 'fecharecibido', 'dateprograma', 'created_at', 'updated_at'], 'safe'],
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
            'origenid' => 'Origen',
            'nprograma' => 'Nro de Programa / Oficio',
            'fechaprograma' => 'Fecha de la Actividad',
            'dateprograma' => 'Fecha',
            'trabajadoracargo_id' => 'Trabajador a Cargo',
            'referencia_id' => 'Referencia - Autoridad y Cargo',
            'parroquia_id' => 'Parroquia',
            'descripcion' => 'Actividad o Programa',
            'fecharecibido' => 'Fecha de Recepción',
            'estado_id'=>'Estado',
            'municipio_id'=>'Municipio',
            'created_at' => 'Creado el Día',
            'created_by' => 'Creado Por',
            'updated_at' => 'Actualizado el Día',
            'updated_by' => 'Actualizado Por',
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
    public function getTrabajador()
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

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],

        ];
    }

    public function getCreadoprogramapor()
    {
        return $this->hasOne(Trabajador::className(), ['user_id' => 'created_by']);
    }

    public function getActualizadoprogramapor()
    {
        return $this->hasOne(Trabajador::className(), ['user_id' => 'updated_by']);
    }

    public function getEstado()
    {
        return $this->hasOne(Estados::className(), ['id' => 'estado_id'])
          ->via('municipio');
    }

    public function getMunicipio()
    {
        return $this->hasOne(Municipios::className(), ['id' => 'municipio_id'])
          ->via('parroquia');
    }



}
