<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scb_movbco_spg".
 *
 * @property string $codemp
 * @property string $codban
 * @property string $ctaban
 * @property string $numdoc
 * @property string $codope
 * @property string $estmov
 * @property string $codestpro
 * @property string $estcla
 * @property string $spg_cuenta
 * @property string $codfuefin
 * @property string $codcencos
 * @property string $documento
 * @property string $operacion
 * @property string $desmov
 * @property string $procede_doc
 * @property double $monto
 *
 * @property ScbMovbco $codemp0
 * @property SigespCencosto $codemp1
 */
class Scbmovbcospg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_movbco_spg';
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
            [['codemp', 'codban', 'ctaban', 'numdoc', 'codope', 'estmov', 'codestpro', 'estcla', 'spg_cuenta', 'codfuefin', 'codcencos', 'documento', 'desmov', 'procede_doc'], 'required'],
            [['desmov'], 'string'],
            [['monto'], 'number'],
            [['codemp'], 'string', 'max' => 4],
            [['codban', 'codcencos', 'operacion'], 'string', 'max' => 3],
            [['ctaban', 'spg_cuenta'], 'string', 'max' => 25],
            [['numdoc', 'documento'], 'string', 'max' => 15],
            [['codope', 'codfuefin'], 'string', 'max' => 2],
            [['estmov', 'estcla'], 'string', 'max' => 1],
            [['codestpro'], 'string', 'max' => 125],
            [['procede_doc'], 'string', 'max' => 6],
            [['codemp', 'codban', 'ctaban', 'numdoc', 'codope', 'estmov', 'codestpro', 'estcla', 'spg_cuenta', 'codfuefin', 'codcencos', 'documento'], 'unique', 'targetAttribute' => ['codemp', 'codban', 'ctaban', 'numdoc', 'codope', 'estmov', 'codestpro', 'estcla', 'spg_cuenta', 'codfuefin', 'codcencos', 'documento']],
            [['codemp', 'codban', 'ctaban', 'numdoc', 'codope', 'estmov'], 'exist', 'skipOnError' => true, 'targetClass' => ScbMovbco::className(), 'targetAttribute' => ['codemp' => 'codemp', 'codban' => 'codban', 'ctaban' => 'ctaban', 'numdoc' => 'numdoc', 'codope' => 'codope', 'estmov' => 'estmov']],
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
            'codban' => 'Codban',
            'ctaban' => 'Ctaban',
            'numdoc' => 'Numdoc',
            'codope' => 'Codope',
            'estmov' => 'Estmov',
            'codestpro' => 'Codestpro',
            'estcla' => 'Estcla',
            'spg_cuenta' => 'Spg Cuenta',
            'codfuefin' => 'Codfuefin',
            'codcencos' => 'Codcencos',
            'documento' => 'Documento',
            'operacion' => 'Operacion',
            'desmov' => 'Desmov',
            'procede_doc' => 'Procede Doc',
            'monto' => 'Monto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp0()
    {
        return $this->hasOne(ScbMovbco::className(), ['codemp' => 'codemp', 'codban' => 'codban', 'ctaban' => 'ctaban', 'numdoc' => 'numdoc', 'codope' => 'codope', 'estmov' => 'estmov']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp1()
    {
        return $this->hasOne(SigespCencosto::className(), ['codemp' => 'codemp', 'codcencos' => 'codcencos']);
    }
}
