<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Bitacoras */
$labelbitacoraright = 'style="border-left: solid 1px black;
border-top: solid 0.5px black;
border-right: none;
border-bottom: none;
text-align:left;
margin: 0px; padding: 0px;
font-size:11px;"';
$labelbitacoracenter = 'style="border-left: none;
border-top: solid 0.5px black;
border-right: none;
border-bottom: none;
text-align:left;
margin: 0px; padding: 0px;
font-size:11px;"';
$labelbitacoraleft = 'style="border-left: none;
border-top: solid 0.5px black;
border-right: solid 1px black;
border-bottom: none;
text-align:right;
margin: 0px; padding: 0px;
font-size:11px;"';
$datobitacora = 'style="border-left: solid 1px black;
border-bottom: none;
border-right: solid 1px black;
border-top: none;
text-align:justify; padding-top: 5px; font-size:13px;"';

$this->title = 'Actualizar Bitacora: '.$model->solicitud->num_solicitud;
?>
<div class="bitacoras-update">

    <h3><?= Html::encode($this->title) ?></h3>
    <table class="table-bordered table-responsive table-striped table" style="border-left: none;
border: solid 1px black;
margin: 0px; padding: 0px;
font-size:10px;">
    <?php
$modelosbitacoras = $dataProvider->getModels();

        foreach ($modelosbitacoras as $bitacoras):

?>
    <tr>
        <td colspan="1" class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $labelbitacoraright ?>>
        <small>FECHA: <?= Yii::$app->formatter->asDate($bitacoras->fecha) ?></small>
    </td>
    <td colspan="3" class="col-xs-6 col-sm-6 col-md-6 col-lg-6" <?= $labelbitacoracenter ?> >
        <small><strong></strong></small>
    </td>
    <td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $labelbitacoraleft ?> >
        <small><?= strtoupper($bitacoras->usuario->nombre) ?></small>
    </td>
    </tr>
    <tr>
    <td colspan="6" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" <?= $datobitacora ?> >
        <?= strtoupper($bitacoras->nota) ?>&nbsp;
    </td>
    </tr>

<?php
        endforeach;
?>

</table>
    
</div>
<div class="row">
    
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="bitacoras-form">    
        <?php $form = ActiveForm::begin([
            'id' => 'bitacoras-form',
            'enableAjaxValidation' => true,
            'enableClientScript' => true,
            'enableClientValidation' => true,
        ]); ?>

        <?= $form->field($model, 'nota')->textarea(['maxlength' => true]) ?>

        <div class="form-group text-center">
            <?= Html::submitButton('Crear Nota', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>    
        
    </div>
    
</div>
<?php
$this->registerJs('
    // obtener la id del formulario y establecer el manejador de eventos
        $("form#bitacoras-form").on("beforeSubmit", function(e) {
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
 
