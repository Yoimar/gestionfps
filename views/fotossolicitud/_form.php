<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Fotossolicitud */
/* @var $form yii\widgets\ActiveForm   */
?>

<div class="fotossolicitud-form">

    <?php $form = ActiveForm::begin([
     "method" => "post",
     "enableClientValidation" => true,
     "options" => ["enctype" => "multipart/form-data"],
     ]); ?>

    <?= $form->field($model, 'solicitud_id')->textInput() ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'foto')->textInput(['maxlength' => true]) ?>
    <?php echo $form->field($model, 'ind_reporte')->checkbox() ?>

    <?php
//    echo FileInput::widget([
//    'model' => $model,
//    'attribute' => 'imagen',
//    'options' => ['multiple' => true]
//    ]); ?>

<?php
    echo $form->field($model, 'imagen[]')
        ->widget(FileInput::classname(),[
                'options'=>[
                    //'accept'=>'imagen/*',
                    'multiple'=>true
                ],
                'pluginOptions' => [
                    'initialPreview'=>[
                    isset($model->foto)?Yii::getAlias('@web')."/img/adjuntos/".$model->solicitud_id.'/'.$model->foto:"",
                    ],
                    'initialPreviewAsData'=>true,
                    'initialPreviewShowDelete' => false,
                    'initialCaption'=>"Subir Archivo",
                    'initialPreviewConfig' => [
                        [
                        //comentario para archivos pdf, si no es imagen colocar 'type' => pdf
                        'caption' => $model->foto,
                        ]
                    ],
                    'overwriteInitial'=>false,
                    'maxFileSize'=>28000,
                    'showRemove' => false,
                    'showUpload' => false,
                ],

            ]);
?>


<center>
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-info']) ?>
    </div>
<center>
    <?php ActiveForm::end(); ?>

</div>
