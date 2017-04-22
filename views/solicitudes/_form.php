<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Solicitudes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="solicitudes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'persona_beneficiario_id')->textInput() ?>

    <?= $form->field($model, 'persona_solicitante_id')->textInput() ?>

    <?= $form->field($model, 'area_id')->textInput() ?>

    <?= $form->field($model, 'referente_id')->textInput() ?>

    <?= $form->field($model, 'recepcion_id')->textInput() ?>

    <?= $form->field($model, 'organismo_id')->textInput() ?>

    <?= $form->field($model, 'ind_mismo_benef')->checkbox() ?>

    <?= $form->field($model, 'ind_inmediata')->checkbox() ?>

    <?= $form->field($model, 'ind_beneficiario_menor')->checkbox() ?>

    <?= $form->field($model, 'actividad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'referencia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'referencia_externa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accion_tomada')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'necesidad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_proc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_proc')->textInput() ?>

    <?= $form->field($model, 'facturas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'observaciones')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'moneda')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estatus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usuario_asignacion_id')->textInput() ?>

    <?= $form->field($model, 'usuario_autorizacion_id')->textInput() ?>

    <?= $form->field($model, 'fecha_asignacion')->textInput() ?>

    <?= $form->field($model, 'fecha_aceptacion')->textInput() ?>

    <?= $form->field($model, 'fecha_aprobacion')->textInput() ?>

    <?= $form->field($model, 'fecha_cierre')->textInput() ?>

    <?= $form->field($model, 'tipo_vivienda_id')->textInput() ?>

    <?= $form->field($model, 'tenencia_id')->textInput() ?>

    <?= $form->field($model, 'departamento_id')->textInput() ?>

    <?= $form->field($model, 'memo_id')->textInput() ?>

    <?= $form->field($model, 'informe_social')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'total_ingresos')->textInput() ?>

    <?= $form->field($model, 'beneficiario_json')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'solicitante_json')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'num_solicitud')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
