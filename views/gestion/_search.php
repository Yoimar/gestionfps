<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GestionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gestion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'programaevento_id') ?>

    <?= $form->field($model, 'solicitud_id') ?>

    <?= $form->field($model, 'convenio_id') ?>

    <?= $form->field($model, 'estatus3_id') ?>

    <?php // echo $form->field($model, 'militar') ?>

    <?php // echo $form->field($model, 'afrodescendiente') ?>

    <?php // echo $form->field($model, 'indigena') ?>

    <?php // echo $form->field($model, 'sexodiversidad') ?>

    <?php // echo $form->field($model, 'trabajador_id') ?>

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
