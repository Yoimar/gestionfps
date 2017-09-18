<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Sepsolicitud */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sepsolicitud-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codemp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numsol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codtipsol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codfuefin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecregsol')->textInput() ?>

    <?= $form->field($model, 'estsol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'consol')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'monto')->textInput() ?>

    <?= $form->field($model, 'monbasinm')->textInput() ?>

    <?= $form->field($model, 'montotcar')->textInput() ?>

    <?= $form->field($model, 'tipo_destino')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cod_pro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ced_bene')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coduniadm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codestpro1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codestpro2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codestpro3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codestpro4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codestpro5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estcla')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estapro')->textInput() ?>

    <?= $form->field($model, 'fecaprsep')->textInput() ?>

    <?= $form->field($model, 'codaprusu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numpolcon')->textInput() ?>

    <?= $form->field($model, 'fechaconta')->textInput() ?>

    <?= $form->field($model, 'fechaanula')->textInput() ?>

    <?= $form->field($model, 'nombenalt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipsepbie')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codusu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numdocori')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'conanusep')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'feccieinv')->textInput() ?>

    <?= $form->field($model, 'codcencos')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
