<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use yii\helpers\Url;
use kartik\datetime\DateTimePicker;
use yii\bootstrap\Modal;
use app\models\Programaevento;
use app\models\Estatus1;
use app\models\Estatus2;
use app\models\Estatus3;
use app\models\Trabajador;
use kartik\depdrop\DepDrop;

$model->estatus1_id = $model->estatus3->estatus2->estatus1->id;
$model->estatus2_id = $model->estatus3->estatus2->id;


/* @var $this yii\web\View */
/* @var $model app\models\Gestion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gestion-form">

    <?php $form = ActiveForm::begin([
        'id' => 'gestion-form',
        'enableAjaxValidation' => true,
        'enableClientScript' => true,
        'enableClientValidation' => true,]); ?>

<div class="row">
<div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
    <?=
    /* Estatus 1 con Select2 de kartik*/
        $form->field($model, 'estatus1_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Estatus1::find()->where(['<>','id',2])->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Estatus 1'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);

    ?>
</div>
<div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
    <?=
    /* Estatus 2 con depdrop de kartik*/
    $form->field($model, 'estatus2_id')->widget(DepDrop::classname(), [
    'data' => ArrayHelper::map(Estatus2::find()->orderBy('nombre')->all(), 'id', 'nombre'),
    'type'=>DepDrop::TYPE_SELECT2,
    'options'=>['id'=>'estatus2_id', 'placeholder'=>'Estatus 2'],
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'placeholder' => 'Estatus 2',
        'depends'=>['gestion-estatus1_id'],
        'url'=>Url::to(['/estatus3/estatus1']),
    ]
    ]);
    ?>
</div>
<div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
    <?=
    /* Estatus 3 con depdrop de kartik*/
    $form->field($model, 'estatus3_id')->widget(DepDrop::classname(), [
    'data' => ArrayHelper::map(Estatus3::find()->orderBy('nombre')->all(), 'id', 'nombre'),
    'type'=>DepDrop::TYPE_SELECT2,
    'options'=>['id'=>'estatus3_id', 'placeholder'=>'Estatus 3'],
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'placeholder' => 'Estatus 3',
        'depends'=>['estatus2_id'],
        'url'=>Url::to(['/estatus3/estatus2']),
    ]
    ]);
    ?>
</div>

<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
    <?=
        $form->field($model, 'programaevento_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Programaevento::find()->orderBy('descripcion')->all(), 'id', 'descripcion'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Programa Evento o Actividad'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);

    ?>
</div>

</div>

    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Registrar Gestión' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerJs('
    // obtener la id del formulario y establecer el manejador de eventos
        $("form#gestion-form").on("beforeSubmit", function(e) {
            var form = $(this);
            $.post(
                form.attr("action")+"&submit=true",
                form.serialize()
            )
            .done(function(result) {
                form.parent().html(result.message);
                $.pjax.reload({container:"#gestion-grid-masivoxtrabajador"});
            });
            return false;
        }).on("submit", function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            return false;
        });
    ');
?>
