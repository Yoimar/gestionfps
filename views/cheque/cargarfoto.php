<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\TipoNacionalidades;
use app\models\Estados;
use app\models\Municipios;
use app\models\Parroquias;
use app\models\Personas;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\widgets\MaskedInput;
use kartik\file\FileInput;
use kartik\tabs\TabsX;
use yii\web\JsExpression;
use kartik\alert\AlertBlock;
use kartik\growl\Growl;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Cheque */

$this->title = 'Cargar Foto y Realizar Entrega';
$this->params['breadcrumbs'][] = ['label' => 'Cheques', 'url' => ['busqueda']];
$this->params['breadcrumbs'][] = $this->title;

/** Inicializar el depdrown de Kartik Beneficiario **/
if (isset($modelpersonabeneficiario->parroquia_id)) {
    $parroquia = Parroquias::findOne($modelpersonabeneficiario->parroquia_id);
    $municipio = Municipios::findOne($parroquia->municipio_id);
    $modelpersonabeneficiario->municipio_id = $municipio->id;
    $modelpersonabeneficiario->estado_id = $municipio->estado_id;
}

/** Inicializar el depdrown de Kartik Solicitante **/

if (isset($modelpersonasolicitante->parroquia_id)) {
    $parroquia = Parroquias::findOne($modelpersonasolicitante->parroquia_id);
    $municipio = Municipios::findOne($parroquia->municipio_id);
    $modelpersonasolicitante->municipio_id = $municipio->id;
    $modelpersonasolicitante->estado_id = $municipio->estado_id;
}

?>
<div class="cheque-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    /* Esto es para vistas que estan en otro controlador */
    //echo $this->render('//fotossolicitud/_form', [
    //      'model' => $modelfotossolicitud,
    //      ]) 
    ?>
    
    <?php $form = ActiveForm::begin(); ?>
    
    <?php
    
    /** Bloque de datos para llenar por la Persona Beneficiario **/
        $this->beginBlock('Solicitud');
        
    ?>
    
    <div class="row">

        <div class="col-md-6">
            
             <?php
            echo $form->field($modelgestion, 'estatus3_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map((new \yii\db\Query())->select(["CONCAT(estatus1.nombre, ' // ', estatus2.nombre, ' // ', estatus3.nombre) as nombre", "estatus3.id as id"])
                                ->from('estatus3')
                                ->join('join', 'estatus2', 'estatus3.estatus2_id = estatus2.id')
                                ->join('join', 'estatus1', 'estatus2.estatus1_id = estatus1.id')
                                ->all(), 'id', 'nombre'),
                'disabled' => true,
                'language' => 'es',
                'options' => ['placeholder' => 'Estatus Actual'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('Estatus Actual');
            ?>
            
    <?=
        $form->field($modelsolicitud, 'estatus')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Estatussasyc::find()->orderBy('id')->all(), 'id', 'estatus'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione El Estatus'],
        'pluginOptions' => [
        'disabled' => true,
        ],
    ]);

    ?>
            
    <?php
    echo $form->field($modelsolicitud, 'persona_solicitante_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map((new \yii\db\Query())->select(["CONCAT(personas.nombre, ' ', personas.apellido) as nombre", "solicitudes.persona_solicitante_id as id"])
                        ->from('solicitudes')
                        ->join('join', 'personas', 'personas.id = solicitudes.persona_solicitante_id')
                        ->all(), 'id', 'nombre'),
        'disabled' => true,
        'language' => 'es',
        'options' => ['placeholder' => 'Solicitante'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Solicitante');
    ?>

    <?php
    echo $form->field($modelsolicitud, 'persona_beneficiario_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map((new \yii\db\Query())->select(["CONCAT(personas.nombre, ' ', personas.apellido) as nombre", "solicitudes.persona_beneficiario_id as id"])
                        ->from('solicitudes')
                        ->join('join', 'personas', 'personas.id = solicitudes.persona_beneficiario_id')
                        ->all(), 'id', 'nombre'),
        'disabled' => true,
        'language' => 'es',
        'options' => ['placeholder' => 'Beneficiario'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Beneficiario');
    ?>
            
    <div class="row">

    <div class="col-md-6">
    
    <?=
        $form->field($modelsolicitud, 'recepcion_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Recepciones::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione la Recepción'],
        'disabled' => true,
        'pluginOptions' => [
        'allowClear' => true
        ],
    ])->label('Unidad');

    ?>
    
    </div>
    <div class="col-md-6">

    <?=
        $form->field($modelsolicitud, 'area_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Areas::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Area'],
        'disabled' => true,
        'pluginOptions' => [
        'allowClear' => true
        ],
    ])->label('Area');

    ?>
        
    </div>
        
    </div>

    <?= $form->field($modelsolicitud, 'necesidad')->textarea(['rows' => '2']) ?>

    

    <?= $form->field($modelsolicitud, 'descripcion')->textarea(['rows' => '2']) ?>
    
        </div>

        <div class="col-md-6">
            
                    
    <div class="row">

    <div class="col-md-4">
            
            <?= $form->field($modelcheque, 'cheque')->textInput(['maxlength' => true, 'disabled' => true]) ?>
    </div>
    <div class="col-md-4">
    <?= $form->field($modelcheque, 'date_cheque')->textInput(['disabled' => true]) ?>
    
</div>
    <div class="col-md-4">
        
    <?=
        $form->field($modelcheque, 'cheque_by')->widget(Select2::classname(), [
        'data' => ArrayHelper::map((new \yii\db\Query())->select([
                        "CONCAT(trabajador.primernombre, ' ', trabajador.primerapellido) as nombre", 
                        "trabajador.user_id as id"])
                        ->from('trabajador')
                        ->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione la persona que realizo la impresion del cheque'],
        'disabled' => true,
        'pluginOptions' => [
        'allowClear' => true
        ],
    ])->label('Impreso por'); ?>
        
    </div>
</div>
    <div class="row">

    <div class="col-md-4">

    <?= $form->field($modelcheque, 'date_enviofirma')->textInput(['disabled' => true]) ?>
        </div>
    <div class="col-md-4">

    <?= $form->field($modelcheque, 'date_enviocaja')->textInput(['disabled' => true]) ?>
        </div>
    <div class="col-md-4">

    <?= $form->field($modelcheque, 'date_reccaja')->widget(DatePicker::classname(), [
            'name' => 'dp_3',
            'type' =>  DatePicker::TYPE_INPUT,
                    'pluginOptions' => [
                        'autoclose'=>true,
                       'format' => 'yyyy-mm-dd',
                        'language' => 'es',
                        'todayBtn' => 'linked',
                    ]
            ]); ?>
        </div>
     </div>
    
    <div class="row">
        <div class="col-md-4">

            <?= $form->field($modelcheque, 'date_entregado')->widget(DatePicker::classname(), [
            'name' => 'dp_3',
            'type' =>  DatePicker::TYPE_INPUT,
                    'pluginOptions' => [
                        'autoclose'=>true,
                       'format' => 'yyyy-mm-dd',
                        'language' => 'es',
                        'todayBtn' => 'linked',
                    ]
            ]); ?>
        </div>
        
        <div class="col-md-4">
        <?= $form->field($modelcheque, 'responsable_by')->widget(Select2::classname(), [
        'data' => ArrayHelper::map((new \yii\db\Query())->select([
                        "CONCAT(trabajador.primernombre, ' ', trabajador.primerapellido) as nombre", 
                        "trabajador.user_id as id"])
                        ->from('trabajador')
                        ->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Responsable'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ])->label('Responsable'); ?>
        </div>
        
        <div class="col-md-4">
            <?= $form->field($modelcheque, 'entregado_by')->widget(Select2::classname(), [
        'data' => ArrayHelper::map((new \yii\db\Query())->select([
                        "CONCAT(trabajador.primernombre, ' ', trabajador.primerapellido) as nombre", 
                        "trabajador.user_id as id"])
                        ->from('trabajador')
                        ->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione la persona que hizo el registro'],
        'disabled' => true,
        'pluginOptions' => [
        'allowClear' => true
        ],
    ])->label('Registrado por:'); ?>
        </div>
        
    </div>

    <div class="row">

        <div class="col-md-6">

            <?=
            $form->field($modelcheque, 'retirado_personaid')->widget(Select2::classname(), [
                'initValueText' => empty($modelcheque->retirado_personaid) ? '' : Personas::findOne($modelcheque->retirado_personaid)->Personacompleta, // set the initial display text
                'options' => ['placeholder' => 'Ingrese el Beneficiario ...'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 5,
                    'language' => [
                        'errorLoading' => new JsExpression("function () { return 'Esperando los resultados...'; }"),
                    ],
                    'ajax' => [
                        'url' => Url::to(['//solicitudes/listapersonas']),
                        'dataType' => 'json',
                        'data' => new JsExpression('function(params) { return {q:params.term}; }')
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('function(personas) { return personas.text; }'),
                    'templateSelection' => new JsExpression('function (personas) { return personas.text; }'),
                ],
            ]);
            ?>

        </div>
        <div class="col-md-6">
            <br>
            <?=
            Html::a('Registrar Persona', ['personas/crear',
                'cheque' => $modelcheque->cheque,
                    ], [
                'class' => 'btn btn-primary',
                'data-container' => 'body',
                'data-toggle' => 'tooltip',
                'data-placement' => 'bottom',
                'title' => 'Ingresar Persona'
            ])
            ?>
        </div>
    </div>
            
            
    <?php
        echo $form->field($modelfotossolicitud, 'imagen')
            ->widget(FileInput::classname(),[
                    'options'=>[
                        //'accept'=>'imagen/*',
                        //'multiple'=>true
                    ],
                    'pluginOptions' => [
                        'initialPreview'=>[
                        isset($modelfotossolicitud->foto)?Yii::getAlias('@web')."/img/adjuntos/".$modelfotossolicitud->solicitud_id.'/'.$modelfotossolicitud->foto:"",
                        ],
                        'initialPreviewAsData'=>true,
                        'initialPreviewShowDelete' => false,
                        'initialCaption'=>"Subir Archivo",
                        'initialPreviewConfig' => [
                            [
                            //comentario para archivos pdf, si no es imagen colocar 'type' => pdf
                            'caption' => $modelfotossolicitud->foto,
                            ]
                        ],
                        'overwriteInitial'=>false,
                        'maxFileSize'=>28000,
                        'showRemove' => false,
                        'showUpload' => false,
                    ],

                ]);
    ?>
            
            </div>
    </div>
  
    <?php 
    $this->endBlock();
    ?>
    
    <?php
    
    /** Bloque de datos para llenar por la Persona Beneficiario **/
        $this->beginBlock('Personabeneficiario');
        
    ?>
    <div class="row">

        <div class="col-md-3">
            <?= $form->field($modelpersonabeneficiario, 'nombre')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($modelpersonabeneficiario, 'apellido')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?=
            $form->field($modelpersonabeneficiario, 'tipo_nacionalidad_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(TipoNacionalidades::find()->orderBy('nombre')->all(), 'id', 'nombre'),
                'language' => 'es',
                'options' => ['placeholder' => 'Seleccione la nacionalidad'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>            
        <div class="col-md-3">
            <?= $form->field($modelpersonabeneficiario, 'ci')->textInput() ?>
        </div>
    </div>
    
    <div class="row">

        <div class="col-md-4">
            <?=
            /* Estado con Select2 de kartik */
            $form->field($modelpersonabeneficiario, 'estado_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Estados::find()->orderBy('nombre')->all(), 'id', 'nombre'),
                'language' => 'es',
                'options' => [
                    'id' => 'estado_id_beneficiario',
                    'placeholder' => 'Seleccione el Estado'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        
        <div class="col-md-4">
            <?=
            /* Municipio con depdrop de kartik */
            $form->field($modelpersonabeneficiario, 'municipio_id')->widget(DepDrop::classname(), [
                'data' => ArrayHelper::map(Municipios::find()->orderBy('nombre')->all(), 'id', 'nombre'),
                'type' => DepDrop::TYPE_SELECT2,
                'options' => ['id' => 'municipio_id_beneficiario', 'placeholder' => 'Seleccione el Municipio'],
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'placeholder' => 'Seleccione el Municipio',
                    'depends' => ['estado_id_beneficiario'],
                    'url' => Url::to(['/parroquias/estadan']),
                ]
            ]);
            ?>
        </div>
        
        <div class="col-md-4">
            <?=
            /* Parroquia con depdrop de kartik */
            $form->field($modelpersonabeneficiario, 'parroquia_id')->widget(DepDrop::classname(), [
                'data' => ArrayHelper::map(Parroquias::find()->orderBy('nombre')->all(), 'id', 'nombre'),
                'type' => DepDrop::TYPE_SELECT2,
                'options' => ['id' => 'parroquia_id_beneficiario', 'placeholder' => 'Seleccione La Parroquia'],
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'placeholder' => 'Seleccione La Parroquia',
                    //'initialize' => true,
                    //'initDepends'=>['modelpersonabeneficiario-municipio_id'],
                    'depends' => ['municipio_id_beneficiario'],
                    'url' => Url::to(['/parroquias/municipan']),
                ]
            ]);
            ?>
        </div>

    </div>
    
    <div class="row">
        
        <div class="col-md-4">
            <?=
            $form->field($modelpersonabeneficiario, 'telefono_fijo')
                ->widget(MaskedInput::classname(), [
                'name' => 'input-1',
                'mask' => '9999-9999999'
            ]);
            ?>
        </div>
        
        <div class="col-md-4"> 
            <?=
            $form->field($modelpersonabeneficiario, 'telefono_celular')
                ->widget(MaskedInput::classname(), [
                'name' => 'input-2',
                'mask' => '9999-9999999'
            ]);
            ?>
        </div>
        
        <div class="col-md-4"> 
            <?=
            $form->field($modelpersonabeneficiario, 'telefono_otro')
                ->widget(MaskedInput::classname(), [
                'name' => 'input-3',
                'mask' => '9999-9999999'
            ]);
            ?>
        </div>
        
    </div>
    
    <div class="row">
        
        <div class="col-md-6">

    <?= $form->field($modelpersonabeneficiario, 'email')->widget(MaskedInput::classname(), [
        'name' => 'input-36',
        'clientOptions' => [
            'alias' =>  'email'
        ],
    ]);
    ?>
        </div>
        <div class="col-md-6">

    <?= $form->field($modelpersonabeneficiario, 'twitter')->widget(MaskedInput::classname(), [
        'name' => 'input-2',
        'mask' => '@*{1,50}'
        ]
    );
    ?>
        </div>

    </div>
    <?php 
    $this->endBlock();
    ?>
    
    <?php
    
    /** Bloque de datos para llenar por la Persona Beneficiario **/
        $this->beginBlock('Personasolicitante');
        
    ?>
    <div class="row">

        <div class="col-md-3">
            <?= $form->field($modelpersonasolicitante, 'nombre')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($modelpersonasolicitante, 'apellido')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?=
            $form->field($modelpersonasolicitante, 'tipo_nacionalidad_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(TipoNacionalidades::find()->orderBy('nombre')->all(), 'id', 'nombre'),
                'language' => 'es',
                'options' => [
                    'id' => 'tipo_nacionalidad_beneficiario',
                    'placeholder' => 'Seleccione la nacionalidad'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>            
        <div class="col-md-3">
            <?= $form->field($modelpersonasolicitante, 'ci')->textInput() ?>
        </div>
    </div>
    
    <div class="row">

        <div class="col-md-4">
            <?=
            /* Estado con Select2 de kartik */
            $form->field($modelpersonasolicitante, 'estado_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Estados::find()->orderBy('nombre')->all(), 'id', 'nombre'),
                'language' => 'es',
                'options' => ['placeholder' => 'Seleccione el Estado'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        
        <div class="col-md-4">
            <?=
            /* Municipio con depdrop de kartik */
            $form->field($modelpersonasolicitante, 'municipio_id')->widget(DepDrop::classname(), [
                'data' => ArrayHelper::map(Municipios::find()->orderBy('nombre')->all(), 'id', 'nombre'),
                'type' => DepDrop::TYPE_SELECT2,
                'options' => ['id' => 'municipio_id', 'placeholder' => 'Seleccione el Municipio'],
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'placeholder' => 'Seleccione el Municipio',
                    'depends' => ['personas-estado_id'],
                    'url' => Url::to(['/parroquias/estadan']),
                ]
            ]);
            ?>
        </div>
        
        <div class="col-md-4">
            <?=
            /* Parroquia con depdrop de kartik */
            $form->field($modelpersonasolicitante, 'parroquia_id')->widget(DepDrop::classname(), [
                'data' => ArrayHelper::map(Parroquias::find()->orderBy('nombre')->all(), 'id', 'nombre'),
                'type' => DepDrop::TYPE_SELECT2,
                'options' => ['id' => 'parroquia_id', 'placeholder' => 'Seleccione La Parroquia'],
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'placeholder' => 'Seleccione La Parroquia',
                    //'initialize' => true,
                    //'initDepends'=>['modelpersonabeneficiario-municipio_id'],
                    'depends' => ['municipio_id'],
                    'url' => Url::to(['/parroquias/municipan']),
                ]
            ]);
            ?>
        </div>

    </div>
    
    <div class="row">
        
        <div class="col-md-4">
            <?=
            $form->field($modelpersonasolicitante, 'telefono_fijo')
                ->widget(MaskedInput::classname(), [
                'name' => 'input-4',
                'mask' => '9999-9999999',
                'options' => ['id' => 'personas-telefono_fijo1'],
                ])
                ->textInput(['id' => 'personas-telefono_fijo1']);
            ?>
        </div>
        
        <div class="col-md-4"> 
            <?=
            $form->field($modelpersonasolicitante, 'telefono_celular')
                ->widget(MaskedInput::classname(), [
                'name' => 'input-5',
                'mask' => '9999-9999999',
                'options' => ['id' => 'personas-telefono_celular2'],
                ])
                ->textInput(['id' => 'personas-telefono_celular2']);
            ?>
        </div>
        
        <div class="col-md-4"> 
            <?=
            $form->field($modelpersonasolicitante, 'telefono_otro')
                ->widget(MaskedInput::classname(), [
                'name' => 'input-6',
                'mask' => '9999-9999999',
                'options' => ['id' => 'personas-telefono_otro3'],
                ])
                ->textInput(['id' => 'personas-telefono_otro3']);
            ?>
        </div>
        
    </div>
    
    <div class="row">
        
        <div class="col-md-6">

    <?= $form->field($modelpersonasolicitante, 'email')->widget(MaskedInput::classname(), [
        'name' => 'input-26',
        'clientOptions' => [
            'alias' =>  'email'
        ],
        'options' => ['id' => 'personas-email2'],
                ])
        ->textInput(['id' => 'personas-email2']);
    ?>
        </div>
        <div class="col-md-6">

    <?= $form->field($modelpersonasolicitante, 'twitter')->widget(MaskedInput::classname(), [
        'name' => 'input-28',
        'mask' => '@*{1,50}',
        'options' => ['id' => 'personas-twitter2'],
                ])
        ->textInput(['id' => 'personas-twitter2']);
    ?>
        </div>

    </div>
    <?php 
    $this->endBlock();
    ?>
    
        
    <?php
            
       $items = [
        [
            'label'=>'<i class="glyphicon glyphicon-save-file"></i> Solicitud',
            'content' => $this->blocks['Solicitud'],
            'active'=>true
        ],   
           
        [
            'label' => '<i class="glyphicon glyphicon-user"></i> Beneficiario', 
            'content' => $this->blocks['Personabeneficiario']
        ],
        [
            'label' => '<i class="glyphicon glyphicon-user"></i> Solicitante', 
            'content' => $this->blocks['Personasolicitante']
        ],      
        
    ];


    ?>

    
    
    <div class="panel panel-primary">
        <div class="panel-heading text-center">
            <?= $modelsolicitud->num_solicitud ?>
        </div>
        <div class="panel-body">
            <?php
            $modelcheque->cheques = $modelcheque->cheque;
            ?>
            
            <div class="row">
            <div class="align-items-center">
                <div class="col text-center">

                    <?php
                    echo $form->field($modelcheque, 'cheques')
                            ->checkboxList($chequesdisponibles, [
                                'itemOptions' => [
                                    'labelOptions' => ['class' => 'col text-center col-md-2']
                                ]
                            ])
                            ->label('Seleccione los Cheques a Entregar', ['class' => 'label-class col text-center']);
                    ?>
                </div>
            </div>
            </div>
            
            <?php
            echo TabsX::widget([
                'items' => $items,
                'position' => TabsX::POS_ABOVE,
                'align' => TabsX::ALIGN_CENTER,
                'bordered' => true,
                'encodeLabels' => false
            ]);
            ?>
        </div>
    </div>
    
    
    

    <div class="text-center">
        
        <?= Html::submitButton(
                $modelfotossolicitud->isNewRecord ? 'Registrar Entrega' : 'Actualizar Entrega',
                ['class' => 'btn btn-primary']) 
        ?>
    </div>

    <?php ActiveForm::end(); ?>

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
