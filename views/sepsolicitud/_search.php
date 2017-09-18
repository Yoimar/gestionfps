<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SepsolicitudSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sepsolicitud-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'codemp') ?>

    <?= $form->field($model, 'numsol') ?>

    <?= $form->field($model, 'codtipsol') ?>

    <?= $form->field($model, 'codfuefin') ?>

    <?= $form->field($model, 'fecregsol') ?>

    <?php // echo $form->field($model, 'estsol') ?>

    <?php // echo $form->field($model, 'consol') ?>

    <?php // echo $form->field($model, 'monto') ?>

    <?php // echo $form->field($model, 'monbasinm') ?>

    <?php // echo $form->field($model, 'montotcar') ?>

    <?php // echo $form->field($model, 'tipo_destino') ?>

    <?php // echo $form->field($model, 'cod_pro') ?>

    <?php // echo $form->field($model, 'ced_bene') ?>

    <?php // echo $form->field($model, 'coduniadm') ?>

    <?php // echo $form->field($model, 'codestpro1') ?>

    <?php // echo $form->field($model, 'codestpro2') ?>

    <?php // echo $form->field($model, 'codestpro3') ?>

    <?php // echo $form->field($model, 'codestpro4') ?>

    <?php // echo $form->field($model, 'codestpro5') ?>

    <?php // echo $form->field($model, 'estcla') ?>

    <?php // echo $form->field($model, 'estapro') ?>

    <?php // echo $form->field($model, 'fecaprsep') ?>

    <?php // echo $form->field($model, 'codaprusu') ?>

    <?php // echo $form->field($model, 'numpolcon') ?>

    <?php // echo $form->field($model, 'fechaconta') ?>

    <?php // echo $form->field($model, 'fechaanula') ?>

    <?php // echo $form->field($model, 'nombenalt') ?>

    <?php // echo $form->field($model, 'tipsepbie') ?>

    <?php // echo $form->field($model, 'codusu') ?>

    <?php // echo $form->field($model, 'numdocori') ?>

    <?php // echo $form->field($model, 'conanusep') ?>

    <?php // echo $form->field($model, 'feccieinv') ?>

    <?php // echo $form->field($model, 'codcencos') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
