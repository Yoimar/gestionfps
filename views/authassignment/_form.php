<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\User;
use yii\helpers\ArrayHelper;
use app\models\Authitem;

/* @var $this yii\web\View */
/* @var $model app\models\Authassignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="authassignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(User::find()->orderBy('username')->all(), 'id', 'username'),
        'language' => 'es',
        'options' => ['placeholder' => 'Usuario Gestión'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]); ?>
    
    <?= $form->field($model, 'item_name')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Authitem::find()->where(['type' => 1])->orderBy('name')->all(), 'name', 'name'),
        'language' => 'es',
        'options' => ['placeholder' => 'Perfil del Usuario'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear': 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
