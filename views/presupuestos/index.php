<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Programaevento;
use app\models\Solicitudes;
use app\models\Convenio;
use app\models\Estatus1;
use app\models\Estatus2;
use app\models\Estatus3;
use app\models\Tipodecontacto;
use app\models\Trabajador;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;
use kartik\dynagrid\Module;
use kartik\mpdf\Pdf;
use Punic\Calendar;
use app\models\Users;
use app\models\Areas;
use app\models\Recepciones;
use app\models\Presupuestos;

$mesespanish = ArrayHelper::map([
    ['id' => '1', 'Mesactividad' => 'Enero'],
    ['id' => '2', 'Mesactividad' => 'Febrero'],
    ['id' => '3', 'Mesactividad' => 'Marzo'],
    ['id' => '4', 'Mesactividad' => 'Abril'],
    ['id' => '5', 'Mesactividad' => 'Mayo'],
    ['id' => '6', 'Mesactividad' => 'Junio'],
    ['id' => '7', 'Mesactividad' => 'Julio'],
    ['id' => '8', 'Mesactividad' => 'Agosto'],
    ['id' => '9', 'Mesactividad' => 'Septiembre'],
    ['id' => '10', 'Mesactividad' => 'Octubre'],
    ['id' => '11', 'Mesactividad' => 'Noviembre'],
    ['id' => '12', 'Mesactividad' => 'Diciembre']
    ], 'id', 'Mesactividad');

$defaultExportConfig = [
    GridView::HTML => [
        'label' => 'HTML',
        'iconOptions' => ['class' => 'text-info'],
        'showHeader' => true,
        'showPageSummary' => true,
        'showFooter' => true,
        'showCaption' => true,
        'filename' => 'grid-export',
        'alertMsg' => 'The HTML export file will be generated for download.',
        'options' => ['title' => 'Hyper Text Markup Language'],
        'mime' => 'text/html',
        'config' => [
            'cssFile' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'
        ]
    ],
    GridView::CSV => [
        'label' => 'CSV',
        'iconOptions' => ['class' => 'text-primary'],
        'showHeader' => true,
        'showPageSummary' => true,
        'showFooter' => true,
        'showCaption' => true,
        'filename' => 'grid-export',
        'alertMsg' => 'The CSV export file will be generated for download.',
        'options' => ['title' => 'Comma Separated Values'],
        'mime' => 'application/csv',
        'config' => [
            'colDelimiter' => ",",
            'rowDelimiter' => "\r\n",
        ]
    ],
    GridView::TEXT => [
        'label' => 'Text',
        'iconOptions' => ['class' => 'text-muted'],
        'showHeader' => true,
        'showPageSummary' => true,
        'showFooter' => true,
        'showCaption' => true,
        'filename' => 'grid-export',
        'alertMsg' => 'The TEXT export file will be generated for download.',
        'options' => ['title' => 'Tab Delimited Text'],
        'mime' => 'text/plain',
        'config' => [
            'colDelimiter' => "\t",
            'rowDelimiter' => "\r\n",
        ]
    ],
    GridView::EXCEL => [
        'label' => 'Excel',
        'iconOptions' => ['class' => 'text-success'],
        'showHeader' => true,
        'showPageSummary' => true,
        'showFooter' => true,
        'showCaption' => true,
        'filename' => 'Gestiones',
        'alertMsg' => 'The EXCEL export file will be generated for download.',
        'options' => ['title' => 'Microsoft Excel 95+'],
        'mime' => 'application/vnd.ms-excel',
        'config' => [
            'worksheet' => 'ExportWorksheet',
            'cssFile' => ''
        ]
    ],
    GridView::PDF => [
        'label' => 'PDF',
        'iconOptions' => ['class' => 'text-danger'],
        'showHeader' => true,
        'showPageSummary' => true,
        'showFooter' => true,
        'showCaption' => true,
        'filename' => 'Gestiones',
        'alertMsg' => 'El Reporte de Gestiones será generado',
        'options' => ['title' => 'Portable Document Format'],
        'mime' => 'application/pdf',
        'config' => [
            'mode' => 'c',
            'format' => 'Letter',
            'destination' => 'D',
            'orientation' => 'L',
            'marginTop' => 20,
            'marginBottom' => 20,
            'cssInline' => '.kv-wrap{padding:20px;}' .
                '.kv-align-center{text-align:center;font-size:10 px;}' .
                '.kv-grid-table{font-size:10 px;}'.
                '.kv-align-left{text-align:left;}' .
                '.kv-align-right{text-align:right;}' .
                '.kv-align-top{vertical-align:top!important;}' .
                '.kv-align-bottom{vertical-align:bottom!important;}' .
                '.kv-align-middle{vertical-align:middle!important;font-size:10 px;}' .
                '.kv-page-summary{border-top:4px double #ddd;font-weight: bold;}' .
                '.kv-table-footer{border-top:4px double #ddd;font-weight: bold;}' .
                '.kv-table-caption{font-size:0.5em;padding:8px;border:1px solid #ddd;border-bottom:none;}',
            'methods' => [
                'SetHeader'=>['<h1>Reporte de Gestiones</h1>'],
                'SetFooter'=>['{PAGENO}'],
            ],
            'options' => [
                'title' => $this->title,
                'subject' => 'PDF export generated by kartik-v/yii2-grid extension',
                'keywords' => 'krajee, grid, export, yii2-grid, pdf',
            ],
            'contentBefore'=>'',
            'contentAfter'=>''
        ]
    ],
    GridView::JSON => [
        'label' => 'JSON',
        'iconOptions' => ['class' => 'text-warning'],
        'showHeader' => true,
        'showPageSummary' => true,
        'showFooter' => true,
        'showCaption' => true,
        'filename' => 'grid-export',
        'alertMsg' => 'The JSON export file will be generated for download.',
        'options' => ['title' => 'JavaScript Object Notation'],
        'mime' => 'application/json',
        'config' => [
            'colHeads' => [],
            'slugColHeads' => false,
            'jsonReplacer' => null,
            'indentSpace' => 4
        ]
    ],
];
/* @var $this yii\web\View */
/* @var $searchModel app\models\GestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Presupuestos';
?>
<?php
    $columns = [
            ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],

            //'id',
            //'programaevento_id',
            [
            'attribute' => 'programaevento_id',
            'value' => 'programaevento.descripcion',
            'format' => 'text',
            'visible'=> false,
            ],
            // 'solicitud_id',
            [
            'attribute' => 'num_solicitud',
            'value' => 'num_solicitud',
            'hAlign'=>'middle',
            'vAlign'=>'middle',
            'format' => 'text',
            ],
            //'convenio_id',
            [
            'attribute' => 'convenio_id',
            'value' => 'convenio.nombre',
            'format' => 'text',
            'visible'=> false,
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Convenio::find()->orderBy('nombre')->all(), 'id', 'nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Convenio?'],
            ],
            //'estatus3_id',
            [
            'attribute' => 'estatus1_id',
            'value' => 'estatus1_id',
            'format' => 'text',
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Estatus1::find()->orderBy('nombre')->all(), 'nombre', 'nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Estatus 1?'],
            ],
            [
            'attribute' => 'estatus2_id',
            'value' => 'estatus2_id',
            'format' => 'text',
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Estatus2::find()->orderBy('nombre')->all(), 'nombre', 'nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Estatus 2?'],
            ],
            [
            'attribute' => 'estatus3_id',
            'value' => 'estatus3_id',
            'format' => 'text',
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Estatus3::find()->orderBy('nombre')->all(), 'id', 'nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Estatus 3?'],
            ],
            //'tipodecontacto_id',
            [
            'attribute' => 'tipodecontacto_id',
            'value' => 'tipodecontacto.nombre',
            'format' => 'text',
            'visible'=> false,
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Tipodecontacto::find()->orderBy('nombre')->all(), 'id', 'nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Contacto?'],
            ],

            [
            'class'=>'kartik\grid\BooleanColumn',
            'attribute'=>'militar_solicitante',
            'vAlign'=>'middle',
            'visible'=> false,
            ],
            [
            'attribute' => 'rango_solicitante_id',
            'value' => 'rangosolicitante.nombre',
            'format' => 'text',
            'visible'=> false,
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(app\models\Rangosmilitares::find()->orderBy('nombre')->all(), 'id', 'nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Rango Solicitante?'],
            ],


            [
            'class'=>'kartik\grid\BooleanColumn',
            'attribute'=>'militar_beneficiario',
            'vAlign'=>'middle',
            'visible'=> false,
            ],

            [
            'attribute' => 'rango_beneficiario_id',
            'value' => 'rangobeneficiario.nombre',
            'format' => 'text',
            'visible'=> false,
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(app\models\Rangosmilitares::find()->orderBy('nombre')->all(), 'id', 'nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Rango Beneficiario?'],
            ],

            [
            'attribute' => 'afrodescendiente',
            'value' => 'afrodescendiente',
            'format' => 'text',
            'visible'=> false,
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map([['id' => 'Si', 'nombre' => 'Si'],['id' => 'No', 'nombre' => 'No']], 'id', 'nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Afrodescendiente?'],
            ],

            [
            'attribute' => 'indigena',
            'value' => 'indigena',
            'format' => 'text',
            'visible'=> false,
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map([['id' => 'Si', 'nombre' => 'Si'],['id' => 'No', 'nombre' => 'No']], 'id', 'nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Indigena?'],
            ],

            [
            'attribute' => 'sexodiversidad',
            'value' => 'sexodiversidad',
            'format' => 'text',
            'visible'=> false,
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map([['id' => 'Si', 'nombre' => 'Si'],['id' => 'No', 'nombre' => 'No']], 'id', 'nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Sexodiversidad?'],
            ],

            //'trabajador_id',
            [
            'attribute' => 'trabajador_id',
            'value' => 'num_solicitud',
            'hAlign'=>'middle',
            'vAlign'=>'middle',
            'format' => 'raw',
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Trabajador::find()->asArray()->all(),'id', function($model, $defaultValue) {
                        return $model['dimprofesion'].' '.$model['primernombre'].' '.$model['primerapellido'];}),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Trabajador?'],
            ],
            //'created_at',
            //'created_by',
            // 'updated_at',
            // 'updated_by',
            [
            'attribute' => 'mes_actividad',
            'value' => 'mes_actividad',
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'format' => 'text',
            'visible'=> false,
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => $mesespanish,
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Mes Programa?'],
            ],
            [
            'attribute' => 'solicitante',
            'value' => 'solicitante',
            'hAlign'=>'middle',
            'vAlign'=>'middle',
            'format' => 'text',
            'visible'=> false,
            ],
            [
            'attribute' => 'cisolicitante',
            'value' => 'cisolicitante',
            'hAlign'=>'middle',
            'vAlign'=>'middle',
            'format' => 'text',
            'visible'=> false,
            ],
            [
            'attribute' => 'beneficiario',
            'value' => 'beneficiario',
            'hAlign'=>'middle',
            'vAlign'=>'middle',
            'format' => 'text',
            ],
            [
            'attribute' => 'cibeneficiario',
            'value' => 'cibeneficiario',
            'hAlign'=>'middle',
            'vAlign'=>'middle',
            'format' => 'text',
            ],
            [
            'attribute' => 'tratamiento',
            'value' => 'tratamiento',
            'hAlign'=>'middle',
            'vAlign'=>'middle',
            'format' => 'text',
            'visible'=> false,
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(app\models\Requerimientos::find()->orderBy('nombre')->all(), 'nombre', 'nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Tratamiento?'],
            ],
            [
            'attribute' => 'rif',
            'value' => 'rif',
            'hAlign'=>'middle',
            'vAlign'=>'middle',
            'format' => 'text',
            'visible'=> false,
            ],
            [
            'attribute' => 'documento',
            'value' => 'documento',
            'format' => 'text',
            'hAlign'=>'middle',
            'vAlign'=>'middle',
            'visible'=> false,
            ],
            [
            'attribute' => 'numop',
            'value' => 'numop',
            'hAlign'=>'middle',
            'vAlign'=>'middle',
            'format' => 'text',
            'visible'=> false,
            ],
            [
            'class'=>'kartik\grid\BooleanColumn',
            'attribute' => 'nino',
            'vAlign'=>'middle',
            'visible'=> false,
            ],
            [
            'attribute' => 'trabajadorsocial',
            'value' => 'trabajadorsocial',
            'format' => 'text',
            'visible'=> false,
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(app\models\Users::find()->where(['activated' => 'TRUE'])->orderBy('nombre')->all(), 'nombre', 'nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Trabajador Social?'],
            ],
            [
            'attribute' => 'especialidad',
            'value' => 'especialidad',
            'format' => 'text',
            'visible'=> false,
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(app\models\Areas::find()->orderBy('nombre')->all(), 'nombre', 'nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Especialidad?'],
            ],
            [
            'attribute' => 'recepcion',
            'value' => 'recepcion',
            'format' => 'text',
            'visible'=> false,
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(app\models\Recepciones::find()->orderBy('nombre')->all(), 'nombre', 'nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Recepción?'],
            ],
            [
            'attribute' => 'necesidad',
            'value' => 'solicitud.necesidad',
            'format' => 'text',
            'visible'=> false,
            ],
            [
            'attribute' => 'monto',
            'value' => 'monto',
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'100px',
            'format'=>['decimal', 2],
            'pageSummary'=>true,
            'visible'=> false,
            ],
            [
            'attribute' => 'montoapr',
            'value' => 'montoapr',
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'100px',
            'format'=>['decimal', 2],
            'pageSummary'=>true,
            'visible'=> false,
            ],
            [
            'attribute' => 'trabajadoracargoactividad',
            'value' => 'trabajadoracargoactividad',
            'format' => 'text',
            'visible'=> false,
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Trabajador::find()->select(["CONCAT(dimprofesion, ' ',primernombre,' ', primerapellido) as nombre"])->asArray()->all(), 'nombre', 'nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Trabajador a Cargo?'],
            ],
            [
            'attribute' => 'mesingreso',
            'value' => 'mesingreso',
            'format' => 'text',
            'visible'=> false,
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => $mesespanish,
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Mes Programa?'],
            ],
            [
            'attribute' => 'estado_actividad',
            'value' => 'estado_actividad',
            'format' => 'text',
            'visible' => false,
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(app\models\Estados::find()->orderBy('nombre')->all(), 'nombre','nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Estado Actividad?'],
            ],
            [
            'attribute' => 'tipodeayuda',
            'value' => 'tipodeayuda',
            'format' => 'text',
            'visible'=> false,
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(app\models\TipoAyudas::find()->orderBy('nombre')->all(), 'nombre','nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Tipo Ayuda?'],
            ],
            [
            'attribute' => 'estatussa',
            'value' => 'estatussa',
            'format' => 'text',
            'visible'=> false,
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(app\models\Estatussasyc::find()->orderBy('estatus')->all(), 'estatus', 'estatus'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Estatus SASYC?'],
            ],
            [
            'attribute' => 'empresaoinstitucion',
            'value' => 'empresaoinstitucion',
            'vAlign'=>'middle',
            'format' => 'text',
            'visible'=> false,
            ],
            [
            'attribute' => 'proceso',
            'value' => 'proceso',
            'vAlign'=>'middle',
            'format' => 'text',
            'visible'=> false,
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(app\models\Procesos::find()->orderBy('nombre')->all(), 'nombre', 'nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Proceso?'],
            ],
            [
            'attribute' => 'cantidad',
            'value' => 'cantidad',
            'hAlign'=>'middle',
            'vAlign'=>'middle',
            'width'=>'100px',
            'format'=>['decimal', 0],
            'pageSummary'=>true,
            'visible'=> false,
            ],
            [
            'attribute' => 'descripcion',
            'value' => 'descripcion',
            'format' => 'text',
            'visible'=> false,
            ],
            [
            'attribute' => 'diasdeultimamodificacion',
            'value' => 'diasdeultimamodificacion',
            'format' => 'text',
            'visible'=> false,
            ],
            [
            'attribute' => 'diasdesolicitud',
            'value' => 'diasdesolicitud',
            'format' => 'text',
            'visible'=> false,
            ],
            [
            'attribute' => 'diasdesdeactividad',
            'value' => 'diasdesdeactividad',
            'format' => 'text',
            'visible'=> false,
            ],
            [
            'attribute' => 'cheque',
            'value' => 'cheque',
            'format' => 'text',
            'visible'=> false,
            ],
            [
            'attribute' => 'anodelasolicitud',
            'value' => 'anodelasolicitud',
            'format' => 'text',
            'visible'=> false,
            ],
            [
            'attribute' => 'direccion',
            'value' => 'direccion',
            'format' => 'text',
            'visible'=> false,
            ],
            [
            'attribute' => 'fechaactividad',
            'value' => 'fechaactividad',
            'format' => 'text',
            'visible'=> false,
            ],
            [
            'attribute' => 'fechaingreso',
            'value' => 'fechaingreso',
            'format' => 'text',
            'visible'=> false,
            ],
            [
            'attribute' => 'fechaultimamodificacion',
            'value' => 'fechaultimamodificacion',
            'format' => 'text',
            'visible'=> false,
            ],
            [
            'attribute' => 'estadodireccion',
            'value' => 'estadodireccion',
            'format' => 'text',
            'visible'=> false,
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(app\models\Estados::find()->orderBy('nombre')->all(), 'nombre','nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Estado Beneficiario?'],
            ],
            [
            'attribute' => 'edadbeneficiario',
            'value' => 'edadbeneficiario',
            'format' => 'text',
            'visible'=> false,
            ],



            [
            'class'=>'kartik\grid\ActionColumn',
            ],

            ['class'=>'kartik\grid\CheckboxColumn', 'order'=>DynaGrid::ORDER_FIX_RIGHT],
        ];
/*[
    ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
    [
        'attribute'=>'name',
        'pageSummary'=>'Page Total',
        'vAlign'=>'middle',
        'order'=>DynaGrid::ORDER_FIX_LEFT
    ],
    [
        'attribute'=>'color',
        'value'=>function ($model, $key, $index, $widget) {
            return "<span class='badge' style='background-color: {$model->color}'> </span>  <code>" .
                $model->color . '</code>';
        },
        'filterType'=>GridView::FILTER_COLOR,
        'filterWidgetOptions'=>[
            'showDefaultPalette'=>false,
            'pluginOptions'=>[
                'showPalette'=>true,
                'showPaletteOnly'=>true,
                'showSelectionPalette'=>true,
                'showAlpha'=>false,
                'allowEmpty'=>false,
                'preferredFormat'=>'name',
                'palette'=>[
                    [
                        "white", "black", "grey", "silver", "gold", "brown",
                    ],
                    [
                        "red", "orange", "yellow", "indigo", "maroon", "pink"
                    ],
                    [
                        "blue", "green", "violet", "cyan", "magenta", "purple",
                    ],
                ]
            ],
        ],
        'vAlign'=>'middle',
        'format'=>'raw',
        'width'=>'150px',
        'noWrap'=>true
    ],
    [
        'attribute'=>'publish_date',
        'filterType'=>GridView::FILTER_DATE,
        'format'=>'raw',
        'width'=>'170px',
        'filterWidgetOptions'=>[
            'pluginOptions'=>['format'=>'yyyy-mm-dd']
        ],
        'visible'=>false,
    ],
    [
        'attribute'=>'author_id',
        'vAlign'=>'middle',
        'width'=>'250px',
        'value'=>function ($model, $key, $index, $widget) {
            return Html::a($model->author->name, '#', [
                'title'=>'View author detail',
                'onclick'=>'alert("This will open the author page.\n\nDisabled for this demo!")'
            ]);
        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map(Author::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Any author'],
        'format'=>'raw'
    ],
    [
        'attribute'=>'buy_amount',
        'hAlign'=>'right',
        'vAlign'=>'middle',
        'width'=>'100px',
        'format'=>['decimal', 2],
        'pageSummary'=>true
    ],
    [
        'attribute'=>'sell_amount',
        'vAlign'=>'middle',
        'hAlign'=>'right',
        'width'=>'100px',
        'format'=>['decimal', 2],
        'pageSummary'=>true
    ],
    [
        'class'=>'kartik\grid\BooleanColumn',
        'attribute'=>'status',
        'vAlign'=>'middle',
    ],
    [
        'class'=>'kartik\grid\ActionColumn',
        'dropdown'=>false,
        'urlCreator'=>function($action, $model, $key, $index) { return '#'; },
        'viewOptions'=>['title'=>$viewMsg, 'data-toggle'=>'tooltip'],
        'updateOptions'=>['title'=>$updateMsg, 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['title'=>$deleteMsg, 'data-toggle'=>'tooltip'],
        'order'=>DynaGrid::ORDER_FIX_RIGHT
    ],
    ['class'=>'kartik\grid\CheckboxColumn', 'order'=>DynaGrid::ORDER_FIX_RIGHT],
];*/
?>

<!-- Aqui termina el div, y empieza el container -->
</div>

<?php

$dynagrid = DynaGrid::begin([
    'columns'=>$columns,
    'theme'=>'panel-info',
    'showPersonalize'=>true,
    'storage'=>'session',
    'gridOptions'=>[
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'exportConfig' => $defaultExportConfig,
        'showPageSummary'=>true,
        'floatHeader'=>false,
        'pjax'=>true,
        'panel'=>[
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-heart"></i><i class="glyphicon glyphicon-ok"></i>Busqueda de Casos por Presupuesto</h3>',
            'before' =>  '<div style="padding-top: 7px;"><em>Aqui encontraras todas las gestiones hechas a los casos de la Fundación Pueblo Soberano divididos por Presupuesto</em></div>',
            'after' => false,
        ],
        'toolbar' =>  [
            ['content'=>
                Html::a('Crear Presupuesto', ['create'], ['class' => 'btn btn-success']). ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>'Reset Grid']). ' '.
                Html::a('Borrar Presupuesto', ['delete'], ['class' => 'btn btn-warning'])
            ],
            ['content'=>'{dynagridFilter}{dynagridSort}{dynagrid}'],
            '{export}',
        ]
    ],
    'options'=>['id'=>'dynagrid-2', 'class' => 'container-fluid'] // a unique identifier is important
]);
if (substr($dynagrid->theme, 0, 6) == 'simple') {
    $dynagrid->gridOptions['panel'] = false;
}
DynaGrid::end();
?>
</div>
