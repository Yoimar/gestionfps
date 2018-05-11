<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;
use kartik\select2\Select2;
use app\models\Trabajador;
use app\models\Origen;
use app\models\Referencia;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use kartik\depdrop\DepDrop;
use app\models\Estados;
use app\models\Parroquias;
use app\models\Municipios;
use yii\helpers\Url;
use kartik\datecontrol\DateControl;


/* @var $this yii\web\View */
/* @var $model app\models\Programaevento */
/* @var $form yii\widgets\ActiveForm */

$data = Trabajador::find()
        ->select(["id", "CONCAT(dimprofesion, ' ',primernombre,' ', primerapellido) as nombre"])
        ->asArray()
        ->all();
?>

<div class="programaevento-form">
<div class="row">



    <?php $form = ActiveForm::begin([
        "method" => "post",
        "enableClientValidation" => true,
    ]); ?>
    <div class="col-md-4" class="col-lg-4">
    <?= $form->field($model, 'nprograma')->textInput() ?>
    </div>
    <div class="col-md-4" class="col-lg-4">
    <?=
        $form->field($model, 'trabajadoracargo_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map($data,'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Trabajador FPS'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    ?>
    </div>
    <div class="col-md-4" class="col-lg-4">
    <?=
        $form->field($model, 'referencia_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map((new \yii\db\Query())->select(["CONCAT(autoridad.nombredim, ' - ', cargo.nombredim) as nombre", "referencia.id as id"])
                ->from('referencia')
                ->join('join', 'autoridad', 'referencia.autoridad_id = autoridad.id')
                ->join('join', 'cargo', 'referencia.cargo_id = cargo.id')
                ->all(),'id','nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione la Referencia'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);

    ?>
    </div>
    <div class="col-md-12" class="col-lg-12">
    <?= $form->field($model, 'descripcion')->textarea(['maxlength' => true]) ?>
    </div>
    <div class="col-md-4" class="col-lg-4">
    <?=
    /* Estado con Select2 de kartik*/
        $form->field($model, 'estado_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Estados::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Estado'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);

    ?>
    </div>
    <div class="col-md-4" class="col-lg-4">
    <?=
    /* Municipio con depdrop de kartik*/
    $form->field($model, 'municipio_id')->widget(DepDrop::classname(), [
    'type'=>DepDrop::TYPE_SELECT2,
    'options'=>['id'=>'municipio_id', 'placeholder'=>'Seleccione el Municipio'],
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'placeholder' => 'Seleccione el Municipio',
        'depends'=>["programaevento-estado_id"],
        'url'=>Url::to(['/parroquias/estadan']),
    ]
    ]);
    ?>
    </div>
    <div class="col-md-4" class="col-lg-4">
    <?=
    /* Parroquia con depdrop de kartik*/
    $form->field($model, 'parroquia_id')->widget(DepDrop::classname(), [
    'type'=>DepDrop::TYPE_SELECT2,
    'options'=>['id'=>'parroquia_id', 'placeholder'=>'Seleccione la Parroquia'],
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'placeholder' => 'Seleccione la parroquia',
        'depends'=>['municipio_id'],
        'url'=>Url::to(['/parroquias/municipan']),
    ]
    ]);
    ?>
    </div>
    <div class="col-md-4" class="col-lg-4">
    <?=
        $form->field($model, 'origenid')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Origen::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Origen'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);

    ?>
    </div>
    <div class="col-md-4" class="col-lg-4">
    <?= $form->field($model, 'fechaprograma')->widget(DateControl::classname(), [
    'type'=>DateControl::FORMAT_DATETIME,
    'ajaxConversion'=>false,
    'widgetOptions' => [
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]
]);
    ?>
    </div>
    <div class="col-md-4" class="col-lg-4">
    <?= $form->field($model, 'fecharecibido')->widget(DateControl::classname(), [
	'name' => 'datetime_20',
    'widgetOptions' => [
        'options' => [
            'placeholder' => 'Fecha en que se Recibio la Relación',
            'pluginOptions' => [
                'orientation' => 'top auto',
                'todayHighlight' => true,
                'todayBtn' => true,
                'showMeridian' => true,
                'autoclose' => true,
                'language' => 'es',
            ],
            'orientation' => 'top auto',
        ]
    ],
        'type' => DateControl::FORMAT_DATETIME,
]);
    ?>
    </div>

    <div class="form-group">
        <center>
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => 'btn btn-primary']) ?>
        </center>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>
</div>
