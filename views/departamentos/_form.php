<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Users;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Departamentos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="departamentos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= 
        $form->field($model, 'supervisor_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Users::find()->where(['activated' => 'TRUE'])->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Estatus 1'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
