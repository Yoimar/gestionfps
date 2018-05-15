<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Tipoconvenio;
use app\models\Estados;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Convenio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-primary">
<div class="panel-heading">
    <h3 class="panel-title text-center"><?= $this->title ?></h3>
  </div>

    <div class="panel-body center-block">
    <div class="col-lg-12 col-md-12">
<div class="convenio-form">


    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4 col-md-4">
            <?= $form->field($model, 'dimnombre')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4 col-md-4">
            <?= $form->field($model, 'tipoconvenio_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Tipoconvenio::find()->orderBy('nombre')->all(), 'id', 'nombre'),
                'language' => 'es',
                'options' => ['placeholder' => 'Seleccione el Tipo de Convenio'],
                'pluginOptions' => [
                'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-lg-4 col-md-4">
            <?= $form->field($model, 'estado_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Estados::find()->orderBy('nombre')->all(), 'id', 'nombre'),
                'language' => 'es',
                'options' => ['placeholder' => 'Seleccione el Estado de Convenio'],
                'pluginOptions' => [
                'allowClear' => true
                ],
            ]); ?>
        </div>
        <div class="col-lg-12 col-md-12 text-center">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
</div>
</div>
