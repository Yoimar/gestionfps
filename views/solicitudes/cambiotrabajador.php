<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Personas;
use yii\web\JsExpression;
use \yii\helpers\Url;
use app\models\Users;

/* @var $this yii\web\View */
/* @var $model app\models\Solicitudes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="solicitudes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'num_solicitud')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?=
        $form->field($model, 'persona_beneficiario_id')->widget(Select2::classname(), [
        'initValueText' => empty($model->persona_beneficiario_id) ? '' : Personas::findOne($model->persona_beneficiario_id)->Personacompleta, // set the initial display text
        'options' => ['placeholder' => 'Ingrese el Beneficiario ...'],
        'pluginOptions' => [
        'allowClear' => true,
        'minimumInputLength' => 5,
        'language' => [
            'errorLoading' => new JsExpression("function () { return 'Esperando los resultados...'; }"),
        ],
        'ajax' => [
            'url' => Url::to(['listapersonas']),
            'dataType' => 'json',
            'data' => new JsExpression('function(params) { return {q:params.term}; }')
        ],
        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
        'templateResult' => new JsExpression('function(personas) { return personas.text; }'),
        'templateSelection' => new JsExpression('function (personas) { return personas.text; }'),
        ],
        ]);

    ?>

    <?=
        $form->field($model, 'persona_solicitante_id')->widget(Select2::classname(), [
        'initValueText' => empty($model->persona_solicitante_id) ? '' : Personas::findOne($model->persona_solicitante_id)->Personacompleta, // set the initial display text
        'options' => ['placeholder' => 'Ingrese el Solicitante ...'],
        'pluginOptions' => [
        'allowClear' => true,
        'minimumInputLength' => 5,
        'language' => [
            'errorLoading' => new JsExpression("function () { return 'Esperando los resultados...'; }"),
        ],
        'ajax' => [
            'url' => Url::to(['listapersonas']),
            'dataType' => 'json',
            'data' => new JsExpression('function(params) { return {q:params.term}; }')
        ],
        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
        'templateResult' => new JsExpression('function(personas) { return personas.text; }'),
        'templateSelection' => new JsExpression('function (personas) { return personas.text; }'),
        ],
        ]);

    ?>

    <?=
        $form->field($model, 'usuario_asignacion_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Users::find()->where(['activated' => 'TRUE'])->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Usuario del SASYC'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);

    ?>


    <div class="form-group">
        <?= Html::submitButton('Cambiar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
