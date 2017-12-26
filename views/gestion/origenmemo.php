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
use app\models\Departamentos;
use app\models\Recepciones;
use app\models\Trabajador;

/* @var $this yii\web\View */
/* @var $model app\models\Sepsolicitud */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="jumbotron">
    <div class="container">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header">
                            <h1 class="display-3">
					Localizador					
                            </h1>
			</div>

                </div>
        </div>
    </div>
</div>
<center>
<div class="container center-block">
	<div class="col-lg-12 col-md-12">
                <div class="modelorigenmemo-form col-lg-8 col-md-8 col-md-offset-2 col-lg-offset-2">

        
    <?php $form = ActiveForm::begin(); ?>
                            
    <?= $form->field($modelorigenmemo, 'departamento')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Departamentos::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Departamento'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
            
    ?>

    <?= $form->field($modelorigenmemo, 'unidad')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Recepciones::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione la Unidad'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]); 
            
    ?>
        
    <?=
    /* Trabajador de la Fundacion a la que se le asignó la Gestión*/
        $form->field($modelorigenmemo, 'usuario')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Trabajador::find()->asArray()->all(),'id', function($model, $defaultValue) {
                        return $model['dimprofesion'].' '.$model['primernombre'].' '.$model['primerapellido'];}),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Trabajador'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>

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
    
    
    <?php
    /* Estatus 2 con depdrop de kartik*/
    echo $form->field($modelorigenmemo, 'estatus2')->widget(DepDrop::classname(), [
    'data' => ArrayHelper::map(Estatus2::find()->orderBy('nombre')->all(), 'id', 'nombre'),
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
    'data' => ArrayHelper::map(Estatus3::find()->orderBy('nombre')->all(), 'id', 'nombre'),
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
                        <?= Html::submitButton('Cargar los Casos', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

    
</div>
</center>
