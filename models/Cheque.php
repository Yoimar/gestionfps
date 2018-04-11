<?php

namespace app\models;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;

use Yii;

/**
 * This is the model class for table "cheque".
 *
 * @property string $cheque
 * @property int $id_presupuesto
 * @property string $estatus_cheque
 * @property string $date_cheque
 * @property int $cheque_by
 * @property string $date_enviofirma
 * @property string $date_enviocaja
 * @property string $date_reccaja
 * @property string $date_entregado
 * @property int $entregado_by
 * @property int $retirado_personaid
 * @property int $responsable_by
 * @property int $imagenentrega_id
 * @property string $date_anulado
 * @property string $motivo_anulado
 * @property int $anulado_by
 * @property string $date_archivo
 * @property int $archivo_by
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 *
 * @property Presupuestos $presupuesto
 */
class Cheque extends \yii\db\ActiveRecord
{
    //Constantes utilizadas para hacer la entrega del cheque o del caso

    public $solicitante;
    public $cisolicitante;
    public $beneficiario;
    public $cibeneficiario;
    public $tratamiento;
    public $especialidad;
    public $recepcion;
    public $necesidad;
    public $tipodeayuda;
    public $telefono;
    public $rif;
    public $orpa;
    public $num_solicitud;




    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cheque';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cheque'], 'required'],
            [['id_presupuesto', 'cheque_by', 'entregado_by', 'retirado_personaid', 'responsable_by', 'imagenentrega_id', 'anulado_by', 'archivo_by', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['id_presupuesto', 'cheque_by', 'entregado_by', 'retirado_personaid', 'responsable_by', 'imagenentrega_id', 'anulado_by', 'archivo_by', 'created_by', 'updated_by'], 'integer'],
            [['date_cheque', 'date_enviofirma', 'date_enviocaja', 'date_reccaja', 'date_entregado', 'date_anulado', 'date_archivo', 'created_at', 'updated_at'], 'safe'],
            [['motivo_anulado'], 'string'],
            [['cheque'], 'string', 'max' => 15],
            [['estatus_cheque'], 'string', 'max' => 3],
            [['cheque'], 'unique'],
            [['id_presupuesto'], 'exist', 'skipOnError' => true, 'targetClass' => Presupuestos::className(), 'targetAttribute' => ['id_presupuesto' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cheque' => 'Cheque',
            'id_presupuesto' => 'id_presupuesto',
            'estatus_cheque' => 'Estatus Cheque',
            'date_cheque' => 'Fecha Emitido',
            'cheque_by' => 'Cheque Impreso por:',
            'date_enviofirma' => 'Fecha Envio Firma',
            'date_enviocaja' => 'Fecha Envio Caja',
            'date_reccaja' => 'Fecha de Recepción en Caja',
            'date_entregado' => 'Fecha Entregado',
            'entregado_by' => 'Entregado por:',
            'retirado_personaid' => 'Retirado Por:',
            'responsable_by' => 'Responsable de la Entrega',
            'imagenentrega_id' => 'Id Imagen de Entrega',
            'date_anulado' => 'Fecha Anulado',
            'motivo_anulado' => 'Motivo Anulado',
            'anulado_by' => 'Anulado Por',
            'date_archivo' => 'Fecha Archivo',
            'archivo_by' => 'Enviado a Archivo por:',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
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
                'value' => Yii::$app->formatter->asDate('now','php:m-d-Y H:i:s'),
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
