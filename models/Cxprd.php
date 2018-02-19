<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cxp_rd".
 *
 * @property string $codemp
 * @property string $numrecdoc
 * @property string $codtipdoc
 * @property string $ced_bene
 * @property string $cod_pro ID interno de proveedor
 * @property string $codcla
 * @property string $dencondoc
 * @property string $fecemidoc
 * @property string $fecregdoc
 * @property string $fecvendoc
 * @property double $montotdoc
 * @property double $mondeddoc
 * @property double $moncardoc
 * @property string $tipproben
 * @property string $numref
 * @property string $estprodoc
 * @property string $procede
 * @property int $estlibcom
 * @property int $estaprord
 * @property string $fecaprord
 * @property string $usuaprord
 * @property double $numpolcon
 * @property int $estimpmun
 * @property double $montot
 * @property string $codfuefin
 * @property string $codrecdoc
 * @property string $fechaconta
 * @property string $fechaanula
 * @property string $coduniadm
 * @property string $codestpro1
 * @property string $codestpro2
 * @property string $codestpro3
 * @property string $codestpro4
 * @property string $codestpro5
 * @property string $estcla
 * @property string $codcencos
 * @property string $estact
 * @property string $numordpagmin
 * @property string $codtipfon
 * @property string $repcajchi
 * @property string $codproalt
 * @property string $conanurd
 * @property string $codusureg
 * @property string $tipdoctesnac
 * @property string $numexprel
 * @property string $estretasu
 *
 * @property CxpDtAmortizacion[] $cxpDtAmortizacions
 * @property CxpDtSolicitudes[] $cxpDtSolicitudes
 * @property CxpSolicitudes[] $codemps
 * @property CxpHistoricoRd[] $cxpHistoricoRds
 * @property CxpClasificadorRd $codemp0
 * @property CxpDocumento $codemp1
 * @property RpcBeneficiario $codemp2
 * @property RpcProveedor $codemp3
 * @property SigespCencosto $codemp4
 * @property SigespEmpresa $codemp5
 * @property SigespFuentefinanciamiento $codemp6
 * @property SpgDtUnidadadministrativa $codemp7
 * @property CxpRdAmortizacion[] $cxpRdAmortizacions
 * @property CxpRdCargos[] $cxpRdCargos
 * @property CxpRdDeducciones[] $cxpRdDeducciones
 * @property CxpRdScg[] $cxpRdScgs
 * @property CxpRdSpg[] $cxpRdSpgs
 * @property CxpSolicitudesScg[] $cxpSolicitudesScgs
 */
class Cxprd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cxp_rd';
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
            [['codemp', 'numrecdoc', 'codtipdoc', 'ced_bene', 'cod_pro', 'dencondoc', 'tipproben', 'numref', 'estprodoc', 'procede'], 'required'],
            [['dencondoc', 'conanurd'], 'string'],
            [['fecemidoc', 'fecregdoc', 'fecvendoc', 'fecaprord', 'fechaconta', 'fechaanula'], 'safe'],
            [['montotdoc', 'mondeddoc', 'moncardoc', 'numpolcon', 'montot'], 'number'],
            [['estlibcom', 'estaprord', 'estimpmun'], 'default', 'value' => null],
            [['estlibcom', 'estaprord', 'estimpmun'], 'integer'],
            [['codemp', 'codtipfon'], 'string', 'max' => 4],
            [['numrecdoc', 'codrecdoc', 'numordpagmin'], 'string', 'max' => 15],
            [['codtipdoc'], 'string', 'max' => 5],
            [['ced_bene', 'cod_pro', 'coduniadm', 'codproalt', 'numexprel'], 'string', 'max' => 10],
            [['codcla', 'codfuefin'], 'string', 'max' => 2],
            [['tipproben', 'estprodoc', 'estcla', 'estact', 'repcajchi', 'tipdoctesnac', 'estretasu'], 'string', 'max' => 1],
            [['numref'], 'string', 'max' => 20],
            [['procede'], 'string', 'max' => 6],
            [['usuaprord'], 'string', 'max' => 60],
            [['codestpro1', 'codestpro2', 'codestpro3', 'codestpro4', 'codestpro5'], 'string', 'max' => 25],
            [['codcencos'], 'string', 'max' => 3],
            [['codusureg'], 'string', 'max' => 50],
            [['codemp', 'numrecdoc', 'codtipdoc', 'ced_bene', 'cod_pro'], 'unique', 'targetAttribute' => ['codemp', 'numrecdoc', 'codtipdoc', 'ced_bene', 'cod_pro']],
            [['codemp', 'codcla'], 'exist', 'skipOnError' => true, 'targetClass' => CxpClasificadorRd::className(), 'targetAttribute' => ['codemp' => 'codemp', 'codcla' => 'codcla']],
            [['codemp', 'codtipdoc'], 'exist', 'skipOnError' => true, 'targetClass' => CxpDocumento::className(), 'targetAttribute' => ['codemp' => 'codemp', 'codtipdoc' => 'codtipdoc']],
            [['codemp', 'ced_bene'], 'exist', 'skipOnError' => true, 'targetClass' => RpcBeneficiario::className(), 'targetAttribute' => ['codemp' => 'codemp', 'ced_bene' => 'ced_bene']],
            [['codemp', 'cod_pro'], 'exist', 'skipOnError' => true, 'targetClass' => RpcProveedor::className(), 'targetAttribute' => ['codemp' => 'codemp', 'cod_pro' => 'cod_pro']],
            [['codemp', 'codcencos'], 'exist', 'skipOnError' => true, 'targetClass' => SigespCencosto::className(), 'targetAttribute' => ['codemp' => 'codemp', 'codcencos' => 'codcencos']],
            [['codemp'], 'exist', 'skipOnError' => true, 'targetClass' => SigespEmpresa::className(), 'targetAttribute' => ['codemp' => 'codemp']],
            [['codemp', 'codfuefin'], 'exist', 'skipOnError' => true, 'targetClass' => SigespFuentefinanciamiento::className(), 'targetAttribute' => ['codemp' => 'codemp', 'codfuefin' => 'codfuefin']],
            [['codemp', 'coduniadm', 'codestpro1', 'codestpro2', 'codestpro3', 'codestpro4', 'codestpro5', 'estcla'], 'exist', 'skipOnError' => true, 'targetClass' => SpgDtUnidadadministrativa::className(), 'targetAttribute' => ['codemp' => 'codemp', 'coduniadm' => 'coduniadm', 'codestpro1' => 'codestpro1', 'codestpro2' => 'codestpro2', 'codestpro3' => 'codestpro3', 'codestpro4' => 'codestpro4', 'codestpro5' => 'codestpro5', 'estcla' => 'estcla']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codemp' => 'Codemp',
            'numrecdoc' => 'Numrecdoc',
            'codtipdoc' => 'Codtipdoc',
            'ced_bene' => 'Ced Bene',
            'cod_pro' => 'Cod Pro',
            'codcla' => 'Codcla',
            'dencondoc' => 'Dencondoc',
            'fecemidoc' => 'Fecemidoc',
            'fecregdoc' => 'Fecregdoc',
            'fecvendoc' => 'Fecvendoc',
            'montotdoc' => 'Montotdoc',
            'mondeddoc' => 'Mondeddoc',
            'moncardoc' => 'Moncardoc',
            'tipproben' => 'Tipproben',
            'numref' => 'Numref',
            'estprodoc' => 'Estprodoc',
            'procede' => 'Procede',
            'estlibcom' => 'Estlibcom',
            'estaprord' => 'Estaprord',
            'fecaprord' => 'Fecaprord',
            'usuaprord' => 'Usuaprord',
            'numpolcon' => 'Numpolcon',
            'estimpmun' => 'Estimpmun',
            'montot' => 'Montot',
            'codfuefin' => 'Codfuefin',
            'codrecdoc' => 'Codrecdoc',
            'fechaconta' => 'Fechaconta',
            'fechaanula' => 'Fechaanula',
            'coduniadm' => 'Coduniadm',
            'codestpro1' => 'Codestpro1',
            'codestpro2' => 'Codestpro2',
            'codestpro3' => 'Codestpro3',
            'codestpro4' => 'Codestpro4',
            'codestpro5' => 'Codestpro5',
            'estcla' => 'Estcla',
            'codcencos' => 'Codcencos',
            'estact' => 'Estact',
            'numordpagmin' => 'Numordpagmin',
            'codtipfon' => 'Codtipfon',
            'repcajchi' => 'Repcajchi',
            'codproalt' => 'Codproalt',
            'conanurd' => 'Conanurd',
            'codusureg' => 'Codusureg',
            'tipdoctesnac' => 'Tipdoctesnac',
            'numexprel' => 'Numexprel',
            'estretasu' => 'Estretasu',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCxpDtAmortizacions()
    {
        return $this->hasMany(CxpDtAmortizacion::className(), ['codemp' => 'codemp', 'numrecdoc' => 'numrecdoc', 'codtipdoc' => 'codtipdoc', 'ced_bene' => 'ced_bene', 'cod_pro' => 'cod_pro']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCxpDtSolicitudes()
    {
        return $this->hasMany(CxpDtSolicitudes::className(), ['codemp' => 'codemp', 'numrecdoc' => 'numrecdoc', 'codtipdoc' => 'codtipdoc', 'ced_bene' => 'ced_bene', 'cod_pro' => 'cod_pro']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemps()
    {
        return $this->hasMany(CxpSolicitudes::className(), ['codemp' => 'codemp', 'numsol' => 'numsol'])->viaTable('cxp_dt_solicitudes', ['codemp' => 'codemp', 'numrecdoc' => 'numrecdoc', 'codtipdoc' => 'codtipdoc', 'ced_bene' => 'ced_bene', 'cod_pro' => 'cod_pro']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCxpHistoricoRds()
    {
        return $this->hasMany(CxpHistoricoRd::className(), ['codemp' => 'codemp', 'numrecdoc' => 'numrecdoc', 'codtipdoc' => 'codtipdoc', 'ced_bene' => 'ced_bene', 'cod_pro' => 'cod_pro']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp0()
    {
        return $this->hasOne(CxpClasificadorRd::className(), ['codemp' => 'codemp', 'codcla' => 'codcla']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp1()
    {
        return $this->hasOne(CxpDocumento::className(), ['codemp' => 'codemp', 'codtipdoc' => 'codtipdoc']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp2()
    {
        return $this->hasOne(RpcBeneficiario::className(), ['codemp' => 'codemp', 'ced_bene' => 'ced_bene']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp3()
    {
        return $this->hasOne(RpcProveedor::className(), ['codemp' => 'codemp', 'cod_pro' => 'cod_pro']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp4()
    {
        return $this->hasOne(SigespCencosto::className(), ['codemp' => 'codemp', 'codcencos' => 'codcencos']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp5()
    {
        return $this->hasOne(SigespEmpresa::className(), ['codemp' => 'codemp']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp6()
    {
        return $this->hasOne(SigespFuentefinanciamiento::className(), ['codemp' => 'codemp', 'codfuefin' => 'codfuefin']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp7()
    {
        return $this->hasOne(SpgDtUnidadadministrativa::className(), ['codemp' => 'codemp', 'coduniadm' => 'coduniadm', 'codestpro1' => 'codestpro1', 'codestpro2' => 'codestpro2', 'codestpro3' => 'codestpro3', 'codestpro4' => 'codestpro4', 'codestpro5' => 'codestpro5', 'estcla' => 'estcla']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCxpRdAmortizacions()
    {
        return $this->hasMany(CxpRdAmortizacion::className(), ['codemp' => 'codemp', 'numrecdoc' => 'numrecdoc', 'codtipdoc' => 'codtipdoc', 'cod_pro' => 'cod_pro', 'ced_bene' => 'ced_bene']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCxpRdCargos()
    {
        return $this->hasMany(CxpRdCargos::className(), ['codemp' => 'codemp', 'numrecdoc' => 'numrecdoc', 'codtipdoc' => 'codtipdoc', 'cod_pro' => 'cod_pro', 'ced_bene' => 'ced_bene']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCxpRdDeducciones()
    {
        return $this->hasMany(CxpRdDeducciones::className(), ['codemp' => 'codemp', 'numrecdoc' => 'numrecdoc', 'codtipdoc' => 'codtipdoc', 'cod_pro' => 'cod_pro', 'ced_bene' => 'ced_bene']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCxpRdScgs()
    {
        return $this->hasMany(CxpRdScg::className(), ['codemp' => 'codemp', 'numrecdoc' => 'numrecdoc', 'codtipdoc' => 'codtipdoc', 'ced_bene' => 'ced_bene', 'cod_pro' => 'cod_pro']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCxpRdSpgs()
    {
        return $this->hasMany(CxpRdSpg::className(), ['codemp' => 'codemp', 'numrecdoc' => 'numrecdoc', 'codtipdoc' => 'codtipdoc', 'ced_bene' => 'ced_bene', 'cod_pro' => 'cod_pro']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCxpSolicitudesScgs()
    {
        return $this->hasMany(CxpSolicitudesScg::className(), ['codemp' => 'codemp', 'numrecdoc' => 'numrecdoc', 'codtipdoc' => 'codtipdoc', 'ced_bene' => 'ced_bene', 'cod_pro' => 'cod_pro']);
    }
}
