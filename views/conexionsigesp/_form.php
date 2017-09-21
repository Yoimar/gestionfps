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

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
