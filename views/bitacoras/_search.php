<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BitacorasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bitacoras-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'solicitud_id') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'nota') ?>

    <?= $form->field($model, 'usuario_id') ?>

    <?php // echo $form->field($model, 'ind_activo')->checkbox() ?>

    <?php // echo $form->field($model, 'ind_alarma')->checkbox() ?>

    <?php // echo $form->field($model, 'ind_atendida')->checkbox() ?>

    <?php // echo $form->field($model, 'version') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
