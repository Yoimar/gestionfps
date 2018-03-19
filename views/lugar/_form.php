<?php

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

use dosamigos\google\maps\Map;
use dosamigos\google\maps\LatLng;

use app\assets\Mapasset;
Mapasset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Lugar */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="lugar-form">

    <div class="col-md-6">

    <?php $form = ActiveForm::begin(); ?>

     <?= $form->field($model, 'searchbox')->textInput(['maxlength' => 255])->label('Lugar de Google Maps') ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?=
    /* Centro Clasificacion Select2 de kartik*/
    $form->field($model, 'centro_clasificacion_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Centroclasificacion::find()->orderBy('nombre')->all(), 'id', 'nombre'),
    'language' => 'es',
    'options' => ['placeholder' => 'Seleccione el Tipo de Centro'],
    'pluginOptions' => [
    'allowClear' => true
    ],
    ]);

    ?>

    <?= $form->field($model, 'lat')->textInput((['placeholder' => 'Coordenada', 'readonly' => true])) ?>

    <?= $form->field($model, 'lng')->textInput((['placeholder' => 'Coordenada', 'readonly' => true])) ?>

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
        'depends'=>["lugar-estado_id"],
        'url'=>Url::to(['/parroquias/estadan']),
    ]
    ]);
    ?>

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

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notas')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>

    <div class="col-md-6">
    <div id="map" style="height: 400px; width: 400px">
    </div>
    </div> <!-- end col2 -->

</div>
