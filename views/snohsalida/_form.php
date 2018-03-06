<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Snohsalida */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="snohsalida-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codemp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codnom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codper')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'anocur')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codperi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codconc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipsal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valsal')->textInput() ?>

    <?= $form->field($model, 'monacusal')->textInput() ?>

    <?= $form->field($model, 'salsal')->textInput() ?>

    <?= $form->field($model, 'priquisal')->textInput() ?>

    <?= $form->field($model, 'segquisal')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
