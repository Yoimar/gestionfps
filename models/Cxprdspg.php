<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cxp_rd_spg".
 *
 * @property string $codemp
 * @property string $numrecdoc
 * @property string $codtipdoc
 * @property string $ced_bene
 * @property string $cod_pro ID interno de proveedor
 * @property string $procede_doc
 * @property string $numdoccom
 * @property string $codestpro
 * @property string $estcla
 * @property string $spg_cuenta
 * @property string $codfuefin
 * @property string $codcencos
 * @property double $monto
 *
 * @property CxpRd $codemp0
 * @property SigespCencosto $codemp1
 */
class Cxprdspg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cxp_rd_spg';
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
            [['codemp', 'numrecdoc', 'codtipdoc', 'ced_bene', 'cod_pro', 'procede_doc', 'numdoccom', 'codestpro', 'estcla', 'spg_cuenta', 'codfuefin', 'codcencos'], 'required'],
            [['monto'], 'number'],
            [['codemp'], 'string', 'max' => 4],
            [['numrecdoc', 'numdoccom'], 'string', 'max' => 15],
            [['codtipdoc'], 'string', 'max' => 5],
            [['ced_bene', 'cod_pro'], 'string', 'max' => 10],
            [['procede_doc'], 'string', 'max' => 6],
            [['codestpro'], 'string', 'max' => 125],
            [['estcla'], 'string', 'max' => 1],
            [['spg_cuenta'], 'string', 'max' => 25],
            [['codfuefin'], 'string', 'max' => 2],
            [['codcencos'], 'string', 'max' => 3],
            [['codemp', 'numrecdoc', 'codtipdoc', 'ced_bene', 'cod_pro', 'procede_doc', 'numdoccom', 'codestpro', 'estcla', 'spg_cuenta', 'codfuefin', 'codcencos'], 'unique', 'targetAttribute' => ['codemp', 'numrecdoc', 'codtipdoc', 'ced_bene', 'cod_pro', 'procede_doc', 'numdoccom', 'codestpro', 'estcla', 'spg_cuenta', 'codfuefin', 'codcencos']],
            [['codemp', 'numrecdoc', 'codtipdoc', 'ced_bene', 'cod_pro'], 'exist', 'skipOnError' => true, 'targetClass' => CxpRd::className(), 'targetAttribute' => ['codemp' => 'codemp', 'numrecdoc' => 'numrecdoc', 'codtipdoc' => 'codtipdoc', 'ced_bene' => 'ced_bene', 'cod_pro' => 'cod_pro']],
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
            'numrecdoc' => 'Numrecdoc',
            'codtipdoc' => 'Codtipdoc',
            'ced_bene' => 'Ced Bene',
            'cod_pro' => 'Cod Pro',
            'procede_doc' => 'Procede Doc',
            'numdoccom' => 'Numdoccom',
            'codestpro' => 'Codestpro',
            'estcla' => 'Estcla',
            'spg_cuenta' => 'Spg Cuenta',
            'codfuefin' => 'Codfuefin',
            'codcencos' => 'Codcencos',
            'monto' => 'Monto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp0()
    {
        return $this->hasOne(CxpRd::className(), ['codemp' => 'codemp', 'numrecdoc' => 'numrecdoc', 'codtipdoc' => 'codtipdoc', 'ced_bene' => 'ced_bene', 'cod_pro' => 'cod_pro']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp1()
    {
        return $this->hasOne(SigespCencosto::className(), ['codemp' => 'codemp', 'codcencos' => 'codcencos']);
    }
}
