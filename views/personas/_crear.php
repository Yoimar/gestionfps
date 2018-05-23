<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;
use app\models\TipoNacionalidades;
use kartik\depdrop\DepDrop;
use app\models\Estados;
use app\models\Parroquias;
use app\models\Municipios;
use yii\helpers\Url;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Personas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personas-form">

    <?php $form = ActiveForm::begin([
        "method" => "post",
        "enableClientValidation" => true,
    ]);
    if (isset($model->parroquia_id)) {
    $parroquia = Parroquias::findOne($model->parroquia_id);
    $municipio = Municipios::findOne($parroquia->municipio_id);
    $model->municipio_id = $municipio->id;
    $model->estado_id = $municipio->estado_id;
    }



    ?>

    <div class="row">

        <div class="col-md-6">
            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6">
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
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ci')->textInput() ?>
        </div>
    </div>

    <div class="row">

        <div class="col-md-4">
            <?=
            /* Estado con Select2 de kartik */
            $form->field($model, 'estado_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Estados::find()->orderBy('nombre')->all(), 'id', 'nombre'),
                'language' => 'es',
                'options' => [
                    'id' => 'estado_id',
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
            $form->field($model, 'municipio_id')->widget(DepDrop::classname(), [
                'data' => ArrayHelper::map(Municipios::find()->orderBy('nombre')->all(), 'id', 'nombre'),
                'type' => DepDrop::TYPE_SELECT2,
                'options' => ['id' => 'municipio_id', 'placeholder' => 'Seleccione el Municipio'],
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'placeholder' => 'Seleccione el Municipio',
                    'depends' => ['estado_id'],
                    'url' => Url::to(['/parroquias/estadan']),
                ]
            ]);
            ?>
        </div>

        <div class="col-md-4">
            <?=
            /* Parroquia con depdrop de kartik */
            $form->field($model, 'parroquia_id')->widget(DepDrop::classname(), [
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
            $form->field($model, 'telefono_celular')
                ->widget(MaskedInput::classname(), [
                'name' => 'input-2',
                'mask' => '9999-9999999'
            ]);
            ?>
        </div>

        <div class="col-md-4">
            <?=
            $form->field($model, 'telefono_fijo')
                ->widget(MaskedInput::classname(), [
                'name' => 'input-1',
                'mask' => '9999-9999999'
            ]);
            ?>
        </div>

        <div class="col-md-4">
            <?=
            $form->field($model, 'telefono_otro')
                ->widget(MaskedInput::classname(), [
                'name' => 'input-3',
                'mask' => '9999-9999999'
            ]);
            ?>
        </div>

    </div>

    <div class="row">

        <div class="col-md-4">

        <?= $form->field($model, 'fecha_nacimiento')->widget(DateControl::classname(), [
        'type'=>DateControl::FORMAT_DATE,
        'ajaxConversion'=>false,
        'widgetOptions' => [
            'removeButton' => false,
            'pluginOptions' => [
                'autoclose' => true
            ]
        ]
    ]);
        ?>
         </div>

        <div class="col-md-4">

    <?= $form->field($model, 'email')->widget(MaskedInput::classname(), [
        'name' => 'input-36',
        'clientOptions' => [
            'alias' =>  'email'
        ],
    ]);
    ?>
        </div>
        <div class="col-md-4">

    <?= $form->field($model, 'twitter')->widget(MaskedInput::classname(), [
        'name' => 'input-2',
        'mask' => '@*{1,50}'
        ]
    );
    ?>
        </div>


    </div>


    <div class="form-group align-items-center">
        <div class="col text-center">
        <?= Html::submitButton('Actualizar', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
