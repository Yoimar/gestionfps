<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Estatus1;
use app\models\Estatus2;
use app\models\Estatus3;
use app\models\Trabajador;
use app\models\Departamentos;
use app\models\Recepciones;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\db\Expression;
use kartik\grid\GridView;
use app\controllers\ActiveDataProvider;
error_reporting(0);

   
$columns = [
//            [
//            'class'=>'kartik\grid\CheckboxColumn',
//            'headerOptions'=>['class'=>'kartik-sheet-style'],
//            'rowSelectedClass' => GridView::TYPE_INFO,
//            'checkboxOptions' => function($model, $key, $index, $column) {
//                    return ['value' => $model->id];
//                },
//
//            ],
        
            [
            'class'=>'kartik\grid\SerialColumn',
            'contentOptions'=>['class'=>'kartik-sheet-style'],
            'width'=>'36px',
            'header'=>'',
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:10px; '],
            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:10px; background: #FFFFFF;'],
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:10px; background: #FFFFFF;'],  
            ],

            [
            'attribute' => 'solicitud_id',
            'value' => 'num_solicitud',
            'label' => 'N°<br>Solicitud',
            'encodeLabel' => false,
            'format' => 'text',
            'vAlign'=>'middle',
            'hAlign'=>'center', 
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:10px; '],
            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:10px; background: #FFFFFF;'],
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:10px; background: #FFFFFF;'],  
            ],
                    
            [
            'attribute' => 'requerimiento',
            'value' => 'requerimiento',
            'format' => 'text',
            'vAlign'=>'middle',
            'hAlign'=>'center', 
            'label' => 'Doc.',
            'encodeLabel' => false,
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:10px; '],
            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:10px; background: #FFFFFF;'],
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:10px; background: #FFFFFF;'],  
            ],
        
            [ 
            'attribute' => 'beneficiario', 				
            'value' => 'beneficiario', 
            'format' => 'text', 
            'vAlign'=>'middle',
            'hAlign'=>'center',
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:10px; '],
            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:10px; background: #FFFFFF;'],
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:10px; background: #FFFFFF;'],  
            ],
        
            [ 
            'attribute' => 'cibeneficiario', 				
            'value' => 'cibeneficiario', 
            'format' => 'text', 
            'label' => '<center>C.I.<br>Benefic.</center>',
            'encodeLabel' => false,
            'vAlign'=>'middle',
            'hAlign'=>'center',
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:10px; '],
            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:10px; background: #FFFFFF;'],
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:10px; background: #FFFFFF;'],  
            ],
        
            [                     
            'attribute' => 'telefono', 			
            'value' => 'telefono', 
            'format' => 'text',
            'visible'=> $vertelefono,
            'vAlign'=>'middle',
            'hAlign'=>'center',
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:10px; '],
            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:10px; background: #FFFFFF;'],
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:10px; background: #FFFFFF;'],  
            ],                      
        
            [                     
            'attribute' => 'unidadorigen', 			
            'value' => 'unidadorigen', 
            'format' => 'text',
            'visible'=> $verunidad,
            'vAlign'=>'middle',
            'hAlign'=>'center',
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:10px; '],
            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:10px; background: #FFFFFF;'],
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:10px; background: #FFFFFF;'],  
            ],
                   
            [ 
            'attribute' => 'empresaoinstitucion', 		
            'value' => 'empresaoinstitucion',
            'label' => 'Empresa<br>Casa Comercial',
            'format' => 'text',
            'encodeLabel' => false,
            'width'=>'150px',
            'vAlign'=>'middle',
            'hAlign'=>'center',
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:10px; '],
            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:10px; background: #FFFFFF;'],
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:10px; background: #FFFFFF;'],  
            ],
            
            [ 
            'attribute' => 'rif', 		
            'value' => 'rif', 
            'format' => 'text',
            'vAlign'=>'middle',
            'hAlign'=>'center',
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:10px; '],
            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:10px; background: #FFFFFF;'],
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:10px; background: #FFFFFF;'],  
            ],
     
            [ 
            'attribute' => 'cantidad', 						
            'value' => 'cantidad',
            'label' => 'N°',
            'format' => 'text',
            'pageSummary'=>true,
            'vAlign'=>'middle',
            'hAlign'=>'center',
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:10px; '],
            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:10px; background: #FFFFFF;'],
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:10px; background: #FFFFFF;'],  
            ],
                        
            [ 
            'attribute' => 'orpa', 						
            'value' => 'orpa', 
            'format' => 'text',
            'visible'=> $verorpa,
            'vAlign'=>'middle',
            'hAlign'=>'center',
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:10px; '],
            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:10px; background: #FFFFFF;'],
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:10px; background: #FFFFFF;'],  
            ],
                               
            [ 
            'attribute' => 'cheque', 						
            'value' => 'cheque', 
            'format' => 'text',
            'visible'=> $vercheque,
            'vAlign'=>'middle',
            'hAlign'=>'center',
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:10px; '],
            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:10px; background: #FFFFFF;'],
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:10px; background: #FFFFFF;'],  
            ],
                    
                       
        
            [ 
            'attribute' => 'monto', 						
            'value' => 'monto', 
            'hAlign'=>'right', 
            'vAlign'=>'middle',
            'width'=>'100px',
            'format'=>'currency',
            'pageSummary'=>true,
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:10px; '],
            'contentOptions' => ['class' => 'text-right', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:10px; background: #FFFFFF;'],
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:10px; background: #FFFFFF;'],  
            ],

            
            //[
            //'class'=>'kartik\grid\ActionColumn',
            //],
            
        ];

?>

<?php
echo   GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $columns, // check the configuration for grid columns by clicking button above
        'headerRowOptions' => ['class' => 'text-center', 'margin: 0px; padding: 2px; border: solid 1px black !important; font-size:10px; background: #FFFFFF; '],
        'captionOptions' => ['class' => 'text-center', 'style' => 'color: black; margin: 0px; padding: 2px; font-size:10px;'],
        'footerRowOptions'=> ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black !important; font-size:10px;'],
        'rowOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black !important; font-size:10px;'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'layout' => "{items}\n{pager}",
        'pjax' => false, 
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'showPageSummary' => true,
        'toolbar' =>  [ 
        ],
    ]);
?>
