<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SolicitudesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="solicitudes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'persona_beneficiario_id') ?>

    <?= $form->field($model, 'persona_solicitante_id') ?>

    <?= $form->field($model, 'area_id') ?>

    <?php // echo $form->field($model, 'referente_id') ?>

    <?php // echo $form->field($model, 'recepcion_id') ?>

    <?php // echo $form->field($model, 'organismo_id') ?>

    <?php // echo $form->field($model, 'ind_mismo_benef')->checkbox() ?>

    <?php // echo $form->field($model, 'ind_inmediata')->checkbox() ?>

    <?php // echo $form->field($model, 'ind_beneficiario_menor')->checkbox() ?>

    <?php // echo $form->field($model, 'actividad') ?>

    <?php // echo $form->field($model, 'referencia') ?>

    <?php // echo $form->field($model, 'referencia_externa') ?>

    <?php // echo $form->field($model, 'accion_tomada') ?>

    <?php // echo $form->field($model, 'necesidad') ?>

    <?php // echo $form->field($model, 'tipo_proc') ?>

    <?php // echo $form->field($model, 'num_proc') ?>

    <?php // echo $form->field($model, 'facturas') ?>

    <?php // echo $form->field($model, 'observaciones') ?>

    <?php // echo $form->field($model, 'moneda') ?>

    <?php // echo $form->field($model, 'estatus') ?>

    <?php // echo $form->field($model, 'usuario_asignacion_id') ?>

    <?php // echo $form->field($model, 'usuario_autorizacion_id') ?>

    <?php // echo $form->field($model, 'fecha_asignacion') ?>

    <?php // echo $form->field($model, 'fecha_aceptacion') ?>

    <?php // echo $form->field($model, 'fecha_aprobacion') ?>

    <?php // echo $form->field($model, 'fecha_cierre') ?>

    <?php // echo $form->field($model, 'tipo_vivienda_id') ?>

    <?php // echo $form->field($model, 'tenencia_id') ?>

    <?php // echo $form->field($model, 'departamento_id') ?>

    <?php // echo $form->field($model, 'memo_id') ?>

    <?php // echo $form->field($model, 'informe_social') ?>

    <?php // echo $form->field($model, 'total_ingresos') ?>

    <?php // echo $form->field($model, 'beneficiario_json') ?>

    <?php // echo $form->field($model, 'solicitante_json') ?>

    <?php // echo $form->field($model, 'num_solicitud') ?>

    <?php // echo $form->field($model, 'version') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
