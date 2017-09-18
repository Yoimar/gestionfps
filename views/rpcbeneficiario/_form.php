<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Rpcbeneficiario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rpcbeneficiario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codemp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ced_bene')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codpai')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codest')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codmun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codpar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codtipcta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rifben')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombene')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apebene')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dirbene')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'telbene')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'celbene')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sc_cuenta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codbansig')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codban')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ctaban')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foto')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fecregben')->textInput() ?>

    <?= $form->field($model, 'nacben')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numpasben')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipconben')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipcuebanben')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sc_cuentarecdoc')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
