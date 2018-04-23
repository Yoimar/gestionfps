<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Scbmovbco;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Cheque */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cheque-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->field($model, 'cheque')->textInput(['maxlength' => true]) ?>
    
    <?=

    $form->field($model, 'cheque')->widget(Select2::classname(), [
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
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
