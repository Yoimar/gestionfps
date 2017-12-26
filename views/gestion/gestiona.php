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
use app\models\Presupuestos;
use app\models\Gestion;
use app\models\Departamentos;
use app\models\Recepciones;
use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
use kartik\export\ExportMenu;

?>
<!-- Aqui empieza el Div del Form de la Busqueda -->
<center>
    <div class="container center-block">
	<div class="col-lg-12">
			<div class="box-header center-block">
                            <h3 class="display-3 center-block">
					Cambio de Estatus y Envio de MEMO					
                            </h3>
			</div>
        </div>
    </div>
<!-- Formulario para cambio de Estatus de Varias Items a la Vez-->
<?php $form = ActiveForm::begin(); ?>
<?php ActiveForm::end(); ?>


<?=Html::beginForm(['gestion/cambioestatus'],'post');?>
    
<div class="container center-block">
	<div class="col-lg-6 col-md-6">
            <div class="modelorigenmemo-form col-lg-8 col-md-8 col-md-offset-2 col-lg-offset-2">
 <!-- Formulario del Origen Memos -->
<?php 
echo $form->field($modelorigenmemo, 'departamento')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Departamentos::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Departamento'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
            
?>

    <?= $form->field($modelorigenmemo, 'unidad')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Recepciones::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione la Unidad'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]); 
            
    ?>
        
    <?=
    /* Trabajador de la Fundacion a la que se le asignó la Gestión*/
        $form->field($modelorigenmemo, 'usuario')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Trabajador::find()->asArray()->all(),'id', function($model, $defaultValue) {
                        return $model['dimprofesion'].' '.$model['primernombre'].' '.$model['primerapellido'];}),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Trabajador'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>

     <?=
    /* Estatus 1 con Select2 de kartik*/
        $form->field($modelorigenmemo, 'estatus1')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Estatus1::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Estatus Nivel 1'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>
    
    
    <?php
    /* Estatus 2 con depdrop de kartik*/
    echo $form->field($modelorigenmemo, 'estatus2')->widget(DepDrop::classname(), [
    'data' => ArrayHelper::map(Estatus2::find()->orderBy('nombre')->all(), 'id', 'nombre'),
    'type'=>DepDrop::TYPE_SELECT2,
    'options'=>['id'=>'estatus2_id', 'placeholder'=>'Seleccione el Estatus Nivel 2'],
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'placeholder' => 'Seleccione el Estatus Nivel 2',
        'depends'=>['origenmemo-estatus1'],
        'url'=>Url::to(['/estatus3/estatus1']),
    ]
    ]);
        
    ?>

    <?=
    /* Estatus 3 con depdrop de kartik*/
    $form->field($modelorigenmemo, 'estatus3')->widget(DepDrop::classname(), [
    'data' => ArrayHelper::map(Estatus3::find()->orderBy('nombre')->all(), 'id', 'nombre'),
    'type'=>DepDrop::TYPE_SELECT2,
    'options'=>['id'=>'estatus3_id', 'placeholder'=>'Seleccione el Estatus Nivel 3'],
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'placeholder' => 'Seleccione el Estatus Nivel 3',
        'depends'=>['estatus2_id'],
        'url'=>Url::to(['/estatus3/estatus2']),
    ]
    ]);

    ?>  
</div>
            
</div>

<div class="col-lg-6 col-md-6">
<div class="modelorigenmemo-form col-lg-8 col-md-8 col-md-offset-2 col-lg-offset-2">

                            
    <?= $form->field($modelfinalmemo, 'departamentofinal')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Departamentos::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Departamento'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
            
    ?>

    <?= $form->field($modelfinalmemo, 'unidadfinal')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Recepciones::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione la Unidad'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]); 
            
    ?>

    <?=
    /* Trabajador de la Fundacion a la que se le asignó la Gestión*/
        $form->field($modelfinalmemo, 'usuariofinal')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Trabajador::find()->asArray()->all(),'id', function($model, $defaultValue) {
                        return $model['dimprofesion'].' '.$model['primernombre'].' '.$model['primerapellido'];}),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Trabajador'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>
    
    <?=
    /* Estatus 1 con Select2 de kartik*/
        $form->field($modelfinalmemo, 'estatus1final')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Estatus1::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Estatus Nivel 1'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>
    
    
    <?php
    /* Estatus 2 con depdrop de kartik*/
    echo $form->field($modelfinalmemo, 'estatus2final')->widget(DepDrop::classname(), [
    'data' => ArrayHelper::map(Estatus2::find()->orderBy('nombre')->all(), 'id', 'nombre'),
    'type'=>DepDrop::TYPE_SELECT2,
    'options'=>['id'=>'estatus2_idfinal', 'placeholder'=>'Seleccione el Estatus Nivel 2'],
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'placeholder' => 'Seleccione el Estatus Nivel 2',
        'depends'=>['finalmemo-estatus1final'],
        'url'=>Url::to(['/estatus3/estatus1']),
    ]
    ]);
        
    ?>

    <?=
    /* Estatus 3 con depdrop de kartik*/
    $form->field($modelfinalmemo, 'estatus3final')->widget(DepDrop::classname(), [
    'data' => ArrayHelper::map(Estatus3::find()->orderBy('nombre')->all(), 'id', 'nombre'),
    'type'=>DepDrop::TYPE_SELECT2,
    'options'=>['id'=>'estatus3_idfinal', 'placeholder'=>'Seleccione el Estatus Nivel 3'],
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'placeholder' => 'Seleccione el Estatus Nivel 3',
        'depends'=>['estatus2_idfinal'],
        'url'=>Url::to(['/estatus3/estatus2']),
    ]
    ]);
    ?>   

   </div>
    </div>                                                  
<?= Html::submitButton('<span class="glyphicon glyphicon-floppy-saved"></span> Enviar e Imprimir Memorandum', ['class' => 'btn btn-primary btn-lg']) ?>                            
    
                        

    
</div>
</center>

<!-- Termina el Formulario de la Busqueda -->

<?php 

    $columns = [
            [
            'class'=>'kartik\grid\CheckboxColumn',
            'headerOptions'=>['class'=>'kartik-sheet-style'],
            'rowSelectedClass' => GridView::TYPE_INFO,
            'checkboxOptions' => function($model, $key, $index, $column) {
                    return ['value' => $model->id];
                },

            ],
        
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

<?php
echo   GridView::widget([
//        'id' => 'kv-grid-gestiona',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns, // check the configuration for grid columns by clicking button above
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'pjax' => true, // pjax is set to always true for this demo
//         parameters from the demo form
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'showPageSummary' => true,
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => 'Localizador',
        ],
        'toolbar' =>  [ 
//            '{export}',
//            ExportMenu::widget([
//    'dataProvider' => $dataProvider,
//    'columns' => $columns,
//    'fontAwesome' => true,
//    ]),
        ],
        'itemLabelSingle' => 'gestion',
        'itemLabelPlural' => 'gestiones'
    ]);


?>
<!-- Termina el GridView empieza el Envio de Información -->

<?= Html::endForm();?> 

<!-- Fin del Formulario -->

</div>
