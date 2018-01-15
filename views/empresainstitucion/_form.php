<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\EmpresaInstitucion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="empresa-institucion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombrecompleto')->textInput(['maxlength' => true]) ?>

    <?= 
        $form->field($model, 'rif')->widget(Select2::classname(), [
        'data' => ArrayHelper::map([['id' => 'G', 'nombre' => 'G'],['id' => 'J', 'nombre' => 'J'],['id' => 'V', 'nombre' => 'V']], 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => '¿Tipo de Rif?'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>

    <?= $form->field($model, 'nrif')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
