<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "spg_dt_unidadadministrativa".
 *
 * @property string $codemp
 * @property string $coduniadm
 * @property string $codestpro1
 * @property string $codestpro2
 * @property string $codestpro3
 * @property string $codestpro4
 * @property string $codestpro5
 * @property string $estcla
 * @property string $central
 *
 * @property CxpRd[] $cxpRds
 * @property ScbFondosavance[] $scbFondosavances
 * @property SepSolicitud[] $sepSolicituds
 * @property SocOrdencompra[] $socOrdencompras
 * @property SpgUnidadadministrativa $codemp0
 */
class Spgdtunidadadministrativa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'spg_dt_unidadadministrativa';
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
            [['codemp', 'coduniadm', 'codestpro1', 'codestpro2', 'codestpro3', 'codestpro4', 'codestpro5', 'estcla'], 'required'],
            [['codemp'], 'string', 'max' => 4],
            [['coduniadm'], 'string', 'max' => 10],
            [['codestpro1', 'codestpro2', 'codestpro3', 'codestpro4', 'codestpro5'], 'string', 'max' => 25],
            [['estcla', 'central'], 'string', 'max' => 1],
            [['codemp', 'coduniadm'], 'exist', 'skipOnError' => true, 'targetClass' => SpgUnidadadministrativa::className(), 'targetAttribute' => ['codemp' => 'codemp', 'coduniadm' => 'coduniadm']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codemp' => 'Codemp',
            'coduniadm' => 'Coduniadm',
            'codestpro1' => 'Codestpro1',
            'codestpro2' => 'Codestpro2',
            'codestpro3' => 'Codestpro3',
            'codestpro4' => 'Codestpro4',
            'codestpro5' => 'Codestpro5',
            'estcla' => 'Estcla',
            'central' => 'Central',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCxpRds()
    {
        return $this->hasMany(CxpRd::className(), ['codemp' => 'codemp', 'coduniadm' => 'coduniadm', 'codestpro1' => 'codestpro1', 'codestpro2' => 'codestpro2', 'codestpro3' => 'codestpro3', 'codestpro4' => 'codestpro4', 'codestpro5' => 'codestpro5', 'estcla' => 'estcla']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbFondosavances()
    {
        return $this->hasMany(ScbFondosavance::className(), ['codemp' => 'codemp', 'coduniadm' => 'coduniadm', 'codestpro1' => 'codestpro1', 'codestpro2' => 'codestpro2', 'codestpro3' => 'codestpro3', 'codestpro4' => 'codestpro4', 'codestpro5' => 'codestpro5', 'estcla' => 'estcla']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSepSolicituds()
    {
        return $this->hasMany(SepSolicitud::className(), ['codemp' => 'codemp', 'coduniadm' => 'coduniadm', 'codestpro1' => 'codestpro1', 'codestpro2' => 'codestpro2', 'codestpro3' => 'codestpro3', 'codestpro4' => 'codestpro4', 'codestpro5' => 'codestpro5', 'estcla' => 'estcla']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocOrdencompras()
    {
        return $this->hasMany(SocOrdencompra::className(), ['codemp' => 'codemp', 'coduniadm' => 'coduniadm', 'codestpro1' => 'codestpro1', 'codestpro2' => 'codestpro2', 'codestpro3' => 'codestpro3', 'codestpro4' => 'codestpro4', 'codestpro5' => 'codestpro5', 'estcla' => 'estcla']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp0()
    {
        return $this->hasOne(SpgUnidadadministrativa::className(), ['codemp' => 'codemp', 'coduniadm' => 'coduniadm']);
    }
}
