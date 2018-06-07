<?php

namespace app\models;
use kartik\builder\TabularForm;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use app\models\Empresainstitucion;
use app\models\Requerimientos;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\helpers\Url;

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
            return true;
        } else {
            return false;
        }
    }

    public function getEmpresainstitucion()
    {
        return $this->hasOne(Empresainstitucion::className(), ['id' => 'beneficiario_id']);
    }

    public function getFormAttribs() {
        $inicial = $this->beneficiario_id;

    return [
        // primary key column
        'id'=>[ // primary key attribute
            'type'=>TabularForm::INPUT_HIDDEN,
            'columnOptions'=>['hidden'=>true]
        ],
        /*'beneficiario_id'=>[
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => Select2::className(),
            'options' => [
                'data' => ArrayHelper::map(Empresainstitucion::find()->orderBy('nombrecompleto')->asArray()->all(), 'id', 'nombrecompleto'),
                'options' => ['placeholder' => 'Empresa Institucion Casa Comercial'],
            ],
            'columnOptions' => ['width' => '200px']
        ],*/
        'beneficiario_id'=>[
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => Select2::className(),

            'options' => [
            'initValueText'=>ArrayHelper::map(Empresainstitucion::find()->select(["id", "concat(nombrecompleto,' // ', 'rif: ',' ',nrif) as nombrecompleto"])->orderBy('nombrecompleto')->asArray()->all(), 'id', 'nombrecompleto'),
            'options' => ['placeholder' => 'Ingrese la casa comercial', 'class' => 'container center-block','language' => 'es',],
            'language' => 'es',
            'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 4,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Esperando los resultados...'; }"),
            ],
            'ajax' => [
                'url' => Url::to(['//empresainstitucion/listaempresas']),
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(empresainstitucion) { return empresainstitucion.text; }'),
            'templateSelection' => new JsExpression('function (empresainstitucion) { return empresainstitucion.text; }'),
            ],

        ],
            'columnOptions' => ['width' => '200px']
        ],

        /*'solicitud_id'=>[
            'type'=>TabularForm::INPUT_STATIC,
            'label'=>'Sell',
            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
        ],*/
        'requerimiento_id'=>[
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => Select2::className(),
            'label'=>'Requerimiento',
            'options' => [
                'data' => ArrayHelper::map(Requerimientos::find()->orderBy('nombre')->asArray()->all(), 'id', 'nombre'),
                'options' => ['placeholder' => 'Requerimiento'],
            ],
            'columnOptions'=>['hAlign'=>GridView::ALIGN_CENTER, 'width'=>'90px']
        ],
        'proceso_id'=>[
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => Select2::className(),
            'label'=>'Proceso',
            'options' => [
                'data' => ArrayHelper::map(Procesos::find()->orderBy('nombre')->asArray()->all(), 'id', 'nombre'),
                'options' => ['placeholder' => 'Proceso'],
            ],
            'columnOptions'=>['hAlign'=>GridView::ALIGN_CENTER, 'width'=>'90px']
        ],
        /*'documento_id'=>[
            'type'=>TabularForm::INPUT_STATIC,
            'label'=>'Sell',
            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
        ],*/
        /*'moneda'=>[
            'type'=>TabularForm::INPUT_STATIC,
            'label'=>'Sell',
            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
        ],*/
        'cantidad'=>[
            'type'=>TabularForm::INPUT_HTML5,
            'html5type'=> 'number',
            'label'=>'Cantidad',
            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
        ],
        'monto'=>[
            'type' => TabularForm::INPUT_TEXT,
            'options'=>['class'=>'form-control text-right'],
            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT],
            'label'=>'Monto Solicitado',
        ],
        'montoapr'=>[
            'label'=>'Monto Aprobado',
            'type' => TabularForm::INPUT_TEXT,
            'options'=>['class'=>'form-control text-right'],
            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT],
        ],/*
        'estatus_doc'=>[
            'type'=>TabularForm::INPUT_STATIC,
            'label'=>'Sell',
            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
        ],
        'cheque'=>[
            'type'=>TabularForm::INPUT_STATIC,
            'label'=>'Sell',
            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
        ],
        'version'=>[
            'type'=>TabularForm::INPUT_STATIC,
            'label'=>'Sell',
            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
        ],
        'created_at'=>[
            'type'=>TabularForm::INPUT_STATIC,
            'label'=>'Sell',
            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
        ],
        'updated_at'=>[
            'type'=>TabularForm::INPUT_STATIC,
            'label'=>'Sell',
            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
        ],
        'numop'=>[
            'type'=>TabularForm::INPUT_STATIC,
            'label'=>'Sell',
            'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
        ],*/

    ];
    }

}
