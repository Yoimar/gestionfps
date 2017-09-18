<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sep_conceptos".
 *
 * @property string $codemp
 * @property string $codconsep
 * @property string $denconsep
 * @property double $monconsepe
 * @property string $obsconesp
 * @property string $spg_cuenta
 *
 * @property SepConceptocargos[] $sepConceptocargos
 * @property SigespCargos[] $codemps
 * @property SigespEmpresa $codemp0
 * @property SepDtConcepto[] $sepDtConceptos
 * @property SepSolicitud[] $codemps0
 */
class Sepconceptos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sep_conceptos';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbsigesp');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codemp', 'codconsep'], 'required'],
            [['monconsepe'], 'number'],
            [['obsconesp'], 'string'],
            [['codemp'], 'string', 'max' => 4],
            [['codconsep'], 'string', 'max' => 5],
            [['denconsep'], 'string', 'max' => 254],
            [['spg_cuenta'], 'string', 'max' => 25],
            [['codemp'], 'exist', 'skipOnError' => true, 'targetClass' => SigespEmpresa::className(), 'targetAttribute' => ['codemp' => 'codemp']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codemp' => 'Codemp',
            'codconsep' => 'Codconsep',
            'denconsep' => 'Denconsep',
            'monconsepe' => 'Monconsepe',
            'obsconesp' => 'Obsconesp',
            'spg_cuenta' => 'Spg Cuenta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSepConceptocargos()
    {
        return $this->hasMany(SepConceptocargos::className(), ['codemp' => 'codemp', 'codconsep' => 'codconsep']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemps()
    {
        return $this->hasMany(SigespCargos::className(), ['codemp' => 'codemp', 'codcar' => 'codcar'])->viaTable('sep_conceptocargos', ['codemp' => 'codemp', 'codconsep' => 'codconsep']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp0()
    {
        return $this->hasOne(SigespEmpresa::className(), ['codemp' => 'codemp']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSepDtConceptos()
    {
        return $this->hasMany(SepDtConcepto::className(), ['codemp' => 'codemp', 'codconsep' => 'codconsep']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemps0()
    {
        return $this->hasMany(SepSolicitud::className(), ['codemp' => 'codemp', 'numsol' => 'numsol'])->viaTable('sep_dt_concepto', ['codemp' => 'codemp', 'codconsep' => 'codconsep']);
    }
}
