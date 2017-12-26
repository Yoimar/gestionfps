<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MemosgestionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="memosgestion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'dirorigen') ?>

    <?= $form->field($model, 'unidadorigen') ?>

    <?= $form->field($model, 'trabajadororigen') ?>

    <?= $form->field($model, 'estatus1origen') ?>

    <?php // echo $form->field($model, 'estatus2origen') ?>

    <?php // echo $form->field($model, 'estatus3origen') ?>

    <?php // echo $form->field($model, 'dirfinal') ?>

    <?php // echo $form->field($model, 'unidadfinal') ?>

    <?php // echo $form->field($model, 'trabajadorfinal') ?>

    <?php // echo $form->field($model, 'estatus1final') ?>

    <?php // echo $form->field($model, 'estatus2final') ?>

    <?php // echo $form->field($model, 'estatus3final') ?>

    <?php // echo $form->field($model, 'fechamemo') ?>

    <?php // echo $form->field($model, 'asunto') ?>

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
