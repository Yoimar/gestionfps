<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\TipoNacionalidades;
use app\models\Estados;
use app\models\Municipios;
use app\models\Parroquias;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\widgets\MaskedInput;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Cheque */

$this->title = 'Cargar Foto y Realizar Entrega';
$this->params['breadcrumbs'][] = ['label' => 'Cheques', 'url' => ['busqueda']];
$this->params['breadcrumbs'][] = $this->title;

/** Inicializar el depdrown de Kartik **/
if (isset($modelpersonabeneficiario->parroquia_id)) {
    $parroquia = Parroquias::findOne($modelpersonabeneficiario->parroquia_id);
    $municipio = Municipios::findOne($parroquia->municipio_id);
    $modelpersonabeneficiario->municipio_id = $municipio->id;
    $modelpersonabeneficiario->estado_id = $municipio->estado_id;
}


?>
<div class="cheque-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    /* Esto es para vistas que estan en otro controlador */
    //echo $this->render('//fotossolicitud/_form', [
    //      'model' => $modelfotossolicitud,
    //      ]) ?>

    <?php $form = ActiveForm::begin(); ?>

    <?php
        echo $form->field($modelsolicitud, 'num_solicitud')->widget(Select2::classname(), [
        'disabled' => true,
        'language' => 'es',
        'pluginOptions' => [
        'allowClear' => true
        ],
    ])->label('Caso a entregar');

        $modelcheque->cheques =$modelcheque->cheque;

    ?>

    <?= $form->field($modelcheque, 'cheques')
            ->checkboxList($chequesdisponibles,[
                //'itemOptions' => [
                //'labelOptions' => ['class' => 'col-md-3']
                //]
                ])
    ?>

    <?= $form->field($modelpersonabeneficiario, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelpersonabeneficiario, 'apellido')->textInput(['maxlength' => true]) ?>

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

    <?= $form->field($modelpersonabeneficiario, 'ci')->textInput() ?>

    <?=
    /* Estado con Select2 de kartik*/
        $form->field($modelpersonabeneficiario, 'estado_id')->widget(Select2::classname(), [
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
    $form->field($modelpersonabeneficiario, 'municipio_id')->widget(DepDrop::classname(), [
    'data' => ArrayHelper::map(Municipios::find()->orderBy('nombre')->all(), 'id', 'nombre'),
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
    $form->field($modelpersonabeneficiario, 'parroquia_id')->widget(DepDrop::classname(), [
    'data' => ArrayHelper::map(Parroquias::find()->orderBy('nombre')->all(), 'id', 'nombre'),
    'type'=>DepDrop::TYPE_SELECT2,
    'options'=>['id'=>'parroquia_id', 'placeholder'=>'Seleccione La Parroquia'],
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'placeholder' => 'Seleccione La Parroquia',
        //'initialize' => true,
        //'initDepends'=>['modelpersonabeneficiario-municipio_id'],
        'depends'=>['municipio_id'],
        'url'=>Url::to(['/parroquias/municipan']),
    ]
    ]);
    ?>

    <?= $form->field($modelpersonabeneficiario, 'telefono_fijo')->widget(MaskedInput::classname(), [
    'name' => 'input-1',
    'mask' => '9999-9999999'
    ]);
    ?>
    <?= $form->field($modelpersonabeneficiario, 'telefono_celular')->widget(MaskedInput::classname(), [
    'name' => 'input-2',
    'mask' => '9999-9999999'
    ]);
    ?>

    <?= $form->field($modelpersonabeneficiario, 'telefono_otro')->widget(MaskedInput::classname(), [
    'name' => 'input-3',
    'mask' => '9999-9999999'
    ]);
    ?>

    <?= $form->field($modelpersonabeneficiario, 'email')->widget(MaskedInput::classname(), [
        'name' => 'input-36',
        'clientOptions' => [
            'alias' =>  'email'
        ],
    ]);
    ?>

    <?= $form->field($modelpersonabeneficiario, 'twitter')->widget(MaskedInput::classname(), [
        'name' => 'input-2',
        'mask' => '@*{1,50}'
        ]
    );
    ?>

    <?=
        $form->field($modelsolicitud, 'area_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Areas::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Area'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);

    ?>

    <?=
        $form->field($modelsolicitud, 'recepcion_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Recepciones::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione la Recepción'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);

    ?>

    <?= $form->field($modelsolicitud, 'necesidad')->textInput(['maxlength' => true]) ?>

    <?=
        $form->field($modelsolicitud, 'estatus')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Estatussasyc::find()->orderBy('id')->all(), 'id', 'estatus'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione El Estatus'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);

    ?>

    <?= $form->field($modelsolicitud, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?php
        echo $form->field($modelfotossolicitud, 'imagen[]')
            ->widget(FileInput::classname(),[
                    'options'=>[
                        //'accept'=>'imagen/*',
                        'multiple'=>true
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

    <?php

    echo "<br><pre>";
    print_r($chequesdisponibles);
    echo "</pre>";

    ?>

    <div class="form-group">
        <?= Html::submitButton($modelfotossolicitud->isNewRecord ? 'Registrar Entrega' : 'Actualizar Entrega',
                ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
