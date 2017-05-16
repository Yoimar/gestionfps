<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PresupuestosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="presupuestos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'solicitud_id') ?>

    <?= $form->field($model, 'requerimiento_id') ?>

    <?= $form->field($model, 'proceso_id') ?>

    <?= $form->field($model, 'documento_id') ?>

    <?php // echo $form->field($model, 'moneda') ?>

    <?php // echo $form->field($model, 'beneficiario_id') ?>

    <?php // echo $form->field($model, 'cantidad') ?>

    <?php // echo $form->field($model, 'monto') ?>

    <?php // echo $form->field($model, 'montoapr') ?>

    <?php // echo $form->field($model, 'estatus_doc') ?>

    <?php // echo $form->field($model, 'cheque') ?>

    <?php // echo $form->field($model, 'version') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'numop') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
