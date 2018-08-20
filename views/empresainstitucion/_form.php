<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Codbancos;

/* @var $this yii\web\View */
/* @var $model app\models\EmpresaInstitucion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="empresa-institucion-form">

    <?php $form = ActiveForm::begin([
        'id' => 'empresa-institucion-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
    ]); ?>

    <?= $form->field($model, 'nombrecompleto')->textInput(['maxlength' => true]) ?>

    <?=
        $form->field($model, 'rif')->widget(Select2::classname(), [
        'data' => ArrayHelper::map([
                ['id' => 'G', 'nombre' => 'G'],
                ['id' => 'J', 'nombre' => 'J'],
                ['id' => 'V', 'nombre' => 'V'],
                ['id' => 'E', 'nombre' => 'E']
            ], 'id', 'nombre'),
        'language' => 'es',
        'changeOnReset' => false,
        'options' => ['placeholder' => '¿Tipo de Rif?'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);

    ?>

    <?= $form->field($model, 'nrif')->textInput(['maxlength' => true]) ?>

    <?=
    /* Form con Select2 de kartik*/
        $form->field($model, 'cod_banco')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Codbancos::find()->orderBy('nombre')->all(), 'codigo', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Banco'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);

    ?>

    <?=
        $form->field($model, 'cod_tip_cta')->widget(Select2::classname(), [
        'data' => ArrayHelper::map([
                ['id2' => '001', 'nombre2' => 'Cuenta Corriente'],
                ['id2' => '002', 'nombre2' => 'Cuenta de Ahorro'],
            ], 'id2', 'nombre2'),
        'language' => 'es',
        'options' => ['placeholder' => '¿Corriente o Ahorro?'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);

    ?>

    <?= $form->field($model, 'cta_banco')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
