<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Programaevento;


$this->title = 'Realizar Reporte Por Actividad';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rpcbeneficiario-create">

    <h1><?= Html::encode($this->title) ?></h1>
</div>

<div class="row">

<div class="reportes-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-sm-offset-3 col-md-offset-4 col-lg-offset-4">

    <?=
        $form->field($model, 'actividad')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Programaevento::find()->orderBy('descripcion')->all(), 'id', 'descripcion'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Programa Evento o Actividad'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);

    ?>
    </div>


    <div class="col-xs-4 col-sm-4 col-md-4 col-md-4 col-xs-offset-4 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">
    <center>
    <div class="form-group">
        <?= Html::submitButton('Generar', ['class' => 'btn btn-primary text-center']) ?>
    </div>
    </center>
    </div>
    <?php ActiveForm::end(); ?>

</div>
</div>
