<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Tipoconvenio;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Convenio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="convenio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dimnombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipoconvenio_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Tipoconvenio::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Tipo de Convenio'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
