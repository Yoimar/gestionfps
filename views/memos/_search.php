<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MemosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="memos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'numero') ?>

    <?= $form->field($model, 'asunto') ?>

    <?= $form->field($model, 'origen_id') ?>

    <?php // echo $form->field($model, 'destino_id') ?>

    <?php // echo $form->field($model, 'usuario_id') ?>

    <?php // echo $form->field($model, 'version') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
