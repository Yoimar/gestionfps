<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ConexionsigespSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="conexionsigesp-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_presupuesto') ?>

    <?= $form->field($model, 'rif') ?>

    <?= $form->field($model, 'req') ?>

    <?= $form->field($model, 'codestpre') ?>

    <?php // echo $form->field($model, 'cuenta') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'estatus_sigesp') ?>

    <?php // echo $form->field($model, 'date_compromiso') ?>

    <?php // echo $form->field($model, 'compromiso_by') ?>

    <?php // echo $form->field($model, 'numrecdoc') ?>

    <?php // echo $form->field($model, 'date_regdocorpa') ?>

    <?php // echo $form->field($model, 'regdocorpa_by') ?>

    <?php // echo $form->field($model, 'date_aprdocorpa') ?>

    <?php // echo $form->field($model, 'aprdocorpa_by') ?>

    <?php // echo $form->field($model, 'orpa') ?>

    <?php // echo $form->field($model, 'date_orpa') ?>

    <?php // echo $form->field($model, 'orpa_by') ?>

    <?php // echo $form->field($model, 'date_aprorpa') ?>

    <?php // echo $form->field($model, 'aprorpa_by') ?>

    <?php // echo $form->field($model, 'date_causado') ?>

    <?php // echo $form->field($model, 'causado_by') ?>

    <?php // echo $form->field($model, 'date_progpago') ?>

    <?php // echo $form->field($model, 'progpago_by') ?>

    <?php // echo $form->field($model, 'cheque') ?>

    <?php // echo $form->field($model, 'date_cheque') ?>

    <?php // echo $form->field($model, 'cheque_by') ?>

    <?php // echo $form->field($model, 'date_enviofirma') ?>

    <?php // echo $form->field($model, 'date_enviocaja') ?>

    <?php // echo $form->field($model, 'date_reccaja') ?>

    <?php // echo $form->field($model, 'date_entregado') ?>

    <?php // echo $form->field($model, 'entregado_by') ?>

    <?php // echo $form->field($model, 'retirado_personaid') ?>

    <?php // echo $form->field($model, 'responsable_by') ?>

    <?php // echo $form->field($model, 'imagenentrega_id') ?>

    <?php // echo $form->field($model, 'date_anulado') ?>

    <?php // echo $form->field($model, 'motivo_anulado') ?>

    <?php // echo $form->field($model, 'anulado_by') ?>

    <?php // echo $form->field($model, 'date_archivo') ?>

    <?php // echo $form->field($model, 'archivo_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
