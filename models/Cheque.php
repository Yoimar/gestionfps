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
            'id_presupuesto' => 'Id Presupuesto',
            'estatus_cheque' => 'Estatus Cheque',
            'date_cheque' => 'Date Cheque',
            'cheque_by' => 'Cheque By',
            'date_enviofirma' => 'Date Enviofirma',
            'date_enviocaja' => 'Date Enviocaja',
            'date_reccaja' => 'Date Reccaja',
            'date_entregado' => 'Date Entregado',
            'entregado_by' => 'Entregado By',
            'retirado_personaid' => 'Retirado Personaid',
            'responsable_by' => 'Responsable By',
            'imagenentrega_id' => 'Imagenentrega ID',
            'date_anulado' => 'Date Anulado',
            'motivo_anulado' => 'Motivo Anulado',
            'anulado_by' => 'Anulado By',
            'date_archivo' => 'Date Archivo',
            'archivo_by' => 'Archivo By',
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
