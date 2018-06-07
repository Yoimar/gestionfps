<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\builder\TabularForm;

$form = ActiveForm::begin();
echo TabularForm::widget([
    'dataProvider'=>$dataProvider,
    'form'=>$form,
    'attributes'=>$model->formAttribs
]);

echo '<div class="text-right">' .
     Html::submitButton('Guardar', ['class'=>'btn btn-primary']) .
     '</div>';
ActiveForm::end();

?>
