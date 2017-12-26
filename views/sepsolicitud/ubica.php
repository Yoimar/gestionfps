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
<div class="jumbotron" style="font-size: 1em;" >
    <div class="container">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header">
                            <h3 class="display-3">
					Aprobar Caso por el Sigesp 					
                            </h3>
			</div>

                </div>
        </div>
    </div>
</div>
<center>
<div class="container center-block">
	<div class="col-lg-12 col-md-12">
                        <div class="sepingresa-form col-lg-4 col-md-4 col-md-offset-4 col-lg-offset-4">

        <?php $form = ActiveForm::begin(); ?>

        <?= 
        $form->field($model, 'caso')->widget(Select2::classname(), 
            [
            'initValueText' => empty($model->caso) ? '' : Solicitudes::findOne($model->caso)->num_solicitud, // set the initial display text
            'options' => ['placeholder' => 'Ingrese el Caso a Aprobar'],
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
  <div class="col-lg-4 col-md-4 col-lg-offset-4 col-md-offset-4">
                        <?= Html::submitButton('Muestra', ['class' => 'btn btn-success']) ?>
    </div>

        <?php ActiveForm::end(); ?>

    </div>
        
                        
    </div>
    
   
</div>
     <div><?= AlertBlock::widget([ 
                    'type' => AlertBlock::TYPE_ALERT,
                    'useSessionFlash' => true,
                    'delay' => 5000,
                    ]);
             ?>
        </div>
</center>
