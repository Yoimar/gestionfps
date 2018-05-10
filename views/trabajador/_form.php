<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\User;
use app\models\Users;
use yii\helpers\ArrayHelper;
use app\models\Sssusuarios;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Trabajador */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
<div class="trabajador-form">
    <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

    <?php
    $form = ActiveForm::begin([
        "method" => "post",
        "enableClientValidation" => true,
    ]);
    ?>

    <?=
        $form->field($model, 'user_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(User::find()->orderBy('username')->all(), 'id', 'username'),
        'language' => 'es',
        'options' => ['placeholder' => 'Usuario Gestion FPS'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);

    ?>
</div>
    <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
    <?=
        $form->field($model, 'users_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Users::find()->where(['activated' => 'TRUE'])->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Usuario del SASYC'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);

    ?>

</div>
    <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

    <?=
        $form->field($model, 'usuario_sigesp')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Sssusuarios::find()->where(['actusu' => 0])->orderBy('codusu')->all(), 'codusu', 'codusu'),
        'language' => 'es',
        'options' => ['placeholder' => 'Usuario del SIGESP'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);

    ?>
</div>
    <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
    <?= $form->field($model, 'primernombre')->textInput(['maxlength' => true]) ?>
</div>
    <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
    <?= $form->field($model, 'segundonombre')->textInput(['maxlength' => true]) ?>
</div>
    <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
    <?= $form->field($model, 'primerapellido')->textInput(['maxlength' => true]) ?>
</div>
    <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
    <?= $form->field($model, 'segundoapellido')->textInput(['maxlength' => true]) ?>
</div>
    <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
    <?= $form->field($model, 'ci')->textInput() ?>
</div>
    <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
    <?= $form->field($model, 'dimprofesion')->textInput(['maxlength' => true]) ?>
</div>
    <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
    <?= $form->field($model, 'profesion')->textInput(['maxlength' => true]) ?>
</div>
    <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
    <?= $form->field($model, 'telfextension')->textInput(['maxlength' => true])
    ->widget(MaskedInput::classname(), [
    'name' => 'input-2',
    'mask' => '9999-9999999'
    ]);
    ?>
</div>
    <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
    <?= $form->field($model, 'telfpersonal')->textInput(['maxlength' => true])
    ->widget(MaskedInput::classname(), [
    'name' => 'input-2',
    'mask' => '9999-9999999'
    ]);
    ?>
</div>
    <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
    <?= $form->field($model, 'telfpersonal2')->textInput(['maxlength' => true])
    ->widget(MaskedInput::classname(), [
    'name' => 'input-2',
    'mask' => '9999-9999999'
    ]);
    ?>
</div>
    <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
    <?= $form->field($model, 'telfcasa')->textInput(['maxlength' => true])
    ->widget(MaskedInput::classname(), [
    'name' => 'input-2',
    'mask' => '9999-9999999'
    ]);
    ?>
</div>


<center>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Registrar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</center>

    <?php ActiveForm::end(); ?>

</div>
