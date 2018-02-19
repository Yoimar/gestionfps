<?php

namespace app\models;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

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
 * @property string $cheque
 * @property string $date_cheque
 * @property int $cheque_by
 * @property string $date_enviofirma
 * @property string $date_enviocaja
 * @property string $date_entregado
 * @property string $fechahoraregistro_entregado
 * @property string $ci_entrega
 * @property string $nombre_entrega
 * @property string $trabajador_responsableentrega
 * @property int $entregado_by
 * @property string $date_anulado
 * @property string $motivo_anulado
 * @property int $anulado_by
 * @property string $imagen_entrega
 * @property string $date_archivo
 * @property int $archivo_by
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
            [['id_presupuesto', 'rif', 'created_by', 'updated_by', 'compromiso_by', 'regdocorpa_by', 'aprdocorpa_by', 'orpa_by', 'aprorpa_by', 'causado_by', 'progpago_by', 'cheque_by', 'entregado_by', 'anulado_by', 'archivo_by'], 'default', 'value' => null],
            [['id_presupuesto', 'rif', 'created_by', 'updated_by', 'compromiso_by', 'regdocorpa_by', 'aprdocorpa_by', 'orpa_by', 'aprorpa_by', 'causado_by', 'progpago_by', 'cheque_by', 'entregado_by', 'anulado_by', 'archivo_by'], 'integer'],
            [['codestpre', 'motivo_anulado', 'imagen_entrega'], 'string'],
            [['date', 'created_at', 'updated_at', 'date_compromiso', 'date_regdocorpa', 'date_aprdocorpa', 'date_orpa', 'date_aprorpa', 'date_causado', 'date_progpago', 'date_cheque', 'date_enviofirma', 'date_enviocaja', 'date_entregado', 'fechahoraregistro_entregado', 'date_anulado', 'date_archivo'], 'safe'],
            [['req', 'numrecdoc', 'orpa', 'cheque'], 'string', 'max' => 15],
            [['cuenta'], 'string', 'max' => 25],
            [['estatus_sigesp'], 'string', 'max' => 3],
            [['ci_entrega'], 'string', 'max' => 12],
            [['nombre_entrega', 'trabajador_responsableentrega'], 'string', 'max' => 100],
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
            'cheque' => 'Cheque',
            'date_cheque' => 'Date Cheque',
            'cheque_by' => 'Cheque By',
            'date_enviofirma' => 'Date Enviofirma',
            'date_enviocaja' => 'Date Enviocaja',
            'date_entregado' => 'Date Entregado',
            'fechahoraregistro_entregado' => 'Fechahoraregistro Entregado',
            'ci_entrega' => 'Ci Entrega',
            'nombre_entrega' => 'Nombre Entrega',
            'trabajador_responsableentrega' => 'Trabajador Responsableentrega',
            'entregado_by' => 'Entregado By',
            'date_anulado' => 'Date Anulado',
            'motivo_anulado' => 'Motivo Anulado',
            'anulado_by' => 'Anulado By',
            'imagen_entrega' => 'Imagen Entrega',
            'date_archivo' => 'Date Archivo',
            'archivo_by' => 'Archivo By',
        ];
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
                'value' => date('Y-m-d H:i:s'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresupuesto()
    {
        return $this->hasOne(Presupuestos::className(), ['id' => 'id_presupuesto']);
    }
}
