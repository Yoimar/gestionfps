<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sno_hconcepto".
 *
 * @property string $codemp
 * @property string $codnom
 * @property string $anocur
 * @property string $codperi
 * @property string $codconc
 * @property string $nomcon
 * @property string $titcon
 * @property string $sigcon Value	Label A	Asignación D	Deducción P	Aporte Patronal R	Reporte B	Reintegro Deducción E	Reintegro Asignación
 * @property string $forcon
 * @property int $glocon estatus que me verifica si el concepto se le aplica a todo el personal Value	Label 0	se aplica 1	no se aplica
 * @property double $acumaxcon Acumulado maximo, si es mayor a cero al alcanzar este valor no se aplica mas el concepto
 * @property double $valmincon valor minimo que puede tomar el concepto
 * @property double $valmaxcon valor maximo que puede alcanzar el concepto al evaluarse
 * @property string $concon Expresion que al evaluarse de ser verdadera se aplica el concepto
 * @property string $cueprecon Codigo estadistico si es Asignacion
 * @property string $cueconcon Codigo contable si es Deduccion o Prestamo
 * @property int $aplisrcon indica si se aplica impuesto sobre la renta
 * @property int $sueintcon
 * @property int $sueintvaccon Value	Label 0	No Pertenece 1	Pertenece
 * @property int $conprenom Valor Descripción     0   No aplicar     1   Aplicar
 * @property string $intprocon
 * @property string $codestpro1
 * @property string $codestpro2
 * @property string $codestpro3
 * @property string $codestpro4
 * @property string $codestpro5
 * @property string $estcla
 * @property string $forpatcon
 * @property string $cueprepatcon
 * @property string $cueconpatcon
 * @property string $titretempcon
 * @property string $titretpatcon
 * @property double $valminpatcon
 * @property double $valmaxpatcon
 * @property string $codprov
 * @property string $cedben
 * @property int $aplarccon
 * @property string $conprocon
 * @property string $intingcon
 * @property double $poringcon
 * @property string $spi_cuenta
 * @property string $repacucon
 * @property string $repconsunicon
 * @property string $consunicon
 * @property string $quirepcon
 * @property string $asifidper
 * @property string $asifidpat
 * @property string $frevarcon
 * @property string $persalnor
 * @property string $aplresenc
 * @property string $conperenc
 * @property string $codente
 * @property string $guarrepcon
 * @property int $aplidiasadd
 * @property string $salnor
 * @property string $recpagadi
 * @property string $codcencos
 *
 * @property SigespCencosto $codemp0
 * @property SnoHconceptopersonal[] $snoHconceptopersonals
 * @property SnoHpersonalnomina[] $codemps
 * @property SnoHconceptovacacion $snoHconceptovacacion
 * @property SnoHprimaconcepto[] $snoHprimaconceptos
 */
class Snohconcepto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sno_hconcepto';
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
            [['codemp', 'codnom', 'anocur', 'codperi', 'codconc', 'nomcon', 'titcon', 'sigcon', 'forcon'], 'required'],
            [['forcon', 'concon', 'forpatcon'], 'string'],
            [['glocon', 'aplisrcon', 'sueintcon', 'sueintvaccon', 'conprenom', 'aplarccon', 'aplidiasadd'], 'default', 'value' => null],
            [['glocon', 'aplisrcon', 'sueintcon', 'sueintvaccon', 'conprenom', 'aplarccon', 'aplidiasadd'], 'integer'],
            [['acumaxcon', 'valmincon', 'valmaxcon', 'valminpatcon', 'valmaxpatcon', 'poringcon'], 'number'],
            [['codemp', 'codnom', 'anocur'], 'string', 'max' => 4],
            [['codperi', 'codcencos'], 'string', 'max' => 3],
            [['codconc', 'titretempcon', 'titretpatcon', 'codprov', 'cedben', 'consunicon'], 'string', 'max' => 10],
            [['nomcon'], 'string', 'max' => 30],
            [['titcon'], 'string', 'max' => 254],
            [['sigcon', 'intprocon', 'estcla', 'conprocon', 'intingcon', 'repacucon', 'repconsunicon', 'quirepcon', 'asifidper', 'asifidpat', 'frevarcon', 'persalnor', 'aplresenc', 'conperenc', 'guarrepcon', 'salnor', 'recpagadi'], 'string', 'max' => 1],
            [['cueprecon', 'cueconcon', 'codestpro1', 'codestpro2', 'codestpro3', 'codestpro4', 'codestpro5', 'cueprepatcon', 'cueconpatcon', 'spi_cuenta'], 'string', 'max' => 25],
            [['codente'], 'string', 'max' => 12],
            [['codemp', 'codnom', 'anocur', 'codperi', 'codconc'], 'unique', 'targetAttribute' => ['codemp', 'codnom', 'anocur', 'codperi', 'codconc']],
            [['codemp', 'codcencos'], 'exist', 'skipOnError' => true, 'targetClass' => SigespCencosto::className(), 'targetAttribute' => ['codemp' => 'codemp', 'codcencos' => 'codcencos']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codemp' => 'Codemp',
            'codnom' => 'Codnom',
            'anocur' => 'Anocur',
            'codperi' => 'Codperi',
            'codconc' => 'Codconc',
            'nomcon' => 'Nomcon',
            'titcon' => 'Titcon',
            'sigcon' => 'Sigcon',
            'forcon' => 'Forcon',
            'glocon' => 'Glocon',
            'acumaxcon' => 'Acumaxcon',
            'valmincon' => 'Valmincon',
            'valmaxcon' => 'Valmaxcon',
            'concon' => 'Concon',
            'cueprecon' => 'Cueprecon',
            'cueconcon' => 'Cueconcon',
            'aplisrcon' => 'Aplisrcon',
            'sueintcon' => 'Sueintcon',
            'sueintvaccon' => 'Sueintvaccon',
            'conprenom' => 'Conprenom',
            'intprocon' => 'Intprocon',
            'codestpro1' => 'Codestpro1',
            'codestpro2' => 'Codestpro2',
            'codestpro3' => 'Codestpro3',
            'codestpro4' => 'Codestpro4',
            'codestpro5' => 'Codestpro5',
            'estcla' => 'Estcla',
            'forpatcon' => 'Forpatcon',
            'cueprepatcon' => 'Cueprepatcon',
            'cueconpatcon' => 'Cueconpatcon',
            'titretempcon' => 'Titretempcon',
            'titretpatcon' => 'Titretpatcon',
            'valminpatcon' => 'Valminpatcon',
            'valmaxpatcon' => 'Valmaxpatcon',
            'codprov' => 'Codprov',
            'cedben' => 'Cedben',
            'aplarccon' => 'Aplarccon',
            'conprocon' => 'Conprocon',
            'intingcon' => 'Intingcon',
            'poringcon' => 'Poringcon',
            'spi_cuenta' => 'Spi Cuenta',
            'repacucon' => 'Repacucon',
            'repconsunicon' => 'Repconsunicon',
            'consunicon' => 'Consunicon',
            'quirepcon' => 'Quirepcon',
            'asifidper' => 'Asifidper',
            'asifidpat' => 'Asifidpat',
            'frevarcon' => 'Frevarcon',
            'persalnor' => 'Persalnor',
            'aplresenc' => 'Aplresenc',
            'conperenc' => 'Conperenc',
            'codente' => 'Codente',
            'guarrepcon' => 'Guarrepcon',
            'aplidiasadd' => 'Aplidiasadd',
            'salnor' => 'Salnor',
            'recpagadi' => 'Recpagadi',
            'codcencos' => 'Codcencos',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp0()
    {
        return $this->hasOne(SigespCencosto::className(), ['codemp' => 'codemp', 'codcencos' => 'codcencos']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSnoHconceptopersonals()
    {
        return $this->hasMany(SnoHconceptopersonal::className(), ['codemp' => 'codemp', 'codnom' => 'codnom', 'anocur' => 'anocur', 'codperi' => 'codperi', 'codconc' => 'codconc']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemps()
    {
        return $this->hasMany(SnoHpersonalnomina::className(), ['codemp' => 'codemp', 'codnom' => 'codnom', 'anocur' => 'anocur', 'codperi' => 'codperi', 'codper' => 'codper'])->viaTable('sno_hconceptopersonal', ['codemp' => 'codemp', 'codnom' => 'codnom', 'anocur' => 'anocur', 'codperi' => 'codperi', 'codconc' => 'codconc']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSnoHconceptovacacion()
    {
        return $this->hasOne(SnoHconceptovacacion::className(), ['codemp' => 'codemp', 'codnom' => 'codnom', 'anocur' => 'anocur', 'codperi' => 'codperi', 'codconc' => 'codconc']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSnoHprimaconceptos()
    {
        return $this->hasMany(SnoHprimaconcepto::className(), ['codemp' => 'codemp', 'codnom' => 'codnom', 'anocur' => 'anocur', 'codperi' => 'codperi', 'codconc' => 'codconc']);
    }
}
