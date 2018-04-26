<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\alert\AlertBlock;
use kartik\growl\Growl;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Cheque */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cheque-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->field($model, 'cheque')->textInput(['maxlength' => true]) ?>
    
<?php
$fechahoy = Yii::$app->formatter->asDate('now','php:Y-m-d');
$modelcheque->date_cheque = $fechahoy;
?>
    <center>
            <div class="col-lg-6 col-md-6 col-md-offset-3 col-lg-offset-3">
<div class="panel panel-primary">
<div class="panel-heading">
    <h3 class="panel-title text-center">Seleccione la Fecha</h3>
  </div>
    <hr>
        
    <div class="panel-body center-block">
	<div class="col-lg-6 col-md-8 col-md-offset-2 col-lg-offset-3">
    <center>
<!-- Inicio del Panel-->  
<?= $form->field($modelcheque, 'date_cheque')->widget(DatePicker::classname(), [
            'name' => 'dp_3',
            'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'pluginOptions' => [
                        'autoclose'=>true,
                       'format' => 'yyyy/mm/dd',
                        'language' => 'es',
                        'todayBtn' => 'linked',
                    ]
            ]);
?>
    </center>
    


                     


                
    <div class="col-lg-6 col-md-8 col-lg-offset-3 col-md-offset-2">
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
    </div>

    <?php ActiveForm::end(); ?>
    
    <center>
        
            <hr>
            </div>
    </div>
<!-- Fin del Panel -->    
    
</div>    
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

</div>
