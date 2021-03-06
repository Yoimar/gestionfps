<?php 

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\helpers\Url;
use kartik\alert\AlertBlock;
use app\models\Solicitudes;

/* @var $this yii\web\View */
/* @var $model app\models\Sepsolicitud */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="col-lg-6 col-md-6 col-md-offset-3 col-lg-offset-3">
<div class="panel panel-primary">
<div class="panel-heading">
    <h3 class="panel-title text-center">Aprobar Caso por el SIGESP</h3>
  </div>
    <hr>
    <center>
<!-- Inicio del Panel-->  
    
    <div class="panel-body center-block">
	<div class="col-lg-6 col-md-8 col-md-offset-2 col-lg-offset-3">
                        

        <?php $form = ActiveForm::begin(); ?>

        <?= 
        $form->field($model, 'caso')->widget(Select2::classname(), 
            [
            'initValueText' => empty($model->caso) ? '' : Solicitudes::findOne($model->caso)->num_solicitud, // set the initial display text
            'options' => ['placeholder' => 'Ingrese el Caso a Aprobar', 'class' => 'container center-block','language' => 'es',],
            'language' => 'es',
            'pluginOptions' => [
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
  <div class="col-lg-6 col-md-8 col-lg-offset-3 col-md-offset-2">
                        <?= Html::submitButton('Muestra', ['class' => 'btn btn-primary']) ?>
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