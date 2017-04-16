<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estatus1".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $dim
 * @property integer $version
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property Estatus2[] $estatus2s
 */
class Estatus1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estatus1';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['version', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 60],
            [['dim'], 'string', 'max' => 5],
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
    public function getEstatus2s()
    {
        return $this->hasMany(Estatus2::className(), ['estatus1_id' => 'id']);
    }
}
