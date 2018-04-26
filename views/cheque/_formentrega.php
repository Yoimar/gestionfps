<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Scbmovbco;
use yii\helpers\ArrayHelper;
use kartik\alert\AlertBlock;
use kartik\growl\Growl;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Cheque */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cheque-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->field($model, 'cheque')->textInput(['maxlength' => true]) ?>
    
    <?=

    $form->field($modelcheque, 'cheque')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Scbmovbco::find()
                ->select([
                    "ltrim(numdoc,'0') as codper",
                    'numdoc'
                ])
                ->where([
                    'codope' => 'CH',
                    'estmov' => ['N','C','O','L']
                ])->orderBy('numdoc')->all(), 'numdoc', 'codper'),
    'language' => 'es',
    'options' => ['placeholder' => 'Seleccione el Cheque'],
    'pluginOptions' => [
    'allowClear' => true
    ],
    ]);

    ?>


    <div class="form-group">
        <?= Html::submitButton('Revisar Cheque', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
    
    <?php
    
    if ($chequemanual == 1) {
    echo Html::a('Carga Manual <span class="glyphicon glyphicon-share-alt"></span>', ['chequemanual',
            'cheque' => $modelcheque->cheque,
            ], 
            [
                'class'=>'btn btn-primary', 
                'data-container' => 'body', 
                'data-toggle' => 'tooltip', 
                'data-placement'=> 'bottom', 
                'title'=>'Realizar Entrega del Caso'
            ]);
        
    }
    
    if ($iraentrega == 1) {
    echo Html::a('Realizar Entrega<span class="glyphicon glyphicon-download-alt"></span>', ['iraentrega',
            'cheque' => $modelcheque->cheque,
            ], 
            [
                'class'=>'btn btn-primary', 
                'data-container' => 'body', 
                'data-toggle' => 'tooltip', 
                'data-placement'=> 'bottom', 
                'title'=>'Carga de Caso De Manera Manual'
            ]);
        
    } 
    
    
    
    ?>
    
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

</div>
