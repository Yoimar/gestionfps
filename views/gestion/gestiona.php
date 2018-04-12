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
use kartik\date\DatePicker;
use kartik\alert\AlertBlock;
use kartik\growl\Growl;

?>
<!-- Aqui empieza el Div del Form de la Busqueda -->
<center>
    <div class="container center-block">
	<div class="col-lg-12">
                            <h3 class="display-3 center-block">
					Envio de Memorandum
                            </h3>
        </div>
    </div>
<!-- Formulario para cambio de Estatus de Varias Items a la Vez-->
<?php $form = ActiveForm::begin(); ?>
<?php ActiveForm::end(); ?>


<?=Html::beginForm(['gestion/cambioestatus'],'post');?>

<div class="container center-block">
    <div class="col-lg-4 col-md-4">
        <div class="panel panel-primary" >
            <div class="panel-heading"> Enviado Por :</div>
        <div class="panel-body">
	<div class="col-lg-12 col-md-12">
 <!-- Formulario del Origen Memos -->
<?php
echo $form->field($modelorigenmemo, 'departamento')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Departamentos::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione la Dirección'],
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

        </div>



</div>
</div>
</div>
<div class="container center-block">
    <div class="col-lg-8 col-md-8">
        <div class="panel panel-primary" >
            <div class="panel-heading"> Recibido Por :</div>
        <div class="panel-body">
	<div class="col-lg-6 col-md-6">

    <?= $form->field($modelfinalmemo, 'departamentofinal')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Departamentos::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione la Dirección'],
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
    </div>
    <div class="col-lg-6 col-md-6">

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
</div>
</div>
</div>

<!-- AQUI TERMINA EL DIV ENVIADO POR Y RECIBIDO POR -->

<div class="col-lg-12 col-md-12">

<div class="modelorigenmemo-form col-lg-9 col-md-9">
    <?= $form->field($memosgestion, 'asunto')->textInput(['maxlength' => true]) ?>
</div>

<div class="modelorigenmemo-form col-lg-3 col-md-3">
<?php
$fechahoy = Yii::$app->formatter->asDate('now','php:m-d-Y');
$memosgestion->fechamemo = $fechahoy;
?>
    <center>
<?= $form->field($memosgestion, 'fechamemo')->widget(DatePicker::classname(), [
            'name' => 'dp_3',
            'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'pluginOptions' => [
                        'autoclose'=>true,
                       'format' => 'mm/dd/yyyy',
                        'language' => 'es',
                        'todayBtn' => 'linked',
                    ]
            ]);
?>
    </center>
</div>

</div>
</div>

<?= Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['gestiona',
                'estatus1' => $estatus1,
                'estatus2' => $estatus2,
                'estatus3' => $estatus3,
                'departamento' => $departamento,
                'unidad' => $unidad,
                'usuario' => $usuario,
                'verorpa' => true,
                'vercheque' => $vercheque,
                'vertelefono' => $vertelefono,
                'verunidad' => $verunidad], ['class'=>'btn btn-primary', 'data-container' => 'body', 'data-toggle' => 'tooltip', 'data-placement'=> 'bottom', 'title'=>'Ver Orden de Pago']) ?>

<?= Html::a('<span class="glyphicon glyphicon-certificate"></span>', ['gestiona',
                'estatus1' => $estatus1,
                'estatus2' => $estatus2,
                'estatus3' => $estatus3,
                'departamento' => $departamento,
                'unidad' => $unidad,
                'usuario' => $usuario,
                'verorpa' => $verorpa,
                'vercheque' => true,
                'vertelefono' => $vertelefono,
                'verunidad' => $verunidad], ['class'=>'btn btn-primary', 'data-container' => 'body', 'data-toggle' => 'tooltip', 'data-placement'=> 'bottom', 'title'=>'Ver Cheque']) ?>

<?= Html::a('<span class="glyphicon glyphicon-earphone"></span>', ['gestiona',
                'estatus1' => $estatus1,
                'estatus2' => $estatus2,
                'estatus3' => $estatus3,
                'departamento' => $departamento,
                'unidad' => $unidad,
                'usuario' => $usuario,
                'verorpa' => $verorpa,
                'vercheque' => $vercheque,
                'vertelefono' => true,
                'verunidad' => $verunidad], ['class'=>'btn btn-primary', 'data-container' => 'body', 'data-toggle' => 'tooltip', 'data-placement'=> 'bottom', 'title'=>'Ver Telefono' ]) ?>

<?= Html::a('<span class="glyphicon glyphicon-collapse-down"></span>', ['gestiona',
                'estatus1' => $estatus1,
                'estatus2' => $estatus2,
                'estatus3' => $estatus3,
                'departamento' => $departamento,
                'unidad' => $unidad,
                'usuario' => $usuario,
                'verorpa' => $verorpa,
                'vercheque' => $vercheque,
                'vertelefono' => $vertelefono,
                'verunidad' => true], ['class'=>'btn btn-primary', 'data-container' => 'body', 'data-toggle' => 'tooltip', 'data-placement'=> 'bottom', 'title'=>'Ver Unidad']) ?>

<?= Html::submitButton('<span class="glyphicon glyphicon-floppy-saved"></span> Enviar e Imprimir', ['class' => 'btn btn-primary btn-lg']) ?>

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
            'vAlign'=>'middle',
            'hAlign'=>'center',
            ],

            [
            'attribute' => 'requerimiento',
            'value' => 'requerimiento',
            'format' => 'text',
            'vAlign'=>'middle',
            'hAlign'=>'center',
            ],

            [
            'attribute' => 'beneficiario',
            'value' => 'beneficiario',
            'format' => 'text',
            'vAlign'=>'middle',
            'hAlign'=>'center',
            ],

            [
            'attribute' => 'cibeneficiario',
            'value' => 'cibeneficiario',
            'format' => 'text',
            'label' => '<center>C.I.<br>Benefic.</center>',
            'encodeLabel' => false,
            'vAlign'=>'middle',
            'hAlign'=>'center',
            ],

            [
            'attribute' => 'telefono',
            'value' => 'telefono',
            'format' => 'text',
            'visible'=> $vertelefono,
            'vAlign'=>'middle',
            'hAlign'=>'center',
            ],

            [
            'attribute' => 'unidadorigen',
            'value' => 'unidadorigen',
            'format' => 'text',
            'visible'=> $verunidad,
            'vAlign'=>'middle',
            'hAlign'=>'center',
            ],

            [
            'attribute' => 'empresaoinstitucion',
            'value' => 'empresaoinstitucion',
            'label' => 'Empresa<br>Casa Comercial',
            'format' => 'text',
            'encodeLabel' => false,
            'vAlign'=>'middle',
            'hAlign'=>'center',
            ],

            [
            'attribute' => 'rif',
            'value' => 'rif',
            'format' => 'text',
            'vAlign'=>'middle',
            'hAlign'=>'center',
            ],

            [
            'attribute' => 'cantidad',
            'value' => 'cantidad',
            'label' => 'N°',
            'format' => 'text',
            'pageSummary'=>true,
            'vAlign'=>'middle',
            'hAlign'=>'center',
            ],

            [
            'attribute' => 'orpa',
            'value' => 'orpa',
            'format' => 'text',
            'visible'=> $verorpa,
            'vAlign'=>'middle',
            'hAlign'=>'center',
            ],

            [
            'attribute' => 'cheque',
            'value' => 'cheque',
            'format' => 'text',
            'visible'=> $vercheque,
            'vAlign'=>'middle',
            'hAlign'=>'center',
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

//            [
//            'class'=>'kartik\grid\ActionColumn',
//            ],

            [
            'class'=>'kartik\grid\ActionColumn',
            'template' => '{update} {view} {actualiza}',
            'buttons' => [
                'view' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                                $url,
                                    [
                                        'title' => 'Ver Gestión',
                                    ]
                                );
                },
                'update' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                                $url,
                                    [
                                        'title' => 'Actualizar',
                                    ]
                                );
                },
                'actualiza' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-refresh"></span>',
                                $url,
                                    [
                                        'title' => 'Actualizar',
                                    ]
                                );
                },
            ],
            'urlCreator' => function ($action, $model, $key, $index) {
                if ( $action == 'actualiza'){
                    return yii\helpers\Url::to(['actualiza',
                    'id' => $key,
                    'estatus3' => $model->estatus3_id,
                    'verorpa' => true,
                    'vercheque' => true,
                    'vertelefono' => true,
                    'verunidad' => true ]);
                }
            }
            ],

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
<center>
<div class="col-lg-12 col-md-12">
     <div>
         <?php
            echo AlertBlock::widget([
                    'useSessionFlash' => true,
                    'type' => AlertBlock::TYPE_GROWL,
                    'delay' => 0,
                    'alertSettings' => [
                        'success' => ['type' => Growl::TYPE_SUCCESS, 'pluginOptions' => ['placement' => ['from' => 'top', 'align' => 'center']]],
                        'danger' => ['type' => Growl::TYPE_DANGER, 'pluginOptions' => ['placement' => ['from' => 'top', 'align' => 'center']]],
                        'warning' => ['type' => Growl::TYPE_WARNING, 'pluginOptions' => ['placement' => ['from' => 'top', 'align' => 'center']]],
                        'info' => ['type' => Growl::TYPE_INFO, 'pluginOptions' => ['placement' => ['from' => 'top', 'align' => 'center']]]
                        ],
            ])
         ?>
    </div>
</div>
</center>
<?php
$this->registerJs(<<<JS

   $(function () {
   $('[data-toggle="tooltip"]').tooltip()
   })

JS

);

?>
