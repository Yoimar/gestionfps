<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scb_movbco".
 *
 * @property string $codemp
 * @property string $codban
 * @property string $ctaban
 * @property string $numdoc
 * @property string $codope
 * @property string $estmov
 * @property string $cod_pro ID interno de proveedor
 * @property string $ced_bene
 * @property string $tipo_destino
 * @property string $codconmov
 * @property string $fecmov
 * @property string $conmov
 * @property string $nomproben
 * @property double $monto
 * @property string $estbpd
 * @property int $estcon
 * @property int $estcobing
 * @property int $esttra
 * @property string $chevau
 * @property int $estimpche
 * @property double $monobjret
 * @property double $monret
 * @property string $procede
 * @property string $comprobante
 * @property string $fecha
 * @property string $id_mco
 * @property int $emicheproc
 * @property string $emicheced
 * @property string $emichenom
 * @property string $emichefec
 * @property int $estmovint Estatus  asocioado a una nota de credito de Interes
 * @property string $codusu
 * @property string $codopeidb
 * @property double $aliidb
 * @property string $feccon
 * @property string $estreglib
 * @property string $numcarord
 * @property double $numpolcon
 * @property string $coduniadmsig
 * @property string $codbansig
 * @property string $fecordpagsig
 * @property string $tipdocressig
 * @property string $numdocressig
 * @property string $estmodordpag
 * @property string $codfuefin
 * @property string $forpagsig
 * @property string $medpagsig
 * @property string $codestprosig
 * @property string $nrocontrolop
 * @property string $fechaconta
 * @property string $fechaanula
 * @property string $conanu
 * @property string $estant
 * @property string $docant
 * @property double $monamo
 * @property string $numordpagmin
 * @property string $codtipfon
 * @property string $estserext
 * @property int $estmovcob
 * @property string $numconint
 * @property string $estapribs
 * @property string $estxmlibs
 * @property string $codper
 * @property string $codperi
 * @property string $tranoreglib
 * @property string $estcondoc
 * @property string $fecenvfir
 * @property string $fecenvcaj
 * @property string $docdestrans
 * @property string $tiptrans
 * @property string $codcencos
 *
 * @property CxpSolBanco[] $cxpSolBancos
 * @property CxpSolicitudes[] $codemps
 * @property ScbDtMovbco[] $scbDtMovbcos
 * @property ScbDtOp[] $scbDtOps
 * @property RpcBeneficiario $codemp0
 * @property RpcProveedor $codemp1
 * @property ScbConcepto $codemp2
 * @property ScbCtabanco $codemp3
 * @property SigespCencosto $codemp4
 * @property ScbMovbcoAnticipo[] $scbMovbcoAnticipos
 * @property ScbMovbcoFuefinanciamiento[] $scbMovbcoFuefinanciamientos
 * @property SigespFuentefinanciamiento[] $codemps0
 * @property ScbMovbcoScg[] $scbMovbcoScgs
 * @property ScbMovbcoSpg[] $scbMovbcoSpgs
 * @property ScbMovbcoSpgop[] $scbMovbcoSpgops
 * @property ScbMovbcoSpi[] $scbMovbcoSpis
 */
class Scbmovbco extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_movbco';
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
            [['codemp', 'codban', 'ctaban', 'numdoc', 'codope', 'estmov', 'tipo_destino', 'conmov', 'nomproben', 'estbpd'], 'required'],
            [['fecmov', 'fecha', 'emichefec', 'feccon', 'fecordpagsig', 'fechaconta', 'fechaanula', 'fecenvfir', 'fecenvcaj'], 'safe'],
            [['conmov', 'conanu'], 'string'],
            [['monto', 'monobjret', 'monret', 'aliidb', 'numpolcon', 'monamo'], 'number'],
            [['estcon', 'estcobing', 'esttra', 'estimpche', 'emicheproc', 'estmovint', 'estmovcob'], 'default', 'value' => null],
            [['estcon', 'estcobing', 'esttra', 'estimpche', 'emicheproc', 'estmovint', 'estmovcob'], 'integer'],
            [['codemp', 'codtipfon'], 'string', 'max' => 4],
            [['codban', 'codconmov', 'codbansig', 'codperi', 'codcencos'], 'string', 'max' => 3],
            [['ctaban', 'chevau'], 'string', 'max' => 25],
            [['numdoc', 'comprobante', 'numcarord', 'numdocressig', 'nrocontrolop', 'docant', 'numordpagmin', 'numconint', 'docdestrans'], 'string', 'max' => 15],
            [['codope', 'codopeidb', 'tipdocressig', 'estmodordpag', 'codfuefin'], 'string', 'max' => 2],
            [['estmov', 'tipo_destino', 'estbpd', 'estreglib', 'forpagsig', 'medpagsig', 'estant', 'estserext', 'estapribs', 'estxmlibs', 'tranoreglib', 'estcondoc', 'tiptrans'], 'string', 'max' => 1],
            [['cod_pro', 'ced_bene', 'id_mco', 'codper'], 'string', 'max' => 10],
            [['nomproben', 'emicheced', 'emichenom'], 'string', 'max' => 100],
            [['procede'], 'string', 'max' => 6],
            [['codusu'], 'string', 'max' => 50],
            [['coduniadmsig'], 'string', 'max' => 5],
            [['codestprosig'], 'string', 'max' => 33],
            [['codemp', 'estmov', 'numconint'], 'unique', 'targetAttribute' => ['codemp', 'estmov', 'numconint']],
            [['codemp', 'codban', 'ctaban', 'numdoc', 'codope', 'estmov'], 'unique', 'targetAttribute' => ['codemp', 'codban', 'ctaban', 'numdoc', 'codope', 'estmov']],
            [['codemp', 'ced_bene'], 'exist', 'skipOnError' => true, 'targetClass' => Rpcbeneficiario::className(), 'targetAttribute' => ['codemp' => 'codemp', 'ced_bene' => 'ced_bene']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codemp' => 'Codemp',
            'codban' => 'Codban',
            'ctaban' => 'Ctaban',
            'numdoc' => 'Numdoc',
            'codope' => 'Codope',
            'estmov' => 'Estmov',
            'cod_pro' => 'Cod Pro',
            'ced_bene' => 'Ced Bene',
            'tipo_destino' => 'Tipo Destino',
            'codconmov' => 'Codconmov',
            'fecmov' => 'Fecmov',
            'conmov' => 'Conmov',
            'nomproben' => 'Nomproben',
            'monto' => 'Monto',
            'estbpd' => 'Estbpd',
            'estcon' => 'Estcon',
            'estcobing' => 'Estcobing',
            'esttra' => 'Esttra',
            'chevau' => 'Chevau',
            'estimpche' => 'Estimpche',
            'monobjret' => 'Monobjret',
            'monret' => 'Monret',
            'procede' => 'Procede',
            'comprobante' => 'Comprobante',
            'fecha' => 'Fecha',
            'id_mco' => 'Id Mco',
            'emicheproc' => 'Emicheproc',
            'emicheced' => 'Emicheced',
            'emichenom' => 'Emichenom',
            'emichefec' => 'Emichefec',
            'estmovint' => 'Estmovint',
            'codusu' => 'Codusu',
            'codopeidb' => 'Codopeidb',
            'aliidb' => 'Aliidb',
            'feccon' => 'Feccon',
            'estreglib' => 'Estreglib',
            'numcarord' => 'Numcarord',
            'numpolcon' => 'Numpolcon',
            'coduniadmsig' => 'Coduniadmsig',
            'codbansig' => 'Codbansig',
            'fecordpagsig' => 'Fecordpagsig',
            'tipdocressig' => 'Tipdocressig',
            'numdocressig' => 'Numdocressig',
            'estmodordpag' => 'Estmodordpag',
            'codfuefin' => 'Codfuefin',
            'forpagsig' => 'Forpagsig',
            'medpagsig' => 'Medpagsig',
            'codestprosig' => 'Codestprosig',
            'nrocontrolop' => 'Nrocontrolop',
            'fechaconta' => 'Fechaconta',
            'fechaanula' => 'Fechaanula',
            'conanu' => 'Conanu',
            'estant' => 'Estant',
            'docant' => 'Docant',
            'monamo' => 'Monamo',
            'numordpagmin' => 'Numordpagmin',
            'codtipfon' => 'Codtipfon',
            'estserext' => 'Estserext',
            'estmovcob' => 'Estmovcob',
            'numconint' => 'Numconint',
            'estapribs' => 'Estapribs',
            'estxmlibs' => 'Estxmlibs',
            'codper' => 'Codper',
            'codperi' => 'Codperi',
            'tranoreglib' => 'Tranoreglib',
            'estcondoc' => 'Estcondoc',
            'fecenvfir' => 'Fecenvfir',
            'fecenvcaj' => 'Fecenvcaj',
            'docdestrans' => 'Docdestrans',
            'tiptrans' => 'Tiptrans',
            'codcencos' => 'Codcencos',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCxpSolBancos()
    {
        return $this->hasMany(CxpSolBanco::className(), ['codemp' => 'codemp', 'codban' => 'codban', 'ctaban' => 'ctaban', 'numdoc' => 'numdoc', 'codope' => 'codope', 'estmov' => 'estmov']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemps()
    {
        return $this->hasMany(CxpSolicitudes::className(), ['codemp' => 'codemp', 'numsol' => 'numsol'])->viaTable('cxp_sol_banco', ['codemp' => 'codemp', 'codban' => 'codban', 'ctaban' => 'ctaban', 'numdoc' => 'numdoc', 'codope' => 'codope', 'estmov' => 'estmov']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbDtMovbcos()
    {
        return $this->hasMany(ScbDtMovbco::className(), ['codemp' => 'codemp', 'codban' => 'codban', 'ctaban' => 'ctaban', 'numdoc' => 'numdoc', 'codope' => 'codope', 'estmov' => 'estmov']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbDtOps()
    {
        return $this->hasMany(ScbDtOp::className(), ['codemp' => 'codemp', 'codban' => 'codban', 'ctaban' => 'ctaban', 'numdoc' => 'numdoc', 'codope' => 'codope', 'estmov' => 'estmov']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp0()
    {
        return $this->hasOne(RpcBeneficiario::className(), ['codemp' => 'codemp', 'ced_bene' => 'ced_bene']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp1()
    {
        return $this->hasOne(RpcProveedor::className(), ['codemp' => 'codemp', 'cod_pro' => 'cod_pro']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp2()
    {
        return $this->hasOne(ScbConcepto::className(), ['codemp' => 'codemp', 'codconmov' => 'codconmov']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp3()
    {
        return $this->hasOne(ScbCtabanco::className(), ['codemp' => 'codemp', 'codban' => 'codban', 'ctaban' => 'ctaban']);
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
    public function getScbMovbcoAnticipos()
    {
        return $this->hasMany(ScbMovbcoAnticipo::className(), ['codemp' => 'codemp', 'codban' => 'codban', 'ctaban' => 'ctaban', 'numdoc' => 'numdoc', 'codope' => 'codope', 'estmov' => 'estmov']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbMovbcoFuefinanciamientos()
    {
        return $this->hasMany(ScbMovbcoFuefinanciamiento::className(), ['codemp' => 'codemp', 'codban' => 'codban', 'ctaban' => 'ctaban', 'numdoc' => 'numdoc', 'codope' => 'codope', 'estmov' => 'estmov']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemps0()
    {
        return $this->hasMany(SigespFuentefinanciamiento::className(), ['codemp' => 'codemp', 'codfuefin' => 'codfuefin'])->viaTable('scb_movbco_fuefinanciamiento', ['codemp' => 'codemp', 'codban' => 'codban', 'ctaban' => 'ctaban', 'numdoc' => 'numdoc', 'codope' => 'codope', 'estmov' => 'estmov']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbMovbcoScgs()
    {
        return $this->hasMany(ScbMovbcoScg::className(), ['codemp' => 'codemp', 'codban' => 'codban', 'ctaban' => 'ctaban', 'numdoc' => 'numdoc', 'codope' => 'codope', 'estmov' => 'estmov']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbMovbcoSpgs()
    {
        return $this->hasMany(ScbMovbcoSpg::className(), ['codemp' => 'codemp', 'codban' => 'codban', 'ctaban' => 'ctaban', 'numdoc' => 'numdoc', 'codope' => 'codope', 'estmov' => 'estmov']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbMovbcoSpgops()
    {
        return $this->hasMany(ScbMovbcoSpgop::className(), ['codemp' => 'codemp', 'codban' => 'codban', 'ctaban' => 'ctaban', 'numdoc' => 'numdoc', 'codope' => 'codope', 'estmov' => 'estmov']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbMovbcoSpis()
    {
        return $this->hasMany(ScbMovbcoSpi::className(), ['codemp' => 'codemp', 'codban' => 'codban', 'ctaban' => 'ctaban', 'numdoc' => 'numdoc', 'codope' => 'codope', 'estmov' => 'estmov']);
    }
}
