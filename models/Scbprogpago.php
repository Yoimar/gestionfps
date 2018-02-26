<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scb_prog_pago".
 *
 * @property string $codemp
 * @property string $codban
 * @property string $ctaban
 * @property string $numsol
 * @property string $fecpropag
 * @property string $estmov
 * @property string $codusu
 * @property int $esttipvia
 *
 * @property CxpSolicitudes $codemp0
 * @property ScbCtabanco $codemp1
 */
class Scbprogpago extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_prog_pago';
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
            [['codemp', 'codban', 'ctaban', 'numsol', 'fecpropag', 'estmov'], 'required'],
            [['fecpropag'], 'safe'],
            [['esttipvia'], 'default', 'value' => null],
            [['esttipvia'], 'integer'],
            [['codemp'], 'string', 'max' => 4],
            [['codban'], 'string', 'max' => 3],
            [['ctaban'], 'string', 'max' => 25],
            [['numsol'], 'string', 'max' => 15],
            [['estmov'], 'string', 'max' => 1],
            [['codusu'], 'string', 'max' => 50],
            [['codemp', 'codban', 'ctaban', 'numsol', 'fecpropag'], 'unique', 'targetAttribute' => ['codemp', 'codban', 'ctaban', 'numsol', 'fecpropag']],
            [['codemp', 'numsol'], 'exist', 'skipOnError' => true, 'targetClass' => CxpSolicitudes::className(), 'targetAttribute' => ['codemp' => 'codemp', 'numsol' => 'numsol']],
            [['codemp', 'codban', 'ctaban'], 'exist', 'skipOnError' => true, 'targetClass' => ScbCtabanco::className(), 'targetAttribute' => ['codemp' => 'codemp', 'codban' => 'codban', 'ctaban' => 'ctaban']],
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
            'numsol' => 'Numsol',
            'fecpropag' => 'Fecpropag',
            'estmov' => 'Estmov',
            'codusu' => 'Codusu',
            'esttipvia' => 'Esttipvia',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp0()
    {
        return $this->hasOne(CxpSolicitudes::className(), ['codemp' => 'codemp', 'numsol' => 'numsol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp1()
    {
        return $this->hasOne(ScbCtabanco::className(), ['codemp' => 'codemp', 'codban' => 'codban', 'ctaban' => 'ctaban']);
    }
}
