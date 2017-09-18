<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rpc_beneficiario".
 *
 * @property string $codemp
 * @property string $ced_bene
 * @property string $codpai
 * @property string $codest
 * @property string $codmun
 * @property string $codpar
 * @property string $codtipcta
 * @property string $rifben
 * @property string $nombene
 * @property string $apebene
 * @property string $dirbene
 * @property string $telbene
 * @property string $celbene
 * @property string $email
 * @property string $sc_cuenta
 * @property string $codbansig
 * @property string $codban
 * @property string $ctaban
 * @property string $foto
 * @property string $fecregben
 * @property string $nacben
 * @property string $numpasben
 * @property string $tipconben
 * @property string $tipcuebanben
 * @property string $sc_cuentarecdoc
 *
 * @property CxpRd[] $cxpRds
 * @property CxpSolicitudes[] $cxpSolicitudes
 * @property SigespEmpresa $codemp0
 * @property SigespParroquia $codpai0
 * @property RpcDeduxbene[] $rpcDeduxbenes
 * @property SigespDeducciones[] $codemps
 * @property SafMovimiento[] $safMovimientos
 * @property ScbCaja[] $scbCajas
 * @property ScbColocacion[] $scbColocacions
 * @property ScbMovbco[] $scbMovbcos
 * @property SepSolicitud[] $sepSolicituds
 * @property SepSolicitudcargos[] $sepSolicitudcargos
 * @property SigespCmp[] $sigespCmps
 * @property SigespExpediente[] $sigespExpedientes
 */
class Rpcbeneficiario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rpc_beneficiario';
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
            [['codemp', 'ced_bene', 'nombene', 'apebene', 'sc_cuenta', 'codbansig'], 'required'],
            [['dirbene', 'foto'], 'string'],
            [['fecregben'], 'safe'],
            [['codemp'], 'string', 'max' => 4],
            [['ced_bene', 'numpasben'], 'string', 'max' => 10],
            [['codpai', 'codest', 'codmun', 'codpar', 'codtipcta', 'codbansig', 'codban'], 'string', 'max' => 3],
            [['rifben'], 'string', 'max' => 12],
            [['nombene', 'apebene'], 'string', 'max' => 50],
            [['telbene', 'celbene'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 100],
            [['sc_cuenta', 'ctaban', 'sc_cuentarecdoc'], 'string', 'max' => 25],
            [['nacben', 'tipconben', 'tipcuebanben'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codemp' => 'Codemp',
            'ced_bene' => 'Ced Bene',
            'codpai' => 'Codpai',
            'codest' => 'Codest',
            'codmun' => 'Codmun',
            'codpar' => 'Codpar',
            'codtipcta' => 'Codtipcta',
            'rifben' => 'Rifben',
            'nombene' => 'Nombene',
            'apebene' => 'Apebene',
            'dirbene' => 'Dirbene',
            'telbene' => 'Telbene',
            'celbene' => 'Celbene',
            'email' => 'Email',
            'sc_cuenta' => 'Sc Cuenta',
            'codbansig' => 'Codbansig',
            'codban' => 'Codban',
            'ctaban' => 'Ctaban',
            'foto' => 'Foto',
            'fecregben' => 'Fecregben',
            'nacben' => 'Nacben',
            'numpasben' => 'Numpasben',
            'tipconben' => 'Tipconben',
            'tipcuebanben' => 'Tipcuebanben',
            'sc_cuentarecdoc' => 'Sc Cuentarecdoc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCxpRds()
    {
        return $this->hasMany(CxpRd::className(), ['codemp' => 'codemp', 'ced_bene' => 'ced_bene']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCxpSolicitudes()
    {
        return $this->hasMany(CxpSolicitudes::className(), ['codemp' => 'codemp', 'ced_bene' => 'ced_bene']);
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
    public function getCodpai0()
    {
        return $this->hasOne(SigespParroquia::className(), ['codpai' => 'codpai', 'codest' => 'codest', 'codmun' => 'codmun', 'codpar' => 'codpar']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRpcDeduxbenes()
    {
        return $this->hasMany(RpcDeduxbene::className(), ['codemp' => 'codemp', 'ced_bene' => 'ced_bene']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemps()
    {
        return $this->hasMany(SigespDeducciones::className(), ['codemp' => 'codemp', 'codded' => 'codded'])->viaTable('rpc_deduxbene', ['codemp' => 'codemp', 'ced_bene' => 'ced_bene']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSafMovimientos()
    {
        return $this->hasMany(SafMovimiento::className(), ['codemp' => 'codemp', 'ced_bene' => 'ced_bene']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbCajas()
    {
        return $this->hasMany(ScbCaja::className(), ['codemp' => 'codemp', 'ced_bene' => 'ced_bene']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbColocacions()
    {
        return $this->hasMany(ScbColocacion::className(), ['codemp' => 'codemp', 'ced_bene' => 'ced_bene']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbMovbcos()
    {
        return $this->hasMany(ScbMovbco::className(), ['codemp' => 'codemp', 'ced_bene' => 'ced_bene']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSepsolicituds()
    {
        return $this->hasMany(Sepsolicitud::className(), ['codemp' => 'codemp', 'ced_bene' => 'ced_bene']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSepSolicitudcargos()
    {
        return $this->hasMany(SepSolicitudcargos::className(), ['codemp' => 'codemp', 'ced_bene' => 'ced_bene']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSigespCmps()
    {
        return $this->hasMany(SigespCmp::className(), ['codemp' => 'codemp', 'ced_bene' => 'ced_bene']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSigespExpedientes()
    {
        return $this->hasMany(SigespExpediente::className(), ['codemp' => 'codemp', 'ced_bene' => 'ced_bene']);
    }
}
