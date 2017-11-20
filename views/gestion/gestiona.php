<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Solicitudes;
use app\models\Estatus1;
use app\models\Estatus2;
use app\models\Estatus3;
use app\models\Trabajador;
use kartik\grid\GridView;
use kartik\mpdf\Pdf;
use app\models\Users;
use app\models\Areas;
use app\models\Recepciones;
use app\models\Presupuestos;
use app\models\Gestion;

$defaultExportConfig = [
    GridView::TEXT => [
        'label' => 'Exportar a Formato TXT',
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
        'label' => 'Exportar a Excel',
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
        'label' => 'Exportar a PDF',
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
            'destination' => 'I', 
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
                'SetHeader'=>['<center><h1>Envio</h1></center>'], 
                'SetFooter'=>['{PAGENO}'],
            ],
            'options' => [
                'title' => $this->title,
                'subject' => 'PDF export generated by kartik-v/yii2-grid extension',
                'keywords' => 'krajee, grid, export, yii2-grid, pdf',
            ],
//            'contentBefore'=>'',
//            'contentAfter'=>''
        ]
    ],

];

?>



<?php     
    $columns = [
            [
            'class'=>'kartik\grid\CheckboxColumn',
            'headerOptions'=>['class'=>'kartik-sheet-style'],
            ],
        
            [
            'class'=>'kartik\grid\SerialColumn',
            'contentOptions'=>['class'=>'kartik-sheet-style'],
            'width'=>'36px',
            'header'=>'',
            'headerOptions'=>['class'=>'kartik-sheet-style']
            ],
        
            [
            'class'=>'kartik\grid\ExpandRowColumn',
            'width'=>'50px',
            'value'=>function ($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detail'=>function ($model, $key, $index, $column) {
                return Yii::$app->controller->renderPartial('_form', ['model'=>$model]);
            },
            'headerOptions'=>['class'=>'kartik-sheet-style'],
            'expandOneOnly'=>true,
            ],

            [
            'attribute' => 'solicitud_id',
            'value' => 'num_solicitud',
            'label' => 'N°<br>Solicitud',
            'encodeLabel' => false,
            'format' => 'text',
            ],
                    
            [
            'attribute' => 'requerimiento',
            'value' => 'requerimiento',
            'format' => 'text',
            ],
                    
            [
            'attribute' => 'iddoc',
            'value' => 'iddoc',
            'format' => 'text',
            ],
            
            [
            'attribute' => 'fechaingreso',
            'value' => 'fechaingreso',
            'format' => 'text',
            'label' => 'Fecha<br>Ingreso',
            'format' => 'text',
            'encodeLabel' => false,
            ],
            
            [
            'attribute' => 'fechaultimamodificacion',
            'value' => 'fechaultimamodificacion',
            'label' => 'Fecha<br>Modificación',
            'format' => 'text',
            'encodeLabel' => false,
            ],
        
            [ 
            'attribute' => 'beneficiario', 				
            'value' => 'beneficiario', 
            'format' => 'text', 
            ],
        
            [ 
            'attribute' => 'cibeneficiario', 				
            'value' => 'cibeneficiario', 
            'format' => 'text', 
            ],
        
            [                     
            'attribute' => 'edadbeneficiario', 			
            'value' => 'edadbeneficiario', 
            'format' => 'text',
            'visible'=> false,
            ],
        
            [                     
            'attribute' => 'telefono', 			
            'value' => 'telefono', 
            'format' => 'text',
            'visible'=> false,
            ],
                   
            [ 
            'attribute' => 'empresaoinstitucion', 		
            'value' => 'empresaoinstitucion',
            'label' => 'Empresa<br>Casa Comercial',
            'format' => 'text',
            'encodeLabel' => false,
            ],
            
            [ 
            'attribute' => 'rif', 		
            'value' => 'rif', 
            'format' => 'text',
            ],
     
            [ 
            'attribute' => 'cantidad', 						
            'value' => 'cantidad',
            'label' => 'N°',
            'format' => 'text',
            //'visible'=> false,
            ],
            
            [ 
            'attribute' => 'orpa', 						
            'value' => 'orpa', 
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
            'attribute' => 'monto', 						
            'value' => 'monto', 
            'hAlign'=>'right', 
            'vAlign'=>'middle',
            'width'=>'100px',
            'format'=>'currency',
            'pageSummary'=>true,
            ],
            
            //[
            //'class'=>'kartik\grid\ActionColumn',
            //],
            
        ];

?>

<!-- Aqui termina el div, y empieza el container -->
                <br>
                <center>
                <h1>Gestión</h1>
                </center>
                <br>
            
<?=Html::dropDownList('action','',['Holassss'=>'Mark selected as: ','Hello'=>'Confirmed','Hi'=>'No Confirmed'],['class'=>'dropdown',])?>
<?=Html::submitButton('Send', ['class' => 'btn btn-info',]);?>               

<?php
    echo GridView::widget([
        'id'=>'kv-grid-gestion',
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'columns'=>$columns,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'pjax'=>true, // pjax is set to always true for this demo
        // set your toolbar
        'toolbar'=> [
            ['content'=>
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-gestion'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>'Reset Grid'])
            ],
            '{export}',
            '{toggleData}'
        ],
        // set export properties
        'export'=>[
            'fontAwesome'=>true
        ],
        // parameters from the demo form
        'bordered'=>true,
        'striped'=>true,
        'condensed'=>true,
        'responsive'=>true,
        'hover'=>true,
        'showPageSummary'=>true,
        'panel'=>[
            'type'=>GridView::TYPE_INFO,
            'heading'=>'<center><i class="glyphicon glyphicon-eye-open"></i>Cambio de Estatus<i class="glyphicon glyphicon-eye-open"></i>'
            . '</center>',
        ],
        'persistResize'=>false,
        'toggleDataOptions'=>['minCount'=>10],
        'exportConfig'=>$defaultExportConfig,
    ]);

?>
                
?>



</div>
