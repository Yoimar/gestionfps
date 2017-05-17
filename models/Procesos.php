<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "procesos".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $defeventosasyc_id
 * @property boolean $ind_cantidad
 * @property boolean $ind_monto
 * @property boolean $ind_beneficiario
 * @property integer $version
 * @property string $created_at
 * @property string $updated_at
 */
class Procesos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'procesos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'created_at', 'updated_at'], 'required'],
            [['defeventosasyc_id', 'version'], 'integer'],
            [['ind_cantidad', 'ind_monto', 'ind_beneficiario'], 'boolean'],
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
            'defeventosasyc_id' => 'Defeventosasyc ID',
            'ind_cantidad' => 'Ind Cantidad',
            'ind_monto' => 'Ind Monto',
            'ind_beneficiario' => 'Ind Beneficiario',
            'version' => 'Version',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
