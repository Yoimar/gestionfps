<?php

namespace app\models;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

use Yii;

/**
 * This is the model class for table "bitacoras".
 *
 * @property integer $id
 * @property integer $solicitud_id
 * @property string $fecha
 * @property string $nota
 * @property integer $usuario_id
 * @property boolean $ind_activo
 * @property boolean $ind_alarma
 * @property boolean $ind_atendida
 * @property integer $version
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Solicitudes $solicitud
 * @property Users $usuario
 */
class Bitacoras extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bitacoras';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['solicitud_id', 'fecha', 'nota', 'usuario_id', 'created_at', 'updated_at'], 'required'],
            [['solicitud_id', 'usuario_id', 'version'], 'integer'],
            [['fecha', 'created_at', 'updated_at'], 'safe'],
            [['ind_activo', 'ind_alarma', 'ind_atendida'], 'boolean'],
            [['nota'], 'string', 'max' => 1500],
            [['solicitud_id'], 'exist', 'skipOnError' => true, 'targetClass' => Solicitudes::className(), 'targetAttribute' => ['solicitud_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'solicitud_id' => 'Solicitud ID',
            'fecha' => 'Fecha',
            'nota' => 'Nota',
            'usuario_id' => 'Usuario ID',
            'ind_activo' => 'Ind Activo',
            'ind_alarma' => 'Ind Alarma',
            'ind_atendida' => 'Ind Atendida',
            'version' => 'Version',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
    public function getUsuario()
    {
        return $this->hasOne(Users::className(), ['id' => 'usuario_id']);
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    
                ],
                'value' => date('Y-m-d H:i:s'),
            ],

        ];
    }
    
    public function cargardefecto($model){
        $model->fecha = date('Y-m-d');
        $model->ind_activo = 1;
        $model->ind_alarma = 0;
        $model->ind_atendida = 0;
        $model->version = 0;
        $model->created_at = date('Y-m-d H:i:s');
        $model->updated_at = date('Y-m-d H:i:s');
        return $model;
    }

}
