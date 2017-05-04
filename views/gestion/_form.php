<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use yii\helpers\Url;
use kartik\datetime\DateTimePicker;
use yii\bootstrap\Modal;
use app\models\Programaevento;
use app\models\Solicitudes;
use app\models\Estatus1;
use app\models\Estatus2;
use app\models\Estatus3;
use app\models\Trabajador;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model app\models\Gestion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gestion-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= 
        $form->field($model, 'programaevento_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Programaevento::find()->orderBy('descripcion')->all(), 'id', 'descripcion'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Programa Evento o Actividad'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>
    
    <?= 
        $form->field($model, 'solicitud_id')->widget(Select2::classname(), [
        'initValueText' => empty($model->solicitud_id) ? '' : Solicitudes::findOne($model->solicitud_id)->num_solicitud, // set the initial display text
        'options' => ['placeholder' => 'Ingrese el Numero de Solicitud'],
        'pluginOptions' => [
        'allowClear' => true,
        'minimumInputLength' => 4,
        'language' => [
            'errorLoading' => new JsExpression("function () { return 'Esperando los resultados...'; }"),
        ],
        'ajax' => [
            'url' => Url::to(['numsolicitud']),
            'dataType' => 'json',
            'data' => new JsExpression('function(params) { return {q:params.term}; }')
        ],
        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
        'templateResult' => new JsExpression('function(solicitudes) { return solicitudes.text; }'),
        'templateSelection' => new JsExpression('function (solicitudes) { return solicitudes.text; }'),
        ],
        ]);
    
    ?>
    
    <?= 
        $form->field($model, 'tipodecontacto_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(app\models\Tipodecontacto::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione como fue recibido el caso'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>  
    
    <?= 
        $form->field($model, 'convenio_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Convenio::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Convenio'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>
    
    
    <?php
        echo $form->field($model, 'estatus3_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map((new \yii\db\Query())->select(["CONCAT(estatus1.nombre, ' // ', estatus2.nombre, ' // ', estatus3.nombre) as nombre", "estatus3.id as id"])
                ->from('estatus3')
                ->join('join', 'estatus2', 'estatus3.estatus2_id = estatus2.id')
                ->join('join', 'estatus1', 'estatus2.estatus1_id = estatus1.id')
                ->all(),'id','nombre'),
        'disabled' => true,
        'language' => 'es',
        'options' => ['placeholder' => 'Estatus Actual'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ])->label('Estatus Actual');
    
    ?>
    
    <?=
    /* Estatus 1 con Select2 de kartik*/
        $form->field($model, 'estatus1_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Estatus1::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Estatus Nivel 1'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>
    
    <?=
    /* Estatus 2 con depdrop de kartik*/
    $form->field($model, 'estatus2_id')->widget(DepDrop::classname(), [
    'type'=>DepDrop::TYPE_SELECT2,
    'options'=>['id'=>'estatus2_id', 'placeholder'=>'Seleccione el Estatus Nivel 2'],
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'placeholder' => 'Seleccione el Estatus Nivel 2',
        'depends'=>['gestion-estatus1_id'],
        'url'=>Url::to(['/estatus3/estatus1']),
    ]
    ]);
    ?>

    <?=
    /* Estatus 3 con depdrop de kartik*/
    $form->field($model, 'estatus3_id')->widget(DepDrop::classname(), [   
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
    
    <?= 
        $form->field($model, 'trabajador_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Trabajador::find()->asArray()->all(),'id', function($model, $defaultValue) {
        return $model['dimprofesion'].' '.$model['primernombre'].' '.$model['primerapellido'];}),
        'language' => 'es',
        'options' => ['placeholder' => 'Trabajador FPS'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>
    
    <?= $form->field($model, 'militar_solicitante')->checkbox() ?>
    
    <?= 
        $form->field($model, 'rango_solicitante_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(app\models\Rangosmilitares::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Rango Militar del Solicitante'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>

    <?= $form->field($model, 'militar_beneficiario')->checkbox() ?>
    
    <?= 
        $form->field($model, 'rango_beneficiario_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(app\models\Rangosmilitares::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Rango Militar del Beneficiario'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>
    
    <?= 
        $form->field($model, 'afrodescendiente')->widget(Select2::classname(), [
        'data' => ArrayHelper::map([['id' => 'Si', 'nombre' => 'Si'],['id' => 'No', 'nombre' => 'No']], 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => '¿Es Afrodescendiente?'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>
    
    <?= 
        $form->field($model, 'indigena')->widget(Select2::classname(), [
        'data' => ArrayHelper::map([['id' => 'Si', 'nombre' => 'Si'],['id' => 'No', 'nombre' => 'No']], 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => '¿Es indigena?'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>
    
    <?= 
        $form->field($model, 'sexodiversidad')->widget(Select2::classname(), [
        'data' => ArrayHelper::map([['id' => 'Si', 'nombre' => 'Si'],['id' => 'No', 'nombre' => 'No']], 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => '¿Pertenece a la Sexodiversidad?'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Registrar Gestión' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
