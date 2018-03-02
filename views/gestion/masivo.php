<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\helpers\Url;
use kartik\alert\AlertBlock;
use app\models\Solicitudes;
use app\models\Estatus1;
use app\models\Estatus2;
use app\models\Estatus3;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model app\models\Sepsolicitud */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="col-lg-12 col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">
    <h3 class="panel-title text-center">Cambiar Masivamente el Estatus de Gestion para los Reportes</h3>
  </div>
    <hr>
    <center>
<!-- Inicio del Panel-->

    <div class="panel-body center-block">
	<div class="col-lg-8 col-md-8 col-md-offset-2 col-lg-offset-2">


        <?php $form = ActiveForm::begin(); ?>

        <?=
        $form->field($model, 'caso')->widget(Select2::classname(),
            [
            'name' => 'caso',
            'maintainOrder' => true,
            'options' => [
            'placeholder' => 'Seleccione los Casos',
            'multiple' => true,
            'showToggleAll' => false,
            'toggleAllSettings' => [
                'selectLabel' => '',
                'unselectLabel' => '',
                'selectOptions' => ['class' => 'text-success'],
                'unselectOptions' => ['class' => 'text-danger'],
              ],],
            'pluginOptions' => [
            'tags' => true,
            'maximumInputLength' => 10,
            'allowClear' => true,
            'minimumInputLength' => 4,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Esperando los resultados...'; }"),
            ],
            'ajax' => [
                'url' => Url::to(['numsolicitud']),
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(solicitudes) { return solicitudes.text; }'),
            'templateSelection' => new JsExpression('function (solicitudes) { return solicitudes.text; }'),
            ],

        ]);
        ?>

        <?=
        /* Estatus 1 con Select2 de kartik*/
            $form->field($model, 'estatus1')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Estatus1::find()->orderBy('nombre')->all(), 'id', 'nombre'),
            'language' => 'es',
            'options' => ['placeholder' => 'Seleccione el Estatus Nivel 1'],
            'pluginOptions' => [
            'allowClear' => true
            ],
        ]);

        ?>

        <?=
        /* Estatus 2 con depdrop de kartik*/
        $form->field($model, 'estatus2')->widget(DepDrop::classname(), [
        'data' => ArrayHelper::map(Estatus2::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'type'=>DepDrop::TYPE_SELECT2,
        'options'=>['id'=>'estatus2', 'placeholder'=>'Seleccione el Estatus Nivel 2'],
        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
        'pluginOptions'=>[
            'placeholder' => 'Seleccione el Estatus Nivel 2',
            'depends'=>['multiplessolicitudes-estatus1'],
            'url'=>Url::to(['/estatus3/estatus1']),
        ]
        ]);
        ?>

        <?=
        /* Estatus 3 con depdrop de kartik*/
        $form->field($model, 'estatus3')->widget(DepDrop::classname(), [
        'type'=>DepDrop::TYPE_SELECT2,
        'options'=>['id'=>'estatus3', 'placeholder'=>'Seleccione el Estatus Nivel 3'],
        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
        'pluginOptions'=>[
            'placeholder' => 'Seleccione el Estatus Nivel 3',
            'depends'=>['estatus2'],
            'url'=>Url::to(['/estatus3/estatus2']),
        ]
        ]);
        ?>
  <div class="col-lg-6 col-md-8 col-lg-offset-3 col-md-offset-2">
                        <?= Html::submitButton('Cambiar Todos', ['class' => 'btn btn-primary']) ?>
    </div>

        <?php ActiveForm::end(); ?>

</div>

    </center>
    <hr>
<!-- Fin del Panel -->

</div>



<center>

     <div><?= AlertBlock::widget([
                    'type' => AlertBlock::TYPE_ALERT,
                    'useSessionFlash' => true,
                    'delay' => 5000,
                    ]);
             ?>
        </div>
</center>

</div>
