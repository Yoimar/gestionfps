<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RpcbeneficiarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rpcbeneficiario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'codemp') ?>

    <?= $form->field($model, 'ced_bene') ?>

    <?= $form->field($model, 'codpai') ?>

    <?= $form->field($model, 'codest') ?>

    <?= $form->field($model, 'codmun') ?>

    <?php // echo $form->field($model, 'codpar') ?>

    <?php // echo $form->field($model, 'codtipcta') ?>

    <?php // echo $form->field($model, 'rifben') ?>

    <?php // echo $form->field($model, 'nombene') ?>

    <?php // echo $form->field($model, 'apebene') ?>

    <?php // echo $form->field($model, 'dirbene') ?>

    <?php // echo $form->field($model, 'telbene') ?>

    <?php // echo $form->field($model, 'celbene') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'sc_cuenta') ?>

    <?php // echo $form->field($model, 'codbansig') ?>

    <?php // echo $form->field($model, 'codban') ?>

    <?php // echo $form->field($model, 'ctaban') ?>

    <?php // echo $form->field($model, 'foto') ?>

    <?php // echo $form->field($model, 'fecregben') ?>

    <?php // echo $form->field($model, 'nacben') ?>

    <?php // echo $form->field($model, 'numpasben') ?>

    <?php // echo $form->field($model, 'tipconben') ?>

    <?php // echo $form->field($model, 'tipcuebanben') ?>

    <?php // echo $form->field($model, 'sc_cuentarecdoc') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
