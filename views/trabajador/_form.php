<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\User;
use app\models\Users;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Trabajador */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trabajador-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= 
        $form->field($model, 'user_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(User::find()->orderBy('username')->all(), 'id', 'username'),
        'language' => 'es',
        'options' => ['placeholder' => 'Usuario Gestion FPS'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>
    
    <?= 
        $form->field($model, 'users_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Users::find()->where(['activated' => 'TRUE'])->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Usuario del SASYC'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>

    <?= $form->field($model, 'primernombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'segundonombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'primerapellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'segundoapellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ci')->textInput() ?>

    <?= $form->field($model, 'telfextension')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telfpersonal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telfpersonal2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telfcasa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dimprofesion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'profesion')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Registrar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
