<?php

namespace app\models;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

use Yii;

/**
 * This is the model class for table "solicitudes".
 *
 * @property integer $id
 * @property string $descripcion
 * @property integer $persona_beneficiario_id
 * @property integer $persona_solicitante_id
 * @property integer $area_id
 * @property integer $referente_id
 * @property integer $recepcion_id
 * @property integer $organismo_id
 * @property boolean $ind_mismo_benef
 * @property boolean $ind_inmediata
 * @property boolean $ind_beneficiario_menor
 * @property string $actividad
 * @property string $referencia
 * @property string $referencia_externa
 * @property string $accion_tomada
 * @property string $necesidad
 * @property string $tipo_proc
 * @property integer $num_proc
 * @property string $facturas
 * @property string $observaciones
 * @property string $moneda
 * @property string $estatus
 * @property integer $usuario_asignacion_id
 * @property integer $usuario_autorizacion_id
 * @property string $fecha_asignacion
 * @property string $fecha_aceptacion
 * @property string $fecha_aprobacion
 * @property string $fecha_cierre
 * @property integer $tipo_vivienda_id
 * @property integer $tenencia_id
 * @property integer $departamento_id
 * @property integer $memo_id
 * @property string $informe_social
 * @property string $total_ingresos
 * @property string $beneficiario_json
 * @property string $solicitante_json
 * @property string $num_solicitud
 * @property integer $version
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Bitacoras[] $bitacoras
 * @property FotosSolicitud[] $fotosSolicituds
 * @property Gestion[] $gestions
 * @property HistorialSolicitudes[] $historialSolicitudes
 * @property Llamada[] $llamadas
 * @property RecaudoSolicitud[] $recaudoSolicituds
 * @property Areas $area
 * @property Organismos $organismo
 * @property Personas $personaBeneficiario
 * @property Personas $personaSolicitante
 * @property Recepciones $recepcion
 * @property Referentes $referente
 * @property Users $usuarioAsignacion
 * @property Users $usuarioAutorizacion
 */
class Solicitudes extends \yii\db\ActiveRecord
{
    public $persona_beneficiario_ci;
    public $persona_solicitante_ci;
    public $persona_beneficiario_nombre;
    public $persona_beneficiario_apellido;
    public $persona_solicitante_nombre;
    public $persona_solicitante_apellido;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'solicitudes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'area_id', 'referente_id', 'recepcion_id', 'organismo_id', 'necesidad', 'estatus'], 'required'],
            [['persona_beneficiario_id', 'persona_beneficiario_ci', 'persona_solicitante_ci', 'persona_solicitante_id', 'area_id', 'referente_id', 'recepcion_id', 'organismo_id', 'num_proc', 'usuario_asignacion_id', 'usuario_autorizacion_id', 'tipo_vivienda_id', 'tenencia_id', 'departamento_id', 'memo_id', 'version'], 'integer'],
            [['moneda',], 'default', 'value' => 'VEF'],
            [['fecha_asignacion', 'persona_beneficiario_nombre', 'persona_beneficiario_apellido', 'persona_solicitante_nombre', 'persona_solicitante_apellido', 'fecha_aceptacion', 'fecha_aprobacion', 'fecha_cierre', 'created_at', 'updated_at'], 'safe'],
            [['informe_social', 'beneficiario_json', 'solicitante_json'], 'string'],
            [['total_ingresos'], 'number'],
            [['ind_mismo_benef', 'ind_inmediata', 'ind_beneficiario_menor'], 'boolean', 'trueValue' => TRUE, 'falseValue' => FALSE],
            [['descripcion', 'actividad', 'referencia', 'accion_tomada'], 'string', 'max' => 2000],
            [['ind_mismo_benef', 'ind_inmediata', 'ind_beneficiario_menor'], 'default', 'value' => FALSE],
            [['referencia_externa', 'facturas'], 'string', 'max' => 100],
            [['necesidad', 'observaciones'], 'string', 'max' => 1500],
            [['tipo_proc'], 'string', 'max' => 5],
            [['moneda', 'estatus'], 'string', 'max' => 3],
            [['num_solicitud'], 'string', 'max' => 8],
            [['area_id'], 'exist', 'skipOnError' => true, 'targetClass' => Areas::className(), 'targetAttribute' => ['area_id' => 'id']],
            [['organismo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organismos::className(), 'targetAttribute' => ['organismo_id' => 'id']],
            [['persona_beneficiario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['persona_beneficiario_id' => 'id']],
            [['persona_solicitante_id'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['persona_solicitante_id' => 'id']],
            [['recepcion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Recepciones::className(), 'targetAttribute' => ['recepcion_id' => 'id']],
            [['referente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Referentes::className(), 'targetAttribute' => ['referente_id' => 'id']],
            [['usuario_asignacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['usuario_asignacion_id' => 'id']],
            [['usuario_autorizacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['usuario_autorizacion_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
            'persona_beneficiario_id' => 'Persona Beneficiario ID',
            'persona_solicitante_id' => 'Persona Solicitante ID',
            'area_id' => 'Area ID',
            'referente_id' => 'Referente ID',
            'recepcion_id' => 'Recepcion ID',
            'organismo_id' => 'Organismo ID',
            'ind_mismo_benef' => 'Indique si es el Mismo Beneficiario',
            'ind_inmediata' => 'Ind Inmediata',
            'ind_beneficiario_menor' => 'Indique si el Beneficiario es Menor de Edad',
            'actividad' => 'Actividad',
            'referencia' => 'Referencia',
            'referencia_externa' => 'Referencia Externa',
            'accion_tomada' => 'Accion Tomada',
            'necesidad' => 'Necesidad',
            'tipo_proc' => 'Tipo Proc',
            'num_proc' => 'Num Proc',
            'facturas' => 'Facturas',
            'observaciones' => 'Observaciones',
            'moneda' => 'Moneda',
            'estatus' => 'Estatus',
            'usuario_asignacion_id' => 'Usuario Asignacion ID',
            'usuario_autorizacion_id' => 'Usuario Autorizacion ID',
            'fecha_asignacion' => 'Fecha Asignacion',
            'fecha_aceptacion' => 'Fecha Aceptacion',
            'fecha_aprobacion' => 'Fecha Aprobacion',
            'fecha_cierre' => 'Fecha Cierre',
            'tipo_vivienda_id' => 'Tipo Vivienda ID',
            'tenencia_id' => 'Tenencia ID',
            'departamento_id' => 'Departamento ID',
            'memo_id' => 'Memo ID',
            'informe_social' => 'Informe Social',
            'total_ingresos' => 'Total Ingresos',
            'beneficiario_json' => 'Beneficiario Json',
            'solicitante_json' => 'Solicitante Json',
            'num_solicitud' => 'Num Solicitud',
            'version' => 'Version',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBitacoras()
    {
        return $this->hasMany(Bitacoras::className(), ['solicitud_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFotosSolicituds()
    {
        return $this->hasMany(FotosSolicitud::className(), ['solicitud_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGestions()
    {
        return $this->hasMany(Gestion::className(), ['solicitud_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistorialSolicitudes()
    {
        return $this->hasMany(HistorialSolicitudes::className(), ['solicitud_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLlamadas()
    {
        return $this->hasMany(Llamada::className(), ['solicitud_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecaudoSolicituds()
    {
        return $this->hasMany(RecaudoSolicitud::className(), ['solicitud_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArea()
    {
        return $this->hasOne(Areas::className(), ['id' => 'area_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganismo()
    {
        return $this->hasOne(Organismos::className(), ['id' => 'organismo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas()
    {
        return $this->hasOne(Personas::className(), ['id' => 'persona_beneficiario_id','id' => 'persona_solicitante_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecepcion()
    {
        return $this->hasOne(Recepciones::className(), ['id' => 'recepcion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReferente()
    {
        return $this->hasOne(Referentes::className(), ['id' => 'referente_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'usuario_asignacion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioAutorizacion()
    {
        return $this->hasOne(Users::className(), ['id' => 'usuario_autorizacion_id']);
    }
    
    public function getEstatussasyc()
    {
        return $this->hasOne(Estatussasyc::className(), ['id' => 'estatus']);
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

        ];
    }
    
    public function beforeSave($insert) {
       
        if (parent::beforeSave($insert)) {
            $this->version = ($this->version +1);
            if ($this->isNewRecord) {
                $numero = $this->calcularnumsolicitud();
                $numero = date('y') . '-' . $this->formatonumsolicitud($numero);
                $this->num_solicitud = $numero;
            }
            return true;
        } else {
            return false;
        }           
    }
    /* Para contar el numero de solicitudes e insertar un nuevo registro*/
    public function calcularnumsolicitud() {
        $consulta = Solicitudes::find()
            ->andFilterWhere(['=',"extract(year from created_at)", date('Y')])
            ->count();
        
        return $consulta + 1;
    }
    
    /* Para colocar el numero de solicitud con cinco Números */ 
    public function formatonumsolicitud($numero) {
        if ($numero <= 9) {
            $numero = "0000" . $numero;
        } else if ($numero <= 99) {
            $numero = "000" . $numero;
        } else if ($numero <= 999) {
            $numero = "00" . $numero;
        } else if ($numero <= 9999) {
            $numero = "0" . $numero;
        }
        return $numero;
    }
    
    
    
}
