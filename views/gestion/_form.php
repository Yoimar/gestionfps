<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Gestion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gestion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'programaevento_id')->textInput() ?>

    <?= $form->field($model, 'solicitud_id')->textInput() ?>

    <?= $form->field($model, 'convenio_id')->textInput() ?>

    <?= $form->field($model, 'estatus3_id')->textInput() ?>

    <?= $form->field($model, 'militar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'afrodescendiente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'indigena')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sexodiversidad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trabajador_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
