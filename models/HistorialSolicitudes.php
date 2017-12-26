<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "historial_solicitudes".
 *
 * @property integer $id
 * @property integer $solicitud_id
 * @property integer $estatus3_id
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property integer $gestion_id
 * @property integer $estatus2_id
 * @property integer $estatus1_id
 * @property integer $memogestion_id
 *
 * @property Estatus1 $estatus1
 * @property Estatus2 $estatus2
 * @property Estatus3 $estatus3
 * @property Gestion $gestion
 * @property Memosgestion $memogestion
 * @property Solicitudes $solicitud
 */
class Historialsolicitudes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'historial_solicitudes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['solicitud_id', 'estatus3_id', 'created_by', 'updated_by', 'gestion_id', 'estatus2_id', 'estatus1_id', 'memogestion_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['estatus1_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus1::className(), 'targetAttribute' => ['estatus1_id' => 'id']],
            [['estatus2_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus2::className(), 'targetAttribute' => ['estatus2_id' => 'id']],
            [['estatus3_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus3::className(), 'targetAttribute' => ['estatus3_id' => 'id']],
            [['gestion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gestion::className(), 'targetAttribute' => ['gestion_id' => 'id']],
            [['memogestion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Memosgestion::className(), 'targetAttribute' => ['memogestion_id' => 'id']],
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
            'solicitud_id' => 'Solicitud ID',
            'estatus3_id' => 'Estatus3 ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'gestion_id' => 'Gestion ID',
            'estatus2_id' => 'Estatus2 ID',
            'estatus1_id' => 'Estatus1 ID',
            'memogestion_id' => 'Memogestion ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstatus1()
    {
        return $this->hasOne(Estatus1::className(), ['id' => 'estatus1_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstatus2()
    {
        return $this->hasOne(Estatus2::className(), ['id' => 'estatus2_id']);
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
    public function getGestion()
    {
        return $this->hasOne(Gestion::className(), ['id' => 'gestion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemogestion()
    {
        return $this->hasOne(Memosgestion::className(), ['id' => 'memogestion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitud()
    {
        return $this->hasOne(Solicitudes::className(), ['id' => 'solicitud_id']);
    }
}
