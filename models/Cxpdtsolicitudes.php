<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cxp_dt_solicitudes".
 *
 * @property string $codemp
 * @property string $numsol
 * @property string $numrecdoc
 * @property string $codtipdoc
 * @property string $ced_bene
 * @property string $cod_pro ID interno de proveedor
 * @property double $monto
 *
 * @property CxpRd $codemp0
 * @property CxpSolicitudes $codemp1
 * @property CxpSolDc[] $cxpSolDcs
 */
class Cxpdtsolicitudes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cxp_dt_solicitudes';
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
            [['codemp', 'numsol', 'numrecdoc', 'codtipdoc', 'ced_bene', 'cod_pro'], 'required'],
            [['monto'], 'number'],
            [['codemp'], 'string', 'max' => 4],
            [['numsol', 'numrecdoc'], 'string', 'max' => 15],
            [['codtipdoc'], 'string', 'max' => 5],
            [['ced_bene', 'cod_pro'], 'string', 'max' => 10],
            [['codemp', 'numsol', 'numrecdoc', 'codtipdoc', 'ced_bene', 'cod_pro'], 'unique', 'targetAttribute' => ['codemp', 'numsol', 'numrecdoc', 'codtipdoc', 'ced_bene', 'cod_pro']],
            [['codemp', 'numrecdoc', 'codtipdoc', 'ced_bene', 'cod_pro'], 'exist', 'skipOnError' => true, 'targetClass' => CxpRd::className(), 'targetAttribute' => ['codemp' => 'codemp', 'numrecdoc' => 'numrecdoc', 'codtipdoc' => 'codtipdoc', 'ced_bene' => 'ced_bene', 'cod_pro' => 'cod_pro']],
            [['codemp', 'numsol'], 'exist', 'skipOnError' => true, 'targetClass' => CxpSolicitudes::className(), 'targetAttribute' => ['codemp' => 'codemp', 'numsol' => 'numsol']],
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
            'numrecdoc' => 'Numrecdoc',
            'codtipdoc' => 'Codtipdoc',
            'ced_bene' => 'Ced Bene',
            'cod_pro' => 'Cod Pro',
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
        return $this->hasOne(CxpSolicitudes::className(), ['codemp' => 'codemp', 'numsol' => 'numsol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCxpSolDcs()
    {
        return $this->hasMany(CxpSolDc::className(), ['codemp' => 'codemp', 'numsol' => 'numsol', 'numrecdoc' => 'numrecdoc', 'codtipdoc' => 'codtipdoc', 'ced_bene' => 'ced_bene', 'cod_pro' => 'cod_pro']);
    }
}
