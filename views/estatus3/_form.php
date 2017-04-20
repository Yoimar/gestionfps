<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Estatus2;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use app\models\Estatus1;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Estatus3 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estatus3-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    /* Formu con Select2 de kartik*/
        $form->field($model, 'estatus1_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Estatus1::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Estatus Nivel 1'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>

    <?=
    /* Form con depdrop de kartik*/
    $form->field($model, 'estatus2_id')->widget(DepDrop::classname(), [
    'type'=>DepDrop::TYPE_SELECT2,
    'options'=>['id'=>'estatus2_id', 'placeholder'=>'Seleccione el Estatus Nivel 2'],
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'placeholder' => 'Seleccione el Estatus Nivel 2',
        'depends'=>['estatus3-estatus1_id'],
        'url'=>Url::to(['/estatus3/estatus1']),
    ]
]);
    ?>
    
    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dim')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
