<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Centrotipo;


/* @var $this yii\web\View */
/* @var $model app\models\Centro */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="centro-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'centro_tipo_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Centrotipo::find()->orderBy('nombre')->all(), 'id', 'nombre'),
    'language' => 'es',
    'options' => ['placeholder' => 'Seleccione el Origen'],
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
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
