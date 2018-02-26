<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cxp_solicitudes".
 *
 * @property string $codemp
 * @property string $numsol
 * @property string $cod_pro ID interno de proveedor
 * @property string $ced_bene
 * @property string $codfuefin
 * @property string $tipproben
 * @property string $fecemisol
 * @property string $fecpagsol
 * @property string $consol
 * @property string $estprosol
 * @property double $monsol
 * @property string $obssol
 * @property string $procede
 * @property string $numcmp
 * @property string $feccmp
 * @property int $estaprosol
 * @property string $fecaprosol
 * @property string $usuaprosol
 * @property double $numpolcon
 * @property string $fechaconta
 * @property string $fechaanula
 * @property string $estapesolpag
 * @property string $numordpagmin
 * @property string $codtipfon
 * @property string $repcajchi
 * @property string $conanusol
 * @property string $nombenaltcre
 * @property string $codusureg
 *
 * @property CxpDtSolicitudes[] $cxpDtSolicitudes
 * @property CxpRd[] $codemps
 * @property CxpHistoricoSolicitud[] $cxpHistoricoSolicituds
 * @property CxpSolBanco[] $cxpSolBancos
 * @property ScbMovbco[] $codemps0
 * @property RpcBeneficiario $codemp0
 * @property RpcProveedor $codemp1
 * @property SigespFuentefinanciamiento $codemp2
 * @property CxpSolicitudesScg[] $cxpSolicitudesScgs
 * @property ScbProgPago[] $scbProgPagos
 */
class Cxpsolicitudes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cxp_solicitudes';
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
            [['codemp', 'numsol', 'tipproben', 'consol', 'estprosol'], 'required'],
            [['fecemisol', 'fecpagsol', 'feccmp', 'fecaprosol', 'fechaconta', 'fechaanula'], 'safe'],
            [['consol', 'obssol', 'conanusol'], 'string'],
            [['monsol', 'numpolcon'], 'number'],
            [['estaprosol'], 'default', 'value' => null],
            [['estaprosol'], 'integer'],
            [['codemp', 'codtipfon'], 'string', 'max' => 4],
            [['numsol', 'numcmp', 'numordpagmin'], 'string', 'max' => 15],
            [['cod_pro', 'ced_bene'], 'string', 'max' => 10],
            [['codfuefin'], 'string', 'max' => 2],
            [['tipproben', 'estprosol', 'estapesolpag', 'repcajchi'], 'string', 'max' => 1],
            [['procede'], 'string', 'max' => 6],
            [['usuaprosol'], 'string', 'max' => 60],
            [['nombenaltcre'], 'string', 'max' => 254],
            [['codusureg'], 'string', 'max' => 50],
            [['codemp', 'numsol'], 'unique', 'targetAttribute' => ['codemp', 'numsol']],
            [['codemp', 'ced_bene'], 'exist', 'skipOnError' => true, 'targetClass' => RpcBeneficiario::className(), 'targetAttribute' => ['codemp' => 'codemp', 'ced_bene' => 'ced_bene']],
            [['codemp', 'cod_pro'], 'exist', 'skipOnError' => true, 'targetClass' => RpcProveedor::className(), 'targetAttribute' => ['codemp' => 'codemp', 'cod_pro' => 'cod_pro']],
            [['codemp', 'codfuefin'], 'exist', 'skipOnError' => true, 'targetClass' => SigespFuentefinanciamiento::className(), 'targetAttribute' => ['codemp' => 'codemp', 'codfuefin' => 'codfuefin']],
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
            'cod_pro' => 'Cod Pro',
            'ced_bene' => 'Ced Bene',
            'codfuefin' => 'Codfuefin',
            'tipproben' => 'Tipproben',
            'fecemisol' => 'Fecemisol',
            'fecpagsol' => 'Fecpagsol',
            'consol' => 'Consol',
            'estprosol' => 'Estprosol',
            'monsol' => 'Monsol',
            'obssol' => 'Obssol',
            'procede' => 'Procede',
            'numcmp' => 'Numcmp',
            'feccmp' => 'Feccmp',
            'estaprosol' => 'Estaprosol',
            'fecaprosol' => 'Fecaprosol',
            'usuaprosol' => 'Usuaprosol',
            'numpolcon' => 'Numpolcon',
            'fechaconta' => 'Fechaconta',
            'fechaanula' => 'Fechaanula',
            'estapesolpag' => 'Estapesolpag',
            'numordpagmin' => 'Numordpagmin',
            'codtipfon' => 'Codtipfon',
            'repcajchi' => 'Repcajchi',
            'conanusol' => 'Conanusol',
            'nombenaltcre' => 'Nombenaltcre',
            'codusureg' => 'Codusureg',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCxpDtSolicitudes()
    {
        return $this->hasMany(CxpDtSolicitudes::className(), ['codemp' => 'codemp', 'numsol' => 'numsol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemps()
    {
        return $this->hasMany(CxpRd::className(), ['codemp' => 'codemp', 'numrecdoc' => 'numrecdoc', 'codtipdoc' => 'codtipdoc', 'ced_bene' => 'ced_bene', 'cod_pro' => 'cod_pro'])->viaTable('cxp_dt_solicitudes', ['codemp' => 'codemp', 'numsol' => 'numsol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCxpHistoricoSolicituds()
    {
        return $this->hasMany(CxpHistoricoSolicitud::className(), ['codemp' => 'codemp', 'numsol' => 'numsol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCxpSolBancos()
    {
        return $this->hasMany(CxpSolBanco::className(), ['codemp' => 'codemp', 'numsol' => 'numsol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemps0()
    {
        return $this->hasMany(ScbMovbco::className(), ['codemp' => 'codemp', 'codban' => 'codban', 'ctaban' => 'ctaban', 'numdoc' => 'numdoc', 'codope' => 'codope', 'estmov' => 'estmov'])->viaTable('cxp_sol_banco', ['codemp' => 'codemp', 'numsol' => 'numsol']);
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
        return $this->hasOne(SigespFuentefinanciamiento::className(), ['codemp' => 'codemp', 'codfuefin' => 'codfuefin']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCxpSolicitudesScgs()
    {
        return $this->hasMany(CxpSolicitudesScg::className(), ['codemp' => 'codemp', 'numsol' => 'numsol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbProgPagos()
    {
        return $this->hasMany(ScbProgPago::className(), ['codemp' => 'codemp', 'numsol' => 'numsol']);
    }
}
