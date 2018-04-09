<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cheque */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cheque-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cheque')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_presupuesto')->textInput() ?>

    <?= $form->field($model, 'estatus_cheque')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_cheque')->textInput() ?>

    <?= $form->field($model, 'cheque_by')->textInput() ?>

    <?= $form->field($model, 'date_enviofirma')->textInput() ?>

    <?= $form->field($model, 'date_enviocaja')->textInput() ?>

    <?= $form->field($model, 'date_reccaja')->textInput() ?>

    <?= $form->field($model, 'date_entregado')->textInput() ?>

    <?= $form->field($model, 'entregado_by')->textInput() ?>

    <?= $form->field($model, 'retirado_personaid')->textInput() ?>

    <?= $form->field($model, 'responsable_by')->textInput() ?>

    <?= $form->field($model, 'imagenentrega_id')->textInput() ?>

    <?= $form->field($model, 'date_anulado')->textInput() ?>

    <?= $form->field($model, 'motivo_anulado')->textInput() ?>

    <?= $form->field($model, 'anulado_by')->textInput() ?>

    <?= $form->field($model, 'date_archivo')->textInput() ?>

    <?= $form->field($model, 'archivo_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
