<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Estados;
use kartik\datecontrol\DateControl;
use app\models\TipoAyudas;

/* @var $this yii\web\View */
/* @var $modelcheque app\models\ChequeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cheque-search">

    <?php $form = ActiveForm::begin([
        'action' => ['busqueda'],
        'method' => 'get',
    ]); ?>

    <div class="col-lg-2 col-md-2">

    <?= $form->field($modelcheque, 'estado_beneficiario')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Estados::find()->orderBy('nombre')->all(), 'nombre', 'nombre'),
                'language' => 'es',
                'options' => ['placeholder' => '¿Estado?'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

    </div>
    <div class="col-lg-1 col-md-1">

    <?= $form->field($modelcheque, 'anocheque')->widget(Select2::classname(), [
        'data' => ArrayHelper::map([
            ['id' => '2017', 'nombre' => '2017'],
            ['id' => '2018', 'nombre' => '2018'],
            ['id' => '2019', 'nombre' => '2019'],
            ['id' => '2020', 'nombre' => '2020'],
            ['id' => '2021', 'nombre' => '2021']], 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => '¿Año?'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]); ?>

    </div>
    <div class="col-lg-1 col-md-1">

    <?= $form->field($modelcheque, 'mescheque')->widget(Select2::classname(), [
        'data' => ArrayHelper::map([
            ['id' => '01', 'nombre' => 'Enero'],
            ['id' => '02', 'nombre' => 'Febrero'],
            ['id' => '03', 'nombre' => 'Marzo'],
            ['id' => '04', 'nombre' => 'Abril'],
            ['id' => '05', 'nombre' => 'Mayo'],
            ['id' => '06', 'nombre' => 'Junio'],
            ['id' => '07', 'nombre' => 'Julio'],
            ['id' => '08', 'nombre' => 'Agosto'],
            ['id' => '09', 'nombre' => 'Septiembre'],
            ['id' => '10', 'nombre' => 'Octubre'],
            ['id' => '11', 'nombre' => 'Noviembre'],
            ['id' => '12', 'nombre' => 'Diciembre']], 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => '¿Mes?'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]); ?>

    </div>
    <div class="col-lg-1 col-md-1">

    <?= $form->field($modelcheque, 'estatus_cheque')->widget(Select2::classname(), [
        'data' => ArrayHelper::map([
            ['id' => 'EMI', 'nombre' => 'Emitido'],
            ['id' => 'PEN', 'nombre' => 'Pendiente por Entrega'],
            ['id' => 'ENT', 'nombre' => 'Entregado'],
            ['id' => 'ANU', 'nombre' => 'Anulado']], 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => '¿Estatus?'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]); ?>

    </div>
    <div class="col-lg-1 col-md-1">

    <?= $form->field($modelcheque, 'recepcioninicial')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Recepciones::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => '¿Unidad?'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]); ?>

    </div>
    <div class="col-lg-2 col-md-2">

    <?= $form->field($modelcheque, 'date_cheque')->widget(DateControl::classname(), [
	'name' => 'datetime_20',
    'widgetOptions' => [
        'removeButton' => false,
        'options' => [
            'placeholder' => '¿Entregado?',
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
        'type' => DateControl::FORMAT_DATE,
]); ?>

    </div>
    <div class="col-lg-2 col-md-2">

    <?= $form->field($modelcheque, 'date_reccaja')->widget(DateControl::classname(), [
	'name' => 'datetime_20',
    'widgetOptions' => [
        'removeButton' => false,
        'options' => [
            'placeholder' => '¿Recibido?',
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
        'type' => DateControl::FORMAT_DATE,
]); ?>

    </div>
    <div class="col-lg-1 col-md-1">

    <?= $form->field($modelcheque, 'tipodeayuda')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(TipoAyudas::find()->orderBy('nombre')->all(), 'nombre', 'nombre'),
                'language' => 'es',
                'options' => ['placeholder' => 'Seleccione el Tipo'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

    </div>
    <div class="col-lg-1 col-md-1">

    <div class="form-group">
        <br>
        <?= Html::submitButton('Busqueda', ['class' => 'btn btn-primary']) ?>
    </div>

    </div>
    <?php ActiveForm::end(); ?>

</div>
