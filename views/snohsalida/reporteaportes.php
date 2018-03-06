<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$this->title = 'Reporte Aportes';
$this->params['breadcrumbs'][] = $this->title;


?>

<div class="col-lg-12 col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">
    <h3 class="panel-title text-center">Filtro de Aportes y Retenciones</h3>
  </div>
    <center>
<!-- Inicio del Panel-->

    <div class="panel-body center-block">
	<div class="col-lg-12 col-md-12">

        <div class="col-lg-3 col-md-3">
        <?php

        $form = ActiveForm::begin();
        /* Forma con Select2 de kartik*/
            echo $form->field($model, 'anho')->widget(Select2::classname(), [
            'data' => ArrayHelper::map([['id' => '2018', 'nombre' => '2018']], 'id', 'nombre'),
            'language' => 'es',
            'options' => ['placeholder' => 'Seleccione el Año'],
            'pluginOptions' => [
            'allowClear' => true
            ],
        ]);
        ?>
        </div>
        <div class="col-lg-3 col-md-3">
        <?php

        /* Forma con Select2 de kartik*/
            echo $form->field($model, 'mes')->widget(Select2::classname(), [
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
                ['id' => '12', 'nombre' => 'Diciembre']], 'id', 'nombre'),
            'language' => 'es',
            'options' => ['placeholder' => 'Seleccione el Mes'],
            'pluginOptions' => [
            'allowClear' => true
            ],
        ]);

        ?>
        </div>
        <div class="col-lg-3 col-md-3">
            <?php
            /* Forma con Select2 de kartik*/
                echo $form->field($model, 'tipoempleado')->widget(Select2::classname(), [
                'data' => ArrayHelper::map([
                    ['id' => '1', 'nombre' => 'Empleado'],
                    ['id' => '2', 'nombre' => 'Obrero'],
                    ['id' => '3', 'nombre' => 'Todos']], 'id', 'nombre'),
                'language' => 'es',
                'options' => ['placeholder' => 'Seleccione el Tipo de Trabajador'],
                'pluginOptions' => [
                'allowClear' => true
                ],
            ]);
            ?>
        </div>


  <div class="col-lg-3 col-md-3" >
<br>
                <?= Html::submitButton('Generar Parte', ['class' => 'btn btn-primary']); ?>

<?php
if ($vistaimprimir):
echo Html::a('Imprimir',['/snohsalida/imprimir','ano' => $model->anho,'mes' => $model->mes,], ['class'=>'btn btn-primary']);
endif
?>

    </div>

        <?php ActiveForm::end(); ?>



</div>

    </center>
<!-- Fin del Panel -->

</div>

<div class="snohsalida-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showPageSummary' => true,
        'tableOptions' => ['class' => 'text-center',],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            //'codemp',
            //'codnom',
            //'codper',
            //'anocur',
            //'codperi',
            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;'],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;'],
             'attribute'=>'codconc',
             'hAlign'=>'center',
             'vAlign'=>'middle',
            ],
            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;'],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;'],
             'attribute'=>'valsal',
             'hAlign'=>'right',
             'vAlign'=>'middle',
             'format'=>'currency',
             'pageSummary'=>true,
             'pageSummaryFunc'=>GridView::F_SUM,
            ],
            //'tipsal',
            //'monacusal',
            //'salsal',
            //'priquisal',
            //'segquisal',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
