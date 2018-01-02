<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Memosgestion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="memosgestion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dirorigen')->textInput() ?>

    <?= $form->field($model, 'unidadorigen')->textInput() ?>

    <?= $form->field($model, 'trabajadororigen')->textInput() ?>

    <?= $form->field($model, 'estatus1origen')->textInput() ?>

    <?= $form->field($model, 'estatus2origen')->textInput() ?>

    <?= $form->field($model, 'estatus3origen')->textInput() ?>

    <?= $form->field($model, 'dirfinal')->textInput() ?>

    <?= $form->field($model, 'unidadfinal')->textInput() ?>

    <?= $form->field($model, 'trabajadorfinal')->textInput() ?>

    <?= $form->field($model, 'estatus1final')->textInput() ?>

    <?= $form->field($model, 'estatus2final')->textInput() ?>

    <?= $form->field($model, 'estatus3final')->textInput() ?>

    <?= $form->field($model, 'fechamemo')->textInput() ?>

    <?= $form->field($model, 'asunto')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
