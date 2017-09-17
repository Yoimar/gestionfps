<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Authassignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="authassignment-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?=
    /* Form con Select2 de kartik*/
        $form->field($model, 'authitem')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Authitem::find()->where("type = 1")->orderBy('name')->all(), 'name', 'name'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione Tipo de Permiso'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>
    
    <?=
    /* Form con Select2 de kartik*/
        $form->field($model, 'user_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\User::find()->orderBy('id')->all(), 'id', 'username'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Usuario'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
