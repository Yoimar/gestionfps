<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cod_bancos".
 *
 * @property string $codigo
 * @property string $nombre
 *
 * @property EmpresaInstitucion[] $empresaInstitucions
 */
class Codbancos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cod_bancos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo'], 'required'],
            [['codigo'], 'string', 'max' => 3],
            [['nombre'], 'string', 'max' => 150],
            [['codigo'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresaInstitucions()
    {
        return $this->hasMany(EmpresaInstitucion::className(), ['cod_banco' => 'codigo']);
    }
}
