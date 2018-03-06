<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sno_hsalida".
 *
 * @property string $codemp
 * @property string $codnom
 * @property string $codper
 * @property string $anocur
 * @property string $codperi
 * @property string $codconc
 * @property string $tipsal
 * @property double $valsal
 * @property double $monacusal
 * @property double $salsal
 * @property double $priquisal
 * @property double $segquisal
 *
 * @property SnoHpersonalnomina $codemp0
 */
class Snohsalida extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sno_hsalida';
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
            [['codemp', 'codnom', 'codper', 'anocur', 'codperi', 'codconc', 'tipsal'], 'required'],
            [['valsal', 'monacusal', 'salsal', 'priquisal', 'segquisal'], 'number'],
            [['codemp', 'codnom', 'anocur'], 'string', 'max' => 4],
            [['codper', 'codconc'], 'string', 'max' => 10],
            [['codperi'], 'string', 'max' => 3],
            [['tipsal'], 'string', 'max' => 2],
            [['codemp', 'codnom', 'codper', 'anocur', 'codperi', 'codconc', 'tipsal'], 'unique', 'targetAttribute' => ['codemp', 'codnom', 'codper', 'anocur', 'codperi', 'codconc', 'tipsal']],
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
            'codper' => 'Codper',
            'anocur' => 'Anocur',
            'codperi' => 'Codperi',
            'codconc' => 'Concepto',
            'tipsal' => 'Tipsal',
            'valsal' => 'Monto',
            'monacusal' => 'Monacusal',
            'salsal' => 'Salsal',
            'priquisal' => 'Priquisal',
            'segquisal' => 'Segquisal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp0()
    {
        return $this->hasOne(SnoHpersonalnomina::className(), ['codemp' => 'codemp', 'codnom' => 'codnom', 'codper' => 'codper', 'anocur' => 'anocur', 'codperi' => 'codperi']);
    }
}
