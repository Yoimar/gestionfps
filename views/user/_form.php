<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'email') ?>
    
    <?= 
        $form->field($model, 'status')->widget(Select2::classname(), [
        'data' => ArrayHelper::map([['id' => '10', 'nombre' => 'Activo'],['id' => '0', 'nombre' => 'Inactivo']], 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => '¿Activo?'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
