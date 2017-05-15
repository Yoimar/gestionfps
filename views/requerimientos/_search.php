<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RequerimientosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="requerimientos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'cod_item') ?>

    <?= $form->field($model, 'cod_cta') ?>

    <?php // echo $form->field($model, 'tipo_requerimiento_id') ?>

    <?php // echo $form->field($model, 'tipo_ayuda_id') ?>

    <?php // echo $form->field($model, 'version') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
