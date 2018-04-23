<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ChequeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cheque-search">

    <?php $form = ActiveForm::begin([
        'action' => ['busqueda'],
        'method' => 'get',
    ]); ?>

    <div class="col-lg-2 col-md-2">

    <?= $form->field($model, 'estado_beneficiario') ?>

    </div>
    <div class="col-lg-1 col-md-1">

    <?= $form->field($model, 'anocheque') ?>

    </div>
    <div class="col-lg-1 col-md-1">

    <?= $form->field($model, 'mescheque') ?>

    </div>
    <div class="col-lg-1 col-md-1">

    <?= $form->field($model, 'estatus_cheque') ?>

    </div>
    <div class="col-lg-1 col-md-1">

    <?= $form->field($model, 'recepcioninicial') ?>

    </div>
    <div class="col-lg-2 col-md-2">

    <?= $form->field($model, 'date_cheque') ?>

    </div>
    <div class="col-lg-2 col-md-2">

    <?= $form->field($model, 'date_reccaja') ?>

    </div>
    <div class="col-lg-1 col-md-1">

    <?= $form->field($model, 'tipodeayuda') ?>

    </div>
    <div class="col-lg-1 col-md-1">

    <div class="form-group">
        <br>
        <?= Html::submitButton('Busqueda', ['class' => 'btn btn-primary']) ?>
    </div>

    </div>
    <?php ActiveForm::end(); ?>

</div>
