<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Personas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_nacionalidad_id')->textInput() ?>

    <?= $form->field($model, 'ci')->textInput() ?>

    <?= $form->field($model, 'sexo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado_civil_id')->textInput() ?>

    <?= $form->field($model, 'lugar_nacimiento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_nacimiento')->textInput() ?>

    <?= $form->field($model, 'nivel_academico_id')->textInput() ?>

    <?= $form->field($model, 'parroquia_id')->textInput() ?>

    <?= $form->field($model, 'ciudad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zona_sector')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'calle_avenida')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apto_casa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono_fijo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono_celular')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono_otro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'twitter')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ind_trabaja')->checkbox() ?>

    <?= $form->field($model, 'ocupacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ingreso_mensual')->textInput() ?>

    <?= $form->field($model, 'observaciones')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ind_asegurado')->checkbox() ?>

    <?= $form->field($model, 'seguro_id')->textInput() ?>

    <?= $form->field($model, 'cobertura')->textInput() ?>

    <?= $form->field($model, 'otro_apoyo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'version')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
