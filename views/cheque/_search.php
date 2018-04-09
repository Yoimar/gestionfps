<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ChequeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cheque-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'cheque') ?>

    <?= $form->field($model, 'id_presupuesto') ?>

    <?= $form->field($model, 'estatus_cheque') ?>

    <?= $form->field($model, 'date_cheque') ?>

    <?= $form->field($model, 'cheque_by') ?>

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

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
