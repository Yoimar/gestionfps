<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SnohsalidaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="snohsalida-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'codemp') ?>

    <?= $form->field($model, 'codnom') ?>

    <?= $form->field($model, 'codper') ?>

    <?= $form->field($model, 'anocur') ?>

    <?= $form->field($model, 'codperi') ?>

    <?php // echo $form->field($model, 'codconc') ?>

    <?php // echo $form->field($model, 'tipsal') ?>

    <?php // echo $form->field($model, 'valsal') ?>

    <?php // echo $form->field($model, 'monacusal') ?>

    <?php // echo $form->field($model, 'salsal') ?>

    <?php // echo $form->field($model, 'priquisal') ?>

    <?php // echo $form->field($model, 'segquisal') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
