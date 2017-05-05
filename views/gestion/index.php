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

$mesespanish = ArrayHelper::map([
    ['id' => '01', 'Mesactividad' => 'Enero'],
    ['id' => '02', 'Mesactividad' => 'Febrero'],
    ['id' => '03', 'Mesactividad' => 'Marzo'],
    ['id' => '04', 'Mesactividad' => 'Abril'],
    ['id' => '05', 'Mesactividad' => 'Mayo'],
    ['id' => '06', 'Mesactividad' => 'Junio'],
    ['id' => '07', 'Mesactividad' => 'Julio'],
    ['id' => '08', 'Mesactividad' => 'Agosto'],
    ['id' => '09', 'Mesactividad' => 'Septiembre'],
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

$this->title = 'Gestiones';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php     
    $columns = [
            ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],

            //'id',
            //'programaevento_id',
            [
            'attribute' => 'programaevento_id',
            'value' => 'programaevento.descripcion',
            'format' => 'raw',
            ],
            // 'solicitud_id',
            [
            'attribute' => 'solicitud_id',
            'value' => 'solicitud.num_solicitud',
            'format' => 'raw',
            ],
            //'convenio_id',
            [
            'attribute' => 'convenio_id',
            'value' => 'convenio.nombre',
            'format' => 'raw',
            ],
            //'estatus3_id',
            [
            'attribute' => 'estatus1_id',
            'value' => 'estatus1.nombre',
            'format' => 'text',
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Estatus1::find()->orderBy('nombre')->all(), 'id', 'nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Estatus 1?'],
            ],
            [
            'attribute' => 'estatus2_id',
            'value' => 'estatus2.nombre',
            'format' => 'text',
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Estatus2::find()->orderBy('nombre')->all(), 'id', 'nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Estatus 2?'],
            ],
            [
            'attribute' => 'estatus3_id',
            'value' => 'estatus3.nombre',
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
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Tipodecontacto::find()->orderBy('nombre')->all(), 'id', 'nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Contacto?'],
            ],
            'militar_solicitante:boolean',
            'rango_solicitante_id',
            'militar_beneficiario:boolean',
            'rango_beneficiario_id',
            'afrodescendiente',
            'indigena',
            'sexodiversidad',
            //'trabajador_id',
            [
            'attribute' => 'trabajador_id',
            'value' => 'trabajador.Trabajadorfps',
            'format' => 'raw',
            ],
            //'created_at',
            //'created_by',
            // 'updated_at',
            // 'updated_by',
            [ 
            'attribute' => 'mes_actividad', 				
            'value' => 'programaevento.Mesactividad',
            'format' => 'text',
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => $mesespanish,
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Mes Programa?'],
            ],
            [ 
            'attribute' => 'solicitante', 				
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'cisolicitante', 				
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'beneficiario', 				
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'cibeneficiario', 				
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'tratamiento', 				
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'nino', 						
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'trabajadorsocial', 			
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'especialidad', 				
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'recepciones', 				
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'necesidad', 					
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'monto', 						
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'trabajadoracargoactividad', 	
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'mesingreso', 					
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'estado_actividad', 			
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'tipodeayuda', 				
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'estatussasyc', 				
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'empresaoinstitucion', 		
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'proceso', 					
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'cantidad', 					
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'descripcion', 				
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'diasdeultimamodificacion', 	
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'diasdesolicitud', 			
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'diasdesdeactividad',
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'cheque', 						
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'fechadelcheque', 				
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'anodelasolicitud', 			
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'direccion', 					
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'fechaactividad', 				
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'fechaingreso', 				
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'estadodireccion', 			
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
            ],
            [ 
            'attribute' => 'fechaultimamodificacion', 	
            'value' => 'estatus1.nombre', 
            'format' => 'text', 
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
        'floatHeader'=>true,
        'pjax'=>true,
        'panel'=>[
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-heart"></i><i class="glyphicon glyphicon-ok"></i>  Gestiones Fundación Pueblo Soberano</h3>',
            'before' =>  '<div style="padding-top: 7px;"><em>Aqui encontraras todas las gestiones hechas a los casos de la Fundación Pueblo Soberano</em></div>',
            'after' => false
        ],        
        'toolbar' =>  [
            ['content'=>
                Html::a('Crear Gestión', ['create'], ['class' => 'btn btn-success']). ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>'Reset Grid'])
            ],
            ['content'=>'{dynagridFilter}{dynagridSort}{dynagrid}'],
            '{export}',
        ]
    ],
    'options'=>['id'=>'dynagrid-1'] // a unique identifier is important
]);
if (substr($dynagrid->theme, 0, 6) == 'simple') {
    $dynagrid->gridOptions['panel'] = false;
}  
DynaGrid::end();
?>
</div>
