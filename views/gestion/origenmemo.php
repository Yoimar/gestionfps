<?php 

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use yii\helpers\Url;
use app\models\Estatus1;
use app\models\Estatus2;
use app\models\Estatus3;
use kartik\depdrop\DepDrop;

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
					Origen Memo					
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
                            
    <?= $form->field($modelorigenmemo, 'departamento') ?>

    <?= $form->field($modelorigenmemo, 'unidad') ?>

     <?=
    /* Estatus 1 con Select2 de kartik*/
        $form->field($modelorigenmemo, 'estatus1')->widget(Select2::classname(), [
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
    $form->field($modelorigenmemo, 'estatus2')->widget(DepDrop::classname(), [
    'type'=>DepDrop::TYPE_SELECT2,
    'options'=>['id'=>'estatus2_id', 'placeholder'=>'Seleccione el Estatus Nivel 2'],
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'placeholder' => 'Seleccione el Estatus Nivel 2',
        'depends'=>['origenmemo-estatus1'],
        'url'=>Url::to(['/estatus3/estatus1']),
    ]
    ]);
    ?>

    <?=
    /* Estatus 3 con depdrop de kartik*/
    $form->field($modelorigenmemo, 'estatus3')->widget(DepDrop::classname(), [   
    'type'=>DepDrop::TYPE_SELECT2,
    'options'=>['id'=>'estatus3_id', 'placeholder'=>'Seleccione el Estatus Nivel 3'],
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'placeholder' => 'Seleccione el Estatus Nivel 3',
        'depends'=>['estatus2_id'],
        'url'=>Url::to(['/estatus3/estatus2']),
    ]
    ]);
    ?>      
    
    

   
    <div class="col-lg-4 col-md-4 col-lg-offset-4 col-md-offset-4">
                        <?= Html::submitButton('Cargar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>
                        
    </div>
    
</div>
</center>
