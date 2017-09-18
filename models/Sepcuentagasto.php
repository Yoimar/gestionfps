<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sep_cuentagasto".
 *
 * @property string $codemp
 * @property string $numsol
 * @property string $codestpro1
 * @property string $codestpro2
 * @property string $codestpro3
 * @property string $codestpro4
 * @property string $codestpro5
 * @property string $estcla
 * @property string $spg_cuenta
 * @property string $codfuefin
 * @property string $codcencos
 * @property double $monto
 *
 * @property SepSolicitud $codemp0
 * @property SigespCencosto $codemp1
 */
class Sepcuentagasto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sep_cuentagasto';
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
            [['codemp', 'numsol', 'codestpro1', 'codestpro2', 'codestpro3', 'codestpro4', 'codestpro5', 'estcla', 'spg_cuenta', 'codfuefin', 'codcencos'], 'required'],
            [['monto'], 'number'],
            [['codemp'], 'string', 'max' => 4],
            [['numsol'], 'string', 'max' => 15],
            [['codestpro1', 'codestpro2', 'codestpro3', 'codestpro4', 'codestpro5', 'spg_cuenta'], 'string', 'max' => 25],
            [['estcla'], 'string', 'max' => 1],
            [['codfuefin'], 'string', 'max' => 2],
            [['codcencos'], 'string', 'max' => 3],
            [['codemp', 'numsol'], 'exist', 'skipOnError' => true, 'targetClass' => SepSolicitud::className(), 'targetAttribute' => ['codemp' => 'codemp', 'numsol' => 'numsol']],
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
            'numsol' => 'Numsol',
            'codestpro1' => 'Codestpro1',
            'codestpro2' => 'Codestpro2',
            'codestpro3' => 'Codestpro3',
            'codestpro4' => 'Codestpro4',
            'codestpro5' => 'Codestpro5',
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
        return $this->hasOne(SepSolicitud::className(), ['codemp' => 'codemp', 'numsol' => 'numsol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp1()
    {
        return $this->hasOne(SigespCencosto::className(), ['codemp' => 'codemp', 'codcencos' => 'codcencos']);
    }
}
