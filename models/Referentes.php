<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "referentes".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $cargo
 * @property integer $version
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Solicitudes[] $solicitudes
 */
class Referentes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'referentes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'cargo', 'created_at', 'updated_at'], 'required'],
            [['version'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre', 'cargo'], 'string', 'max' => 200],
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
            'cargo' => 'Cargo',
            'version' => 'Version',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudes()
    {
        return $this->hasMany(Solicitudes::className(), ['referente_id' => 'id']);
    }
}
