<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "presupuestos".
 *
 * @property integer $id
 * @property integer $solicitud_id
 * @property integer $requerimiento_id
 * @property integer $proceso_id
 * @property integer $documento_id
 * @property string $moneda
 * @property integer $beneficiario_id
 * @property integer $cantidad
 * @property string $monto
 * @property string $montoapr
 * @property string $estatus_doc
 * @property string $cheque
 * @property integer $version
 * @property string $created_at
 * @property string $updated_at
 * @property integer $numop
 */
class Presupuestos extends \yii\db\ActiveRecord
{
    public $estatus1_id;
    public $estatus2_id;
    public $estatus3_id;
    public $mes_actividad;
    public $solicitante;
    public $cisolicitante;
    public $beneficiario;
    public $cibeneficiario;
    public $tratamiento;
    public $nino;
    public $trabajadorsocial;
    public $especialidad;
    public $recepcion;
    public $necesidad;
    public $trabajadoracargoactividad;
    public $mesingreso;
    public $estado_actividad;
    public $tipodeayuda;
    public $estatussa;
    public $empresaoinstitucion;
    public $proceso;
    public $montopre;
    public $descripcion;
    public $diasdeultimamodificacion;
    public $diasdesolicitud;
    public $diasdesdeactividad;
    public $cheque_gestion;
    public $anodelasolicitud;
    public $direccion;
    public $fechaactividad;
    public $fechaingreso;
    public $estadodireccion;
    public $fechaultimamodificacion;
    public $edadbeneficiario;
    public $militar_solicitante;
    public $militar_beneficiario;
    public $num_solicitud;
    public $trabajadorgestion;
    public $documento;
    public $nombre;
    public $rif;
    public $nrif;
    public $orpa;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presupuestos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['solicitud_id', 'requerimiento_id', 'proceso_id', 'created_at', 'updated_at'], 'required'],
            [['solicitud_id', 'requerimiento_id', 'proceso_id', 'documento_id', 'beneficiario_id', 'cantidad', 'version', 'numop'], 'integer'],
            [['monto', 'montoapr'], 'number'],
            [['militar_solicitante', 'militar_beneficiario', 'nino'], 'boolean'],
            [['created_at', 'updated_at'], 'safe'],
            [['moneda', 'estatus_doc'], 'string', 'max' => 3],
            [['cheque'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'solicitud_id' => 'Solicitud',
            'requerimiento_id' => 'Requerimiento ID',
            'proceso_id' => 'Proceso ID',
            'documento_id' => 'Documento ID',
            'moneda' => 'Moneda',
            'beneficiario_id' => 'Beneficiario ID',
            'cantidad' => 'Cantidad',
            'monto' => 'Monto Sol.',
            'montoapr' => 'Monto Apr.',
            'estatus_doc' => 'Estatus Doc',
            'estatussa' => 'Estatus',
            'cheque' => 'Cheque',
            'version' => 'Version',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'numop' => 'Orpa',
            'empresaoinstitucion' => 'Empresa, Institución, Casa Comercial',
        ];
    }
}
