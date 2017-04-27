<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Bitacoras */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bitacoras-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'solicitud_id')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'nota')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usuario_id')->textInput() ?>

    <?= $form->field($model, 'ind_activo')->checkbox() ?>

    <?= $form->field($model, 'ind_alarma')->checkbox() ?>

    <?= $form->field($model, 'ind_atendida')->checkbox() ?>

    <?= $form->field($model, 'version')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
