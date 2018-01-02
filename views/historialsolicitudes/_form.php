<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Historialsolicitudes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="historialsolicitudes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'estatus3_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'gestion_id')->textInput() ?>

    <?= $form->field($model, 'estatus2_id')->textInput() ?>

    <?= $form->field($model, 'estatus1_id')->textInput() ?>

    <?= $form->field($model, 'memogestion_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
