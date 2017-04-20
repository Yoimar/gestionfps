<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Estatus1;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Estatus2 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estatus2-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= 
        $form->field($model, 'estatus1_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Estatus1::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Estatus 1'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>
    
    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dim')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
