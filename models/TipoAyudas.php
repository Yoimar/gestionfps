<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_ayudas".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $cod_acc_int
 * @property integer $version
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Areas[] $areas
 * @property Recaudos[] $recaudos
 * @property Requerimientos[] $requerimientos
 */
class TipoAyudas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_ayudas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'cod_acc_int', 'created_at', 'updated_at'], 'required'],
            [['version'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 500],
            [['cod_acc_int'], 'string', 'max' => 7],
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
            'cod_acc_int' => 'Cod Acc Int',
            'version' => 'Version',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAreas()
    {
        return $this->hasMany(Areas::className(), ['tipo_ayuda_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecaudos()
    {
        return $this->hasMany(Recaudos::className(), ['tipo_ayuda_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequerimientos()
    {
        return $this->hasMany(Requerimientos::className(), ['tipo_ayuda_id' => 'id']);
    }
}
