<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\BaseHtml;

use app\assets\Locateasset;
Locateasset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Lugar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lugar-form">
    <!-- Inicio de la Columna 1 -->
    
    <div class="row">
    <div class="col-md-6" >

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'centro_clasificacion_id')->textInput() ?>

    <?= $form->field($model, 'google_place_gps')->textInput() ?>

    <?= $form->field($model, 'nombre_slug')->textInput() ?>

    <?= $form->field($model, 'parroquia_id')->textInput() ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notas')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>
        
    <?= BaseHtml::activeHiddenInput($model, 'lat'); ?>
    <?= BaseHtml::activeHiddenInput($model, 'lng'); ?>    
    
    <!-- Fin de la Columna 1 -->
    </div>
    
    <!-- Inicio de la Columna 2 -->
    <div class="col-md-6">
    <div id="preSearch" class="center">
    <p>
        <br />
    </p>    
    <?= Html::a('Lookup Location', 
            ['lookup'], 
            ['class' => 'btn btn-success', 
            'onclick' => "javascript:beginSearch();return false;"]) ?> 
    </div>
 
    <div id="searchArea" class="hidden">
    <div id="autolocateAlert">
    </div> <!-- end autolocateAlert -->
    <p>Buscando la informacion sobre su posición actual<span id="status"></span></p>    
    <article>
    </article>
    <div class="form-actions hidden" id="actionBar">      
    
    </div> <!-- end action Bar-->
    </div>   <!-- end searchArea -->
  
  
    <!-- Fin de la Columna2 -->
    </div>
    
    </div>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
