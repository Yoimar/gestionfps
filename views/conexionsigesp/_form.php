<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Conexionsigesp */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="conexionsigesp-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_presupuesto')->textInput() ?>

    <?= $form->field($model, 'rif')->textInput() ?>

    <?= $form->field($model, 'req')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codestpre')->textInput() ?>

    <?= $form->field($model, 'cuenta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'estatus_sigesp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_compromiso')->textInput() ?>

    <?= $form->field($model, 'compromiso_by')->textInput() ?>

    <?= $form->field($model, 'numrecdoc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_regdocorpa')->textInput() ?>

    <?= $form->field($model, 'regdocorpa_by')->textInput() ?>

    <?= $form->field($model, 'date_aprdocorpa')->textInput() ?>

    <?= $form->field($model, 'aprdocorpa_by')->textInput() ?>

    <?= $form->field($model, 'orpa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_orpa')->textInput() ?>

    <?= $form->field($model, 'orpa_by')->textInput() ?>

    <?= $form->field($model, 'date_aprorpa')->textInput() ?>

    <?= $form->field($model, 'aprorpa_by')->textInput() ?>

    <?= $form->field($model, 'date_causado')->textInput() ?>

    <?= $form->field($model, 'causado_by')->textInput() ?>

    <?= $form->field($model, 'date_progpago')->textInput() ?>

    <?= $form->field($model, 'progpago_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
