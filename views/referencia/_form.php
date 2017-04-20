<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Autoridad;
use app\models\Cargo;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Referencia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="referencia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= 
        $form->field($model, 'autoridad_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Autoridad::find()->orderBy('nombredim')->all(), 'id', 'nombredim'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el nombre de la Autoridad'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>
    <?= 
        $form->field($model, 'cargo_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Cargo::find()->orderBy('nombredim')->all(), 'id', 'nombredim'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el nombre del cargo'],
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
