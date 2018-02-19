<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "spg_dt_cmp".
 *
 * @property string $codemp
 * @property string $procede
 * @property string $comprobante
 * @property string $codban
 * @property string $ctaban
 * @property string $estcla
 * @property string $codestpro1
 * @property string $codestpro2
 * @property string $codestpro3
 * @property string $codestpro4
 * @property string $codestpro5
 * @property string $spg_cuenta
 * @property string $codfuefin
 * @property string $codcencos
 * @property string $procede_doc
 * @property string $documento
 * @property string $operacion
 * @property string $fecha
 * @property string $descripcion
 * @property double $monto
 * @property int $orden
 *
 * @property SigespCencosto $codemp0
 * @property SigespCmp $codemp1
 * @property SpgCuentaFuentefinanciamiento $codemp2
 * @property SpgCuentas $codemp3
 * @property SpgOperaciones $operacion0
 */
class Spgdtcmp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'spg_dt_cmp';
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
            [['codemp', 'procede', 'comprobante', 'codban', 'ctaban', 'estcla', 'codestpro1', 'codestpro2', 'codestpro3', 'codestpro4', 'codestpro5', 'spg_cuenta', 'codfuefin', 'codcencos', 'procede_doc', 'documento', 'operacion', 'descripcion', 'orden'], 'required'],
            [['fecha'], 'safe'],
            [['descripcion'], 'string'],
            [['monto'], 'number'],
            [['orden'], 'default', 'value' => null],
            [['orden'], 'integer'],
            [['codemp'], 'string', 'max' => 4],
            [['procede', 'procede_doc'], 'string', 'max' => 6],
            [['comprobante', 'documento'], 'string', 'max' => 15],
            [['codban', 'codcencos', 'operacion'], 'string', 'max' => 3],
            [['ctaban', 'codestpro1', 'codestpro2', 'codestpro3', 'codestpro4', 'codestpro5', 'spg_cuenta'], 'string', 'max' => 25],
            [['estcla'], 'string', 'max' => 1],
            [['codfuefin'], 'string', 'max' => 2],
            [['codemp', 'procede', 'comprobante', 'codban', 'ctaban', 'estcla', 'codestpro1', 'codestpro2', 'codestpro3', 'codestpro4', 'codestpro5', 'spg_cuenta', 'codfuefin', 'codcencos', 'procede_doc', 'documento', 'operacion'], 'unique', 'targetAttribute' => ['codemp', 'procede', 'comprobante', 'codban', 'ctaban', 'estcla', 'codestpro1', 'codestpro2', 'codestpro3', 'codestpro4', 'codestpro5', 'spg_cuenta', 'codfuefin', 'codcencos', 'procede_doc', 'documento', 'operacion']],
            [['codemp', 'codcencos'], 'exist', 'skipOnError' => true, 'targetClass' => SigespCencosto::className(), 'targetAttribute' => ['codemp' => 'codemp', 'codcencos' => 'codcencos']],
            [['codemp', 'procede', 'comprobante', 'codban', 'ctaban'], 'exist', 'skipOnError' => true, 'targetClass' => SigespCmp::className(), 'targetAttribute' => ['codemp' => 'codemp', 'procede' => 'procede', 'comprobante' => 'comprobante', 'codban' => 'codban', 'ctaban' => 'ctaban']],
            [['codemp', 'estcla', 'codestpro1', 'codestpro2', 'codestpro3', 'codestpro4', 'codestpro5', 'spg_cuenta', 'codfuefin'], 'exist', 'skipOnError' => true, 'targetClass' => SpgCuentaFuentefinanciamiento::className(), 'targetAttribute' => ['codemp' => 'codemp', 'estcla' => 'estcla', 'codestpro1' => 'codestpro1', 'codestpro2' => 'codestpro2', 'codestpro3' => 'codestpro3', 'codestpro4' => 'codestpro4', 'codestpro5' => 'codestpro5', 'spg_cuenta' => 'spg_cuenta', 'codfuefin' => 'codfuefin']],
            [['codemp', 'estcla', 'codestpro1', 'codestpro2', 'codestpro3', 'codestpro4', 'codestpro5', 'spg_cuenta'], 'exist', 'skipOnError' => true, 'targetClass' => SpgCuentas::className(), 'targetAttribute' => ['codemp' => 'codemp', 'estcla' => 'estcla', 'codestpro1' => 'codestpro1', 'codestpro2' => 'codestpro2', 'codestpro3' => 'codestpro3', 'codestpro4' => 'codestpro4', 'codestpro5' => 'codestpro5', 'spg_cuenta' => 'spg_cuenta']],
            [['operacion'], 'exist', 'skipOnError' => true, 'targetClass' => SpgOperaciones::className(), 'targetAttribute' => ['operacion' => 'operacion']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codemp' => 'Codemp',
            'procede' => 'Procede',
            'comprobante' => 'Comprobante',
            'codban' => 'Codban',
            'ctaban' => 'Ctaban',
            'estcla' => 'Estcla',
            'codestpro1' => 'Codestpro1',
            'codestpro2' => 'Codestpro2',
            'codestpro3' => 'Codestpro3',
            'codestpro4' => 'Codestpro4',
            'codestpro5' => 'Codestpro5',
            'spg_cuenta' => 'Spg Cuenta',
            'codfuefin' => 'Codfuefin',
            'codcencos' => 'Codcencos',
            'procede_doc' => 'Procede Doc',
            'documento' => 'Documento',
            'operacion' => 'Operacion',
            'fecha' => 'Fecha',
            'descripcion' => 'Descripcion',
            'monto' => 'Monto',
            'orden' => 'Orden',
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
    public function getCodemp1()
    {
        return $this->hasOne(SigespCmp::className(), ['codemp' => 'codemp', 'procede' => 'procede', 'comprobante' => 'comprobante', 'codban' => 'codban', 'ctaban' => 'ctaban']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp2()
    {
        return $this->hasOne(SpgCuentaFuentefinanciamiento::className(), ['codemp' => 'codemp', 'estcla' => 'estcla', 'codestpro1' => 'codestpro1', 'codestpro2' => 'codestpro2', 'codestpro3' => 'codestpro3', 'codestpro4' => 'codestpro4', 'codestpro5' => 'codestpro5', 'spg_cuenta' => 'spg_cuenta', 'codfuefin' => 'codfuefin']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp3()
    {
        return $this->hasOne(SpgCuentas::className(), ['codemp' => 'codemp', 'estcla' => 'estcla', 'codestpro1' => 'codestpro1', 'codestpro2' => 'codestpro2', 'codestpro3' => 'codestpro3', 'codestpro4' => 'codestpro4', 'codestpro5' => 'codestpro5', 'spg_cuenta' => 'spg_cuenta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperacion0()
    {
        return $this->hasOne(SpgOperaciones::className(), ['operacion' => 'operacion']);
    }
}
