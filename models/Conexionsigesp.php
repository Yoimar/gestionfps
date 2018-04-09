<?php

namespace app\models;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;

use Yii;

/**
 * This is the model class for table "conexionsigesp".
 *
 * @property int $id
 * @property int $id_presupuesto
 * @property int $rif
 * @property string $req
 * @property string $codestpre
 * @property string $cuenta
 * @property string $date
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 * @property string $estatus_sigesp
 * @property string $date_compromiso
 * @property int $compromiso_by
 * @property string $numrecdoc
 * @property string $date_regdocorpa
 * @property int $regdocorpa_by
 * @property string $date_aprdocorpa
 * @property int $aprdocorpa_by
 * @property string $orpa
 * @property string $date_orpa
 * @property int $orpa_by
 * @property string $date_aprorpa
 * @property int $aprorpa_by
 * @property string $date_causado
 * @property int $causado_by
 * @property string $date_progpago
 * @property int $progpago_by
 *
 * @property Presupuestos $presupuesto
 */
class Conexionsigesp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'conexionsigesp';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_presupuesto', 'rif', 'created_by', 'updated_by', 'compromiso_by', 'regdocorpa_by', 'aprdocorpa_by', 'orpa_by', 'aprorpa_by', 'causado_by', 'progpago_by'], 'default', 'value' => null],
            [['id_presupuesto', 'rif', 'created_by', 'updated_by', 'compromiso_by', 'regdocorpa_by', 'aprdocorpa_by', 'orpa_by', 'aprorpa_by', 'causado_by', 'progpago_by'], 'integer'],
            [['codestpre'], 'string'],
            [['date', 'created_at', 'updated_at', 'date_compromiso', 'date_regdocorpa', 'date_aprdocorpa', 'date_orpa', 'date_aprorpa', 'date_causado', 'date_progpago'], 'safe'],
            [['req', 'numrecdoc', 'orpa'], 'string', 'max' => 15],
            [['cuenta'], 'string', 'max' => 25],
            [['estatus_sigesp'], 'string', 'max' => 3],
            [['id_presupuesto'], 'exist', 'skipOnError' => true, 'targetClass' => Presupuestos::className(), 'targetAttribute' => ['id_presupuesto' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_presupuesto' => 'Id Presupuesto',
            'rif' => 'Rif',
            'req' => 'Req',
            'codestpre' => 'Codestpre',
            'cuenta' => 'Cuenta',
            'date' => 'Date',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'estatus_sigesp' => 'Estatus Sigesp',
            'date_compromiso' => 'Date Compromiso',
            'compromiso_by' => 'Compromiso By',
            'numrecdoc' => 'Numrecdoc',
            'date_regdocorpa' => 'Date Regdocorpa',
            'regdocorpa_by' => 'Regdocorpa By',
            'date_aprdocorpa' => 'Date Aprdocorpa',
            'aprdocorpa_by' => 'Aprdocorpa By',
            'orpa' => 'Orpa',
            'date_orpa' => 'Date Orpa',
            'orpa_by' => 'Orpa By',
            'date_aprorpa' => 'Date Aprorpa',
            'aprorpa_by' => 'Aprorpa By',
            'date_causado' => 'Date Causado',
            'causado_by' => 'Causado By',
            'date_progpago' => 'Date Progpago',
            'progpago_by' => 'Progpago By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresupuesto()
    {
        return $this->hasOne(Presupuestos::className(), ['id' => 'id_presupuesto']);
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => Yii::$app->formatter->asDate('now','php:m-d-Y H:i:s'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],

        ];
    }
}
