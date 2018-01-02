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
//        
            [
            'class'=>'kartik\grid\SerialColumn',
            'contentOptions'=>['class'=>'kartik-sheet-style'],
            'width'=>'36px',
            'header'=>'',
            'headerOptions'=>['class'=>'kartik-sheet-style'],
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
            'label' => 'SEP',
            'format' => 'text',
            ],
                    
            [
            'attribute' => 'iddoc',
            'value' => 'iddoc',
            'format' => 'text',
            'label' => 'IDDOC',    
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

<?php
echo   GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $columns, // check the configuration for grid columns by clicking button above
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
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
