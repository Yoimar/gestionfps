<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Trabajador */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trabajador-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'users_id')->textInput() ?>

    <?= $form->field($model, 'primernombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'segundonombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'primerapellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'segundoapellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ci')->textInput() ?>

    <?= $form->field($model, 'telfextension')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telfpersonal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telfpersonal2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telfcasa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dimprofesion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'profesion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'version')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
