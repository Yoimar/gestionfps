<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "niveles_academicos".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $orden
 * @property integer $version
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Personas[] $personas
 */
class NivelesAcademicos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'niveles_academicos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'orden', 'created_at', 'updated_at'], 'required'],
            [['orden', 'version'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 200],
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
            'orden' => 'Orden',
            'version' => 'Version',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas()
    {
        return $this->hasMany(Personas::className(), ['nivel_academico_id' => 'id']);
    }
}
