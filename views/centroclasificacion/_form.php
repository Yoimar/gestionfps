<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Centro;

/* @var $this yii\web\View */
/* @var $model app\models\Centroclasificacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="centroclasificacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?=

    $form->field($model, 'centro_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Centro::find()->orderBy('nombre')->all(), 'id', 'nombre'),
    'language' => 'es',
    'options' => ['placeholder' => 'Seleccione el Centro'],
    'pluginOptions' => [
    'allowClear' => true
    ],
    ]);

    ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
