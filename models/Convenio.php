<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "convenio".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $dimnombre
 * @property integer $tipoconvenio_id
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property TipoConvenio $tipoconvenio
 * @property Gestion[] $gestions
 */
class Convenio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'convenio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipoconvenio_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 50],
            [['dimnombre'], 'string', 'max' => 10],
            [['tipoconvenio_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoConvenio::className(), 'targetAttribute' => ['tipoconvenio_id' => 'id']],
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
            'dimnombre' => 'Dimnombre',
            'tipoconvenio_id' => 'Tipoconvenio ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoconvenio()
    {
        return $this->hasOne(TipoConvenio::className(), ['id' => 'tipoconvenio_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGestions()
    {
        return $this->hasMany(Gestion::className(), ['convenio_id' => 'id']);
    }
}
