<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sep_dt_concepto".
 *
 * @property string $codemp
 * @property string $numsol
 * @property string $codconsep
 * @property string $codestpro1
 * @property string $codestpro2
 * @property string $codestpro3
 * @property string $codestpro4
 * @property string $codestpro5
 * @property string $estcla
 * @property string $spg_cuenta
 * @property string $codfuefin
 * @property string $codcencos
 * @property double $cancon
 * @property double $monpre
 * @property double $moncon
 * @property integer $orden
 *
 * @property SepConceptos $codemp0
 * @property SepSolicitud $codemp1
 * @property SigespCencosto $codemp2
 * @property SpgEp5 $codemp3
 * @property SepDtcCargos[] $sepDtcCargos
 * @property SigespCargos[] $codemps
 */
class Sepdtconcepto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sep_dt_concepto';
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
            [['codemp', 'numsol', 'codconsep', 'orden'], 'required'],
            [['cancon', 'monpre', 'moncon'], 'number'],
            [['orden'], 'integer'],
            [['codemp'], 'string', 'max' => 4],
            [['numsol'], 'string', 'max' => 15],
            [['codconsep'], 'string', 'max' => 5],
            [['codestpro1', 'codestpro2', 'codestpro3', 'codestpro4', 'codestpro5', 'spg_cuenta'], 'string', 'max' => 25],
            [['estcla'], 'string', 'max' => 1],
            [['codfuefin'], 'string', 'max' => 2],
            [['codcencos'], 'string', 'max' => 3],
            [['codemp', 'codconsep'], 'exist', 'skipOnError' => true, 'targetClass' => SepConceptos::className(), 'targetAttribute' => ['codemp' => 'codemp', 'codconsep' => 'codconsep']],
            [['codemp', 'numsol'], 'exist', 'skipOnError' => true, 'targetClass' => SepSolicitud::className(), 'targetAttribute' => ['codemp' => 'codemp', 'numsol' => 'numsol']],
            [['codemp', 'codcencos'], 'exist', 'skipOnError' => true, 'targetClass' => SigespCencosto::className(), 'targetAttribute' => ['codemp' => 'codemp', 'codcencos' => 'codcencos']],
            [['codemp', 'codestpro1', 'codestpro2', 'codestpro3', 'codestpro4', 'codestpro5', 'estcla'], 'exist', 'skipOnError' => true, 'targetClass' => SpgEp5::className(), 'targetAttribute' => ['codemp' => 'codemp', 'codestpro1' => 'codestpro1', 'codestpro2' => 'codestpro2', 'codestpro3' => 'codestpro3', 'codestpro4' => 'codestpro4', 'codestpro5' => 'codestpro5', 'estcla' => 'estcla']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codemp' => 'Codemp',
            'numsol' => 'Numsol',
            'codconsep' => 'Codconsep',
            'codestpro1' => 'Codestpro1',
            'codestpro2' => 'Codestpro2',
            'codestpro3' => 'Codestpro3',
            'codestpro4' => 'Codestpro4',
            'codestpro5' => 'Codestpro5',
            'estcla' => 'Estcla',
            'spg_cuenta' => 'Spg Cuenta',
            'codfuefin' => 'Codfuefin',
            'codcencos' => 'Codcencos',
            'cancon' => 'Cancon',
            'monpre' => 'Monpre',
            'moncon' => 'Moncon',
            'orden' => 'Orden',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp0()
    {
        return $this->hasOne(SepConceptos::className(), ['codemp' => 'codemp', 'codconsep' => 'codconsep']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp1()
    {
        return $this->hasOne(SepSolicitud::className(), ['codemp' => 'codemp', 'numsol' => 'numsol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp2()
    {
        return $this->hasOne(SigespCencosto::className(), ['codemp' => 'codemp', 'codcencos' => 'codcencos']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp3()
    {
        return $this->hasOne(SpgEp5::className(), ['codemp' => 'codemp', 'codestpro1' => 'codestpro1', 'codestpro2' => 'codestpro2', 'codestpro3' => 'codestpro3', 'codestpro4' => 'codestpro4', 'codestpro5' => 'codestpro5', 'estcla' => 'estcla']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSepDtcCargos()
    {
        return $this->hasMany(SepDtcCargos::className(), ['codemp' => 'codemp', 'numsol' => 'numsol', 'codconsep' => 'codconsep']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemps()
    {
        return $this->hasMany(SigespCargos::className(), ['codemp' => 'codemp', 'codcar' => 'codcar'])->viaTable('sep_dtc_cargos', ['codemp' => 'codemp', 'numsol' => 'numsol', 'codconsep' => 'codconsep']);
    }
}
