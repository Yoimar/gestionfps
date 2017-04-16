<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estatus2".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $dim
 * @property integer $estatus1_id
 * @property integer $version
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property Estatus1 $estatus1
 * @property Estatus3[] $estatus3s
 */
class Estatus2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estatus2';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['estatus1_id', 'version', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 60],
            [['dim'], 'string', 'max' => 5],
            [['estatus1_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus1::className(), 'targetAttribute' => ['estatus1_id' => 'id']],
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
            'estatus1_id' => 'Estatus1 ID',
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
    public function getEstatus1()
    {
        return $this->hasOne(Estatus1::className(), ['id' => 'estatus1_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstatus3s()
    {
        return $this->hasMany(Estatus3::className(), ['estatus2_id' => 'id']);
    }
}
