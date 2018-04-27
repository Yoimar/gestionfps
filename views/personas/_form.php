<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use kartik\datetime\DateTimePicker;
use app\models\TipoNacionalidades;
use app\models\EstadosCiviles;
use app\models\NivelesAcademicos;
use kartik\depdrop\DepDrop;
use app\models\Estados;
use app\models\Parroquias;
use app\models\Municipios;
use app\models\Seguros;
use yii\helpers\Url;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Personas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>

    <?= 
        $form->field($model, 'tipo_nacionalidad_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(TipoNacionalidades::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione la nacionalidad'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>
    
    <?= $form->field($model, 'ci')->textInput() ?>

    <?= 
        $form->field($model, 'sexo')->widget(Select2::classname(), [
        'data' => ArrayHelper::map([['id' => 'M', 'nombre' => 'Masculino'],['id' => 'F', 'nombre' => 'Femenino']], 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Genero'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>
    
    <?= 
        $form->field($model, 'estado_civil_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(EstadosCiviles::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Estado Civil'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>

    <?= $form->field($model, 'lugar_nacimiento')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'fecha_nacimiento')->widget(DateTimePicker::classname(), [
	'name' => 'datetime_18',
        'options' => ['placeholder' => 'Ingrese la Fecha de Nacimiento'],
        'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
        'value' => '23-04-2017',
        'pluginOptions' => [
            'todayHighlight' => true,
            'todayBtn' => true,
            'autoclose'=>true,
            'showMeridian' => true,
            'format' => 'dd-mm-yyyy',
            'minView' => '2',
        ]
        ]);
        ?>

    <?= 
        $form->field($model, 'nivel_academico_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(NivelesAcademicos::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Nivel Academico'],
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
        'depends'=>['personas-estado_id'],
        'url'=>Url::to(['/parroquias/estadan']),
    ]
    ]);
    ?>

    <?=
    /* Parroquia con depdrop de kartik*/
    $form->field($model, 'parroquia_id')->widget(DepDrop::classname(), [
    'type'=>DepDrop::TYPE_SELECT2,
    'options'=>['id'=>'parroquia_id', 'placeholder'=>'Seleccione La Parroquia'],
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'placeholder' => 'Seleccione La Parroquia',
        'depends'=>['municipio_id'],
        'url'=>Url::to(['/parroquias/municipan']),
    ]
    ]);
    ?>

    <?= $form->field($model, 'ciudad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zona_sector')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'calle_avenida')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apto_casa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono_fijo')->widget(MaskedInput::classname(), [ 
    'name' => 'input-1',
    'mask' => '9999-9999999'
    ]);
    ?>
    <?= $form->field($model, 'telefono_celular')->widget(MaskedInput::classname(), [ 
    'name' => 'input-2',
    'mask' => '9999-9999999'
    ]);
    ?>

    <?= $form->field($model, 'telefono_otro')->widget(MaskedInput::classname(), [ 
    'name' => 'input-3',
    'mask' => '9999-9999999'
    ]);
    ?>

    <?= $form->field($model, 'email')->widget(MaskedInput::classname(), [ 
        'name' => 'input-36',
        'clientOptions' => [
            'alias' =>  'email'
        ],
    ]); 
    ?>

    <?= $form->field($model, 'twitter')->widget(MaskedInput::classname(), [ 
        'name' => 'input-2',
        'mask' => '@*{1,50}'
        ]
    ); ?>

    <?= $form->field($model, 'ind_trabaja')->checkbox() ?>

    <?= $form->field($model, 'ocupacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ingreso_mensual')->textInput() ?>

    <?= $form->field($model, 'observaciones')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ind_asegurado')->checkbox() ?>
    
    <?= 
        $form->field($model, 'seguro_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Seguros::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Seguro'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>

    <?= $form->field($model, 'cobertura')->textInput() ?>

    <?= $form->field($model, 'otro_apoyo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
