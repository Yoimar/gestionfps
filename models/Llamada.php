<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "llamada".
 *
 * @property integer $id
 * @property integer $estatusllamada_id
 * @property string $fechallamada
 * @property string $observacion
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property integer $solicitud_id
 * @property string $numsolicitud_id
 *
 * @property EstatusLlamadas $estatusllamada
 * @property Solicitudes $solicitud
 */
class Llamada extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'llamada';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['estatusllamada_id', 'created_by', 'updated_by', 'solicitud_id'], 'integer'],
            [['fechallamada', 'created_at', 'updated_at'], 'safe'],
            [['observacion'], 'string', 'max' => 1000],
            [['numsolicitud_id'], 'string', 'max' => 8],
            [['estatusllamada_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstatusLlamadas::className(), 'targetAttribute' => ['estatusllamada_id' => 'id']],
            [['solicitud_id'], 'exist', 'skipOnError' => true, 'targetClass' => Solicitudes::className(), 'targetAttribute' => ['solicitud_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'estatusllamada_id' => 'Estatusllamada ID',
            'fechallamada' => 'Fechallamada',
            'observacion' => 'Observacion',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'solicitud_id' => 'Solicitud ID',
            'numsolicitud_id' => 'Numsolicitud ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstatusllamada()
    {
        return $this->hasOne(EstatusLlamadas::className(), ['id' => 'estatusllamada_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitud()
    {
        return $this->hasOne(Solicitudes::className(), ['id' => 'solicitud_id']);
    }
}
