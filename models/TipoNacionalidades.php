<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_nacionalidades".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $version
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Personas[] $personas
 */
class TipoNacionalidades extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_nacionalidades';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'created_at', 'updated_at'], 'required'],
            [['version'], 'integer'],
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
        return $this->hasMany(Personas::className(), ['tipo_nacionalidad_id' => 'id']);
    }
}
