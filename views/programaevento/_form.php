<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use app\models\Trabajador;
use app\models\Origen;
use app\models\Referencia;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use app\models\Estados;
use app\models\Parroquias;
use app\models\Municipios;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Programaevento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="programaevento-form">

    <?php $form = ActiveForm::begin(); ?>
    
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

    <?= $form->field($model, 'nprograma')->textInput() ?>

    <?= $form->field($model, 'fechaprograma')->widget(DateTimePicker::classname(), [
	'name' => 'datetime_18',
        'value' => '08-04-2017 10:20 AM',
        'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
        'format' => 'dd/mm/yyyy hh:ii:ss',
        'showMeridian' => true,
        'autoclose' => true,
        'todayBtn' => true
    ]
        ]);
        ?>
    
    <?= 
        $form->field($model, 'trabajadoracargo_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Trabajador::find()->asArray()->all(),'id', function($model, $defaultValue) {
        return $model['dimprofesion'].' '.$model['primernombre'].' '.$model['primerapellido'];}),
        'language' => 'es',
        'options' => ['placeholder' => 'Trabajador FPS'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>
    
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
    
    <?=
    /* Municipio con depdrop de kartik*/
    $form->field($model, 'municipio_id')->widget(DepDrop::classname(), [
    'type'=>DepDrop::TYPE_SELECT2,
    'options'=>['id'=>'municipio_id', 'placeholder'=>'Seleccione el Municipio'],
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'placeholder' => 'Seleccione el Municipio',
        'depends'=>['programaevento-estado_id'],
        'url'=>Url::to(['/parroquias/estadan']),
    ]
    ]);
    ?>

    <?=
    /* Parroquia con depdrop de kartik*/
    $form->field($model, 'parroquia_id')->widget(DepDrop::classname(), [
    'type'=>DepDrop::TYPE_SELECT2,
    'options'=>['id'=>'parroquia_id', 'placeholder'=>'Seleccione el Municipio'],
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'placeholder' => 'Seleccione el Municipio',
        'depends'=>['municipio_id'],
        'url'=>Url::to(['/parroquias/municipan']),
    ]
    ]);
    ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecharecibido')->widget(DateTimePicker::classname(), [
	'name' => 'datetime_18',
        'value' => '02/01/2001 05:10:20',
        'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
        'format' => 'dd/mm/yyyy hh:ii:ss',
        'showMeridian' => true,
        'autoclose' => true,
        'todayBtn' => true
    ]
        ]);
        ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
