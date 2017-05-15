<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_requerimientos".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property integer $version
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Requerimientos[] $requerimientos
 */
class Tiporequerimientos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_requerimientos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'created_at', 'updated_at'], 'required'],
            [['descripcion'], 'string'],
            [['version'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 100],
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
            'descripcion' => 'Descripcion',
            'version' => 'Version',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequerimientos()
    {
        return $this->hasMany(Requerimientos::className(), ['tipo_requerimiento_id' => 'id']);
    }
}
