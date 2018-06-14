<?php 

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\helpers\Url;
use kartik\alert\AlertBlock;
use app\models\Solicitudes;
use kartik\growl\Growl;

/* @var $this yii\web\View */
/* @var $model app\models\Sepsolicitud */
/* @var $form yii\widgets\ActiveForm */
?>
<br />
<div class="col-lg-6 col-md-6 col-md-offset-3 col-lg-offset-3">
<div class="panel panel-primary">
<div class="panel-heading">
    <h3 class="panel-title text-center">Cheque N° <?= ltrim($cheque,0)?></h3>
    <h3 class="panel-title text-center">Ingrese el Numero de Caso</h3>
  </div>
    <hr>
    <center>
<!-- Inicio del Panel-->  
    
    <div class="panel-body center-block">
    <div class="col-lg-6 col-md-8 col-md-offset-2 col-lg-offset-3">
                        

        <?php 

        $form = ActiveForm::begin(); 

        ?>
        <!-- Forma de Colocar un valor oculto y pasarlo entre modelos -->
        <?= $form->field($model, 'cheque')->hiddenInput(['value'=>$cheque])->label(false); ?>

        <?= 
        $form->field($model, 'caso')->widget(Select2::classname(), 
            [
            'initValueText' => empty($model->caso) ? '' : Solicitudes::findOne($model->caso)->num_solicitud, // set the initial display text
            'options' => ['placeholder' => 'Ingrese el Caso del Cheque', 'class' => 'container center-block','language' => 'es',],
            'language' => 'es',
            'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 4,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Esperando los resultados...'; }"),
            ],
            'ajax' => [
                'url' => Url::to(['//sepsolicitud/numsolicitud']),
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(solicitudes) { return solicitudes.text; }'),
            'templateSelection' => new JsExpression('function (solicitudes) { return solicitudes.text; }'),
            ],
            ]); 
        ?>
    <div class="text-center">
        <div class="text-center">
                        <?= Html::submitButton('Asociar Caso a Cheque', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

        <?php ActiveForm::end(); ?>

    
   
</div>  

    </center>
    <hr>
<!-- Fin del Panel -->    
    
</div>

</div>
<center>
<div class="col-lg-12 col-md-12">
     <div>
         <?php
            echo AlertBlock::widget([
                    'useSessionFlash' => true,
                    'type' => AlertBlock::TYPE_GROWL,
                    'delay' => 0,
                    'alertSettings' => [
                        'success' => ['type' => Growl::TYPE_SUCCESS, 'pluginOptions' => ['placement' => ['from' => 'top', 'align' => 'center']]],
                        'danger' => ['type' => Growl::TYPE_DANGER, 'pluginOptions' => ['placement' => ['from' => 'top', 'align' => 'center']]],
                        'warning' => ['type' => Growl::TYPE_WARNING, 'pluginOptions' => ['placement' => ['from' => 'top', 'align' => 'center']]],
                        'info' => ['type' => Growl::TYPE_INFO, 'pluginOptions' => ['placement' => ['from' => 'top', 'align' => 'center']]]
                        ],
            ])
         ?>
    </div>
</div>
</center>
