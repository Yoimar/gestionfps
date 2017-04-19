<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TrabajadorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trabajador-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'users_id') ?>

    <?= $form->field($model, 'primernombre') ?>

    <?= $form->field($model, 'segundonombre') ?>

    <?php // echo $form->field($model, 'primerapellido') ?>

    <?php // echo $form->field($model, 'segundoapellido') ?>

    <?php // echo $form->field($model, 'ci') ?>

    <?php // echo $form->field($model, 'telfextension') ?>

    <?php // echo $form->field($model, 'telfpersonal') ?>

    <?php // echo $form->field($model, 'telfpersonal2') ?>

    <?php // echo $form->field($model, 'telfcasa') ?>

    <?php // echo $form->field($model, 'dimprofesion') ?>

    <?php // echo $form->field($model, 'profesion') ?>

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
