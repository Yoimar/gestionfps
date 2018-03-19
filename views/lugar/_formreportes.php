<?php

use app\models\Centro;
use app\models\Centrotipo;
use app\models\Estados;
use app\models\Municipios;
use app\models\Parroquias;
use app\models\Centroclasificacion;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model app\models\Lugar */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="lugar-form">

    <div class="col-md-4">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    /* centro_tipo con Select2 de kartik*/
        $form->field($model, 'centro_tipo')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Centrotipo::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Origen del Centro'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    ?>
    </div>
    <div class="col-md-4">

    <?=
    /* Centro_tipo con depdrop de kartik*/
    $form->field($model, 'centro')->widget(DepDrop::classname(), [
    'type'=>DepDrop::TYPE_SELECT2,
    'options'=>['id'=>'centro', 'placeholder'=>'Seleccione el Origen del Centro'],
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'placeholder' => 'Seleccione el Tipo de Centro',
        'depends'=>["lugar-centro_tipo"],
        'url'=>Url::to(['/centroclasificacion/centrotipan']),
    ]
    ]);
    ?>

    </div>
    <div class="col-md-4">

    <?=
    /* Parroquia con depdrop de kartik*/
    $form->field($model, 'centro_clasificacion_id')->widget(DepDrop::classname(), [
    'type'=>DepDrop::TYPE_SELECT2,
    'options'=>['id'=>'centro_clasificacion_id', 'placeholder'=>'Seleccione la Clasificación del Centro'],
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'placeholder' => 'Seleccione la Clasificación',
        'depends'=>['centro'],
        'url'=>Url::to(['/centroclasificacion/centran']),
    ]
    ]);
    ?>

    </div>
    <div class="col-md-4">

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
    <div class="col-md-4">

    <?=
    /* Municipio con depdrop de kartik*/
    $form->field($model, 'municipio_id')->widget(DepDrop::classname(), [
    'type'=>DepDrop::TYPE_SELECT2,
    'options'=>['id'=>'municipio_id', 'placeholder'=>'Seleccione el Municipio'],
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'placeholder' => 'Seleccione el Municipio',
        'depends'=>["lugar-estado_id"],
        'url'=>Url::to(['/parroquias/estadan']),
    ]
    ]);
    ?>

    </div>
    <div class="col-md-4">

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

    <div class="col-md-6">

    <?=
    /* Estado con Select2 de kartik*/
        $form->field($model, 'tipo_reporte')->widget(Select2::classname(), [
        'data' => ArrayHelper::map([
            ['id' => '1', 'nombre' => 'Gráfico de Barras'],
            ['id' => '2', 'nombre' => 'Mapa Tipo 1 HC'],
            ['id' => '3', 'nombre' => 'Mapa Tipo 2 AM']], 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccion el Tipo de Reporte'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    ?>
    </div>
    <div class="col-md-6">

    <div class="form-group">
        <br>
        <?= Html::submitButton('Realizar Reporte', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>


</div>
