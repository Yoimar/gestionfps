<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Trabajador;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;
use unclead\multipleinput\MultipleInput;
use app\models\Multiplerol;

/* @var $this yii\web\View */
/* @var $model app\models\Rolguardias */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rolguardias-form">

    <?php $form = ActiveForm::begin(); 
    ?>
    

    
    <?=
    
        $form->field($model, 'id_trabajador')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Trabajador::find()->asArray()->all(),'id', function($model, $defaultValue) {
        return "C.I.:".$model['ci'].'  '.$model['primernombre'].' '.$model['primerapellido'];}),
        'language' => 'es',
        'options' => ['placeholder' => 'Trabajador FPS'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    ?>
    
    <?=
    
    $form->field($model, 'fecha')->widget(DateTimePicker::classname(), [
	'name' => 'datetime_20',
        'options' => ['placeholder' => 'Ingrese la Fecha en que se realizo el Programa'],
        'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
        'pluginOptions' => [
            'orientation' => 'up right',
            'startView' => 2,
            'minView' => 2,
            'maxView' => 2,
            'todayHighlight' => true,
            'todayBtn' => true,
            'format' => 'dd-mm-yyyy',
            'showMeridian' => false,
            'autoclose' => true,
            'language' => 'es',
            ]
        ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
