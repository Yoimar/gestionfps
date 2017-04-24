<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Personas;
use yii\web\JsExpression;
use \yii\helpers\Url;
use app\models\Users;
use kartik\datetime\DateTimePicker;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Solicitudes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="solicitudes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'ind_mismo_benef')->checkboxList([
    true => 'Beneficiarios Iguales', 
    false => 'Beneficiario Y Solicitante Diferentes',
    ]);    
    ?>

    <?= $form->field($model, 'ind_beneficiario_menor')->checkboxList([
    true => 'Beneficiario Menor de Edad', 
    ]); ?>
    
    <?= 
        $form->field($model, 'persona_beneficiario_id')->widget(Select2::classname(), [
        'initValueText' => empty($model->persona_beneficiario_id) ? '' : Personas::findOne($model->persona_beneficiario_id)->nombre, // set the initial display text
        'options' => ['placeholder' => 'Ingrese el Beneficiario ...'],
        'pluginOptions' => [
        'allowClear' => true,
        'minimumInputLength' => 5,
        'language' => [
            'errorLoading' => new JsExpression("function () { return 'Esperando los resultados...'; }"),
        ],
        'ajax' => [
            'url' => Url::to(['listapersonas']),
            'dataType' => 'json',
            'data' => new JsExpression('function(params) { return {q:params.term}; }')
        ],
        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
        'templateResult' => new JsExpression('function(personas) { return personas.text; }'),
        'templateSelection' => new JsExpression('function (personas) { return personas.text; }'),
        ],
        ]);
    
    ?>
    
    <?= 
        $form->field($model, 'persona_solicitante_id')->widget(Select2::classname(), [
        'initValueText' => empty($model->persona_solicitante_id) ? '' : Personas::findOne($model->persona_solicitante_id)->nombre, // set the initial display text
        'options' => ['placeholder' => 'Ingrese el Solicitante ...'],
        'pluginOptions' => [
        'allowClear' => true,
        'minimumInputLength' => 5,
        'language' => [
            'errorLoading' => new JsExpression("function () { return 'Esperando los resultados...'; }"),
        ],
        'ajax' => [
            'url' => Url::to(['listapersonas']),
            'dataType' => 'json',
            'data' => new JsExpression('function(params) { return {q:params.term}; }')
        ],
        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
        'templateResult' => new JsExpression('function(personas) { return personas.text; }'),
        'templateSelection' => new JsExpression('function (personas) { return personas.text; }'),
        ],
        ]);
    
    ?>
    
    <?= 
        $form->field($model, 'area_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Areas::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Area'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>
    
    <?= 
        $form->field($model, 'referente_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Referentes::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Referente'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>

    <?= 
        $form->field($model, 'recepcion_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Recepciones::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione la Recepción'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>
    
    <?= 
        $form->field($model, 'organismo_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Organismos::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione El Organismo'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>

    <?= $form->field($model, 'referencia_externa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'necesidad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_proc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_proc')->textInput() ?>

    <?= $form->field($model, 'facturas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'observaciones')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'moneda')->textInput(['maxlength' => true]) ?>
    
    <?= 
        $form->field($model, 'estatus')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Estatussasyc::find()->orderBy('id')->all(), 'id', 'estatus'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione El Estatus'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>
    
    <?= 
        $form->field($model, 'usuario_asignacion_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Users::find()->where(['activated' => 'TRUE'])->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Usuario del SASYC'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>
    
    <?= 
        $form->field($model, 'usuario_autorizacion_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Users::find()->where(['activated' => 'TRUE'])->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Usuario del SASYC'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>
    
    <?= $form->field($model, 'fecha_asignacion')->widget(DateTimePicker::classname(), [
	'name' => 'datetime_18',
        'options' => ['placeholder' => 'Ingrese la Fecha en que se realizo la Actividad'],
        'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
        'value' => '23-04-2017 10:01:50',
        'pluginOptions' => [
            'todayHighlight' => true,
            'todayBtn' => true,
            'autoclose'=>true,
            'showMeridian' => true,
            'format' => 'dd-mm-yyyy hh:ii:ss',
        ]
        ]);
    ?>
    
    <?= $form->field($model, 'fecha_aceptacion')->widget(DateTimePicker::classname(), [
	'name' => 'datetime_18',
        'options' => ['placeholder' => 'Ingrese la Fecha en que se realizo la Actividad'],
        'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
        'value' => '23-04-2017 10:01:50',
        'pluginOptions' => [
            'todayHighlight' => true,
            'todayBtn' => true,
            'autoclose'=>true,
            'showMeridian' => true,
            'format' => 'dd-mm-yyyy hh:ii:ss',
        ]
        ]);
    ?>
    
    <?= $form->field($model, 'fecha_aprobacion')->widget(DateTimePicker::classname(), [
	'name' => 'datetime_18',
        'options' => ['placeholder' => 'Ingrese la Fecha en que se realizo la Actividad'],
        'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
        'value' => '23-04-2017 10:01:50',
        'pluginOptions' => [
            'todayHighlight' => true,
            'todayBtn' => true,
            'autoclose'=>true,
            'showMeridian' => true,
            'format' => 'dd-mm-yyyy hh:ii:ss',
        ]
        ]);
    ?>
    
    <?= $form->field($model, 'fecha_cierre')->widget(DateTimePicker::classname(), [
	'name' => 'datetime_18',
        'options' => ['placeholder' => 'Ingrese la Fecha en que se realizo la Actividad'],
        'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
        'value' => '23-04-2017 10:01:50',
        'pluginOptions' => [
            'todayHighlight' => true,
            'todayBtn' => true,
            'autoclose'=>true,
            'showMeridian' => true,
            'format' => 'dd-mm-yyyy hh:ii:ss',
        ]
        ]);
    ?>
    
    <?= 
        $form->field($model, 'tipo_vivienda_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\TipoViviendas::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione Tipo de Vivienda'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>
    
    <?= 
        $form->field($model, 'tenencia_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Tenencias::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione La Tenencia'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>
    
    <?= 
        $form->field($model, 'departamento_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Departamentos::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione El Departamento'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>
    
    <?= 
        $form->field($model, 'memo_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Memos::find()->orderBy('numero desc')->all(), 'id', 'numero'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione El Memo que desea ingresar'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>

    <?= $form->field($model, 'informe_social')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'total_ingresos')->textInput() ?>

    <?= $form->field($model, 'beneficiario_json')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'solicitante_json')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'num_solicitud')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
