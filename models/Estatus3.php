<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estatus3".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $dim
 * @property integer $estatus2_id
 * @property integer $version
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property Estatus2 $estatus2
 * @property Gestion[] $gestions
 * @property HistorialSolicitudes[] $historialSolicitudes
 */
class Estatus3 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estatus3';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['estatus2_id', 'version', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 60],
            [['dim'], 'string', 'max' => 5],
            [['estatus2_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus2::className(), 'targetAttribute' => ['estatus2_id' => 'id']],
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
            'dim' => 'Dim',
            'estatus2_id' => 'Estatus2 ID',
            'version' => 'Version',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
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
    public function getGestions()
    {
        return $this->hasMany(Gestion::className(), ['estatus3_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistorialSolicitudes()
    {
        return $this->hasMany(HistorialSolicitudes::className(), ['estatus3_id' => 'id']);
    }
}
