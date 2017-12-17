<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "recepciones".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $version
 * @property string $created_at
 * @property string $updated_at
 * @property integer $departamento_id
 *
 * @property Gestion[] $gestions
 * @property Recepciones $departamento
 * @property Recepciones[] $recepciones
 * @property Solicitudes[] $solicitudes
 */
class Recepciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recepciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'created_at', 'updated_at'], 'required'],
            [['version', 'departamento_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 200],
            [['departamento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Recepciones::className(), 'targetAttribute' => ['departamento_id' => 'id']],
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
            'version' => 'Version',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'departamento_id' => 'Departamento ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGestions()
    {
        return $this->hasMany(Gestion::className(), ['recepcion_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamento()
    {
        return $this->hasOne(Recepciones::className(), ['id' => 'departamento_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecepciones()
    {
        return $this->hasMany(Recepciones::className(), ['departamento_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudes()
    {
        return $this->hasMany(Solicitudes::className(), ['recepcion_id' => 'id']);
    }
}
