<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sep_solicitud".
 *
 * @property string $codemp
 * @property string $numsol
 * @property string $codtipsol
 * @property string $codfuefin
 * @property string $fecregsol
 * @property string $estsol
 * @property string $consol
 * @property double $monto
 * @property double $monbasinm
 * @property double $montotcar
 * @property string $tipo_destino
 * @property string $cod_pro
 * @property string $ced_bene
 * @property string $coduniadm
 * @property string $codestpro1
 * @property string $codestpro2
 * @property string $codestpro3
 * @property string $codestpro4
 * @property string $codestpro5
 * @property string $estcla
 * @property integer $estapro
 * @property string $fecaprsep
 * @property string $codaprusu
 * @property double $numpolcon
 * @property string $fechaconta
 * @property string $fechaanula
 * @property string $nombenalt
 * @property string $tipsepbie
 * @property string $codusu
 * @property string $numdocori
 * @property string $conanusep
 * @property string $feccieinv
 * @property string $codcencos
 *
 * @property SepCuentagasto[] $sepCuentagastos
 * @property SepDtArticulos[] $sepDtArticulos
 * @property SivArticulo[] $codemps
 * @property SepDtConcepto[] $sepDtConceptos
 * @property SepConceptos[] $codemps0
 * @property SepDtServicio[] $sepDtServicios
 * @property SocServicios[] $codemps1
 * @property RpcBeneficiario $codemp0
 * @property RpcProveedor $codemp1
 * @property SepTiposolicitud $codemp2
 * @property SigespCencosto $codemp3
 * @property SigespEmpresa $codemp4
 * @property SigespFuentefinanciamiento $codemp5
 * @property SpgDtUnidadadministrativa $codemp6
 * @property SepSolicitudcargos[] $sepSolicitudcargos
 * @property SivDespacho[] $sivDespachos
 * @property SocEnlaceSep[] $socEnlaceSeps
 * @property SocOrdencompra[] $codemps2
 * @property SocSolcotsep[] $socSolcotseps
 * @property SocSolCotizacion[] $codemps3
 */
class Sepsolicitud extends \yii\db\ActiveRecord
{
    public $nombrebeneficiario;
    public $rifbeneficiario;
    public $estructura;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sep_solicitud';
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
            [['codemp', 'numsol', 'codtipsol', 'estsol', 'tipo_destino', 'cod_pro', 'ced_bene'], 'required'],
            [['fecregsol', 'fecaprsep', 'fechaconta', 'fechaanula', 'feccieinv'], 'safe'],
            [['consol', 'conanusep'], 'string'],
            [['monto', 'monbasinm', 'montotcar', 'numpolcon'], 'number'],
            [['estapro'], 'integer'],
            [['codemp'], 'string', 'max' => 4],
            [['numsol', 'numdocori'], 'string', 'max' => 15],
            [['codtipsol', 'codfuefin'], 'string', 'max' => 2],
            [['estsol', 'tipo_destino', 'estcla', 'tipsepbie'], 'string', 'max' => 1],
            [['cod_pro', 'ced_bene', 'coduniadm'], 'string', 'max' => 10],
            [['codestpro1', 'codestpro2', 'codestpro3', 'codestpro4', 'codestpro5'], 'string', 'max' => 25],
            [['codaprusu'], 'string', 'max' => 50],
            [['nombenalt'], 'string', 'max' => 100],
            [['codusu'], 'string', 'max' => 30],
            [['codcencos'], 'string', 'max' => 3],
            [['codemp', 'ced_bene'], 'exist', 'skipOnError' => true, 'targetClass' => Rpcbeneficiario::className(), 'targetAttribute' => ['codemp' => 'codemp', 'ced_bene' => 'ced_bene']],  
            [['codemp', 'coduniadm', 'codestpro1', 'codestpro2', 'codestpro3', 'codestpro4', 'codestpro5', 'estcla'], 'exist', 'skipOnError' => true, 'targetClass' => Spgdtunidadadministrativa::className(), 'targetAttribute' => ['codemp' => 'codemp', 'coduniadm' => 'coduniadm', 'codestpro1' => 'codestpro1', 'codestpro2' => 'codestpro2', 'codestpro3' => 'codestpro3', 'codestpro4' => 'codestpro4', 'codestpro5' => 'codestpro5', 'estcla' => 'estcla']],
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
            'codtipsol' => 'Codtipsol',
            'codfuefin' => 'Codfuefin',
            'fecregsol' => 'Fecregsol',
            'estsol' => 'Estsol',
            'consol' => 'Consol',
            'monto' => 'Monto',
            'monbasinm' => 'Monbasinm',
            'montotcar' => 'Montotcar',
            'tipo_destino' => 'Tipo Destino',
            'cod_pro' => 'Cod Pro',
            'ced_bene' => 'Ced Bene',
            'coduniadm' => 'Coduniadm',
            'codestpro1' => 'Codestpro1',
            'codestpro2' => 'Codestpro2',
            'codestpro3' => 'Codestpro3',
            'codestpro4' => 'Codestpro4',
            'codestpro5' => 'Codestpro5',
            'estcla' => 'Estcla',
            'estapro' => 'Estapro',
            'fecaprsep' => 'Fecaprsep',
            'codaprusu' => 'Codaprusu',
            'numpolcon' => 'Numpolcon',
            'fechaconta' => 'Fechaconta',
            'fechaanula' => 'Fechaanula',
            'nombenalt' => 'Nombenalt',
            'tipsepbie' => 'Tipsepbie',
            'codusu' => 'Codusu',
            'numdocori' => 'Numdocori',
            'conanusep' => 'Conanusep',
            'feccieinv' => 'Feccieinv',
            'codcencos' => 'Codcencos',
            'nombrebeneficiario' => 'Casa Comercial',
            'rifbeneficiario' => 'Rif',
            'estructura' => 'Estructura',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSepCuentagastos()
    {
        return $this->hasMany(Sepcuentagasto::className(), ['codemp' => 'codemp', 'numsol' => 'numsol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSepDtArticulos()
    {
        return $this->hasMany(SepDtArticulos::className(), ['codemp' => 'codemp', 'numsol' => 'numsol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemps()
    {
        return $this->hasMany(SivArticulo::className(), ['codemp' => 'codemp', 'codart' => 'codart'])->viaTable('sep_dt_articulos', ['codemp' => 'codemp', 'numsol' => 'numsol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSepDtConceptos()
    {
        return $this->hasMany(Sepdtconcepto::className(), ['codemp' => 'codemp', 'numsol' => 'numsol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemps0()
    {
        return $this->hasMany(Sepconceptos::className(), ['codemp' => 'codemp', 'codconsep' => 'codconsep'])->viaTable('sep_dt_concepto', ['codemp' => 'codemp', 'numsol' => 'numsol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSepDtServicios()
    {
        return $this->hasMany(SepDtServicio::className(), ['codemp' => 'codemp', 'numsol' => 'numsol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemps1()
    {
        return $this->hasMany(SocServicios::className(), ['codemp' => 'codemp', 'codser' => 'codser'])->viaTable('sep_dt_servicio', ['codemp' => 'codemp', 'numsol' => 'numsol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeneficiariocheque()
    {
        return $this->hasOne(Rpcbeneficiario::className(), ['codemp' => 'codemp', 'ced_bene' => 'ced_bene']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProveedorcheque()
    {
        return $this->hasOne(RpcProveedor::className(), ['codemp' => 'codemp', 'cod_pro' => 'cod_pro']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp2()
    {
        return $this->hasOne(SepTiposolicitud::className(), ['codemp' => 'codemp', 'codtipsol' => 'codtipsol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp3()
    {
        return $this->hasOne(SigespCencosto::className(), ['codemp' => 'codemp', 'codcencos' => 'codcencos']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp4()
    {
        return $this->hasOne(SigespEmpresa::className(), ['codemp' => 'codemp']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp5()
    {
        return $this->hasOne(SigespFuentefinanciamiento::className(), ['codemp' => 'codemp', 'codfuefin' => 'codfuefin']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp6()
    {
        return $this->hasOne(Spgdtunidadadministrativa::className(), ['codemp' => 'codemp', 'coduniadm' => 'coduniadm', 'codestpro1' => 'codestpro1', 'codestpro2' => 'codestpro2', 'codestpro3' => 'codestpro3', 'codestpro4' => 'codestpro4', 'codestpro5' => 'codestpro5', 'estcla' => 'estcla']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSepSolicitudcargos()
    {
        return $this->hasMany(SepSolicitudcargos::className(), ['codemp' => 'codemp', 'numsol' => 'numsol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSivDespachos()
    {
        return $this->hasMany(SivDespacho::className(), ['codemp' => 'codemp', 'numsol' => 'numsol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocEnlaceSeps()
    {
        return $this->hasMany(SocEnlaceSep::className(), ['codemp' => 'codemp', 'numsol' => 'numsol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemps2()
    {
        return $this->hasMany(SocOrdencompra::className(), ['codemp' => 'codemp', 'numordcom' => 'numordcom', 'estcondat' => 'estcondat'])->viaTable('soc_enlace_sep', ['codemp' => 'codemp', 'numsol' => 'numsol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocSolcotseps()
    {
        return $this->hasMany(SocSolcotsep::className(), ['codemp' => 'codemp', 'numsol' => 'numsol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemps3()
    {
        return $this->hasMany(SocSolCotizacion::className(), ['codemp' => 'codemp', 'numsolcot' => 'numsolcot'])->viaTable('soc_solcotsep', ['codemp' => 'codemp', 'numsol' => 'numsol']);
    }
    
    public function getEstructuracaso()
            {
        return ltrim($this->codestpro1, '0')."-".ltrim($this->codestpro2, '0')."-".ltrim($this->codestpro3, '0');
            }
            
}
