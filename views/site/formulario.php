<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Recepciones;


$this->title = 'Realizar Reporte de Tablas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rpcbeneficiario-create">

    <h1><?= Html::encode($this->title) ?></h1>
</div>

<div class="row">

<div class="reportes-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-xs-12 col-sm-6 col-md-4 col-md-4">
    <?=
        $form->field($model, 'ano')->widget(Select2::classname(), [
        'data' => ArrayHelper::map([
            ['id' => '2016', 'nombre' => '2016'],
            ['id' => '2017', 'nombre' => '2017'],
            ['id' => '2018', 'nombre' => '2018'],
            ['id' => '2019', 'nombre' => '2019'],
            ['id' => '2020', 'nombre' => '2020']
            ], 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => '¿Año?'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);

    ?>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4 col-md-4">

    <?=
        $form->field($model, 'mes')->widget(Select2::classname(), [
        'data' => ArrayHelper::map([
            ['id' => '1', 'nombre' => 'Enero'],
            ['id' => '2', 'nombre' => 'Febrero'],
            ['id' => '3', 'nombre' => 'Marzo'],
            ['id' => '4', 'nombre' => 'Abril'],
            ['id' => '5', 'nombre' => 'Mayo'],
            ['id' => '6', 'nombre' => 'Junio'],
            ['id' => '7', 'nombre' => 'Julio'],
            ['id' => '8', 'nombre' => 'Agosto'],
            ['id' => '9', 'nombre' => 'Septiembre'],
            ['id' => '10', 'nombre' => 'Octubre'],
            ['id' => '11', 'nombre' => 'Noviembre'],
            ['id' => '12', 'nombre' => 'Diciembre']
            ], 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => '¿Mes?'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);

    ?>
    </div>

        <div class="col-xs-12 col-sm-6 col-md-4 col-md-4">

     <?=
        $form->field($model, 'recepcioninicial')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Recepciones::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione Unidad'],
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
