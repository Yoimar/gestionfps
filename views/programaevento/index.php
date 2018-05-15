<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\select2\Select2;
use app\models\Origen;
use app\models\Trabajador;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProgramaeventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Actividad Presidencial - Programa - Eventos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="programaevento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Act. Presidencial - Programa - Evento', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'origenid',
            [
            'attribute' => 'origenid',
            'value' => 'origen.nombre',
            'format' => 'text',
            'filter' => Select2::widget([
                        'model' => $searchModel,
                        'attribute' => 'origenid',
                        'data' => ArrayHelper::map(Origen::find()->orderBy('nombre')->all(), 'id', 'nombre'),
                        'options' =>
                            ['placeholder' => 'Seleccione Origen'],
                        'pluginOptions' => [ 'allowClear' => true ],
                ]),
            ],
            //'nprograma',
            [
                'attribute' => 'dateprograma',
                'format' => ['date', 'php:d-m-Y'],
                'filter' => DateControl::widget([
                    'model' => $searchModel,
                    'attribute' => 'dateprograma',
                    'name' => 'kartik-date-2',
                    'value' => 'dateprograma',
                    'asyncRequest' => false,
                    'type' => DateControl::FORMAT_DATE,
                    'options' => ['layout' => '{input}']
                    ]),
                    'contentOptions' => ['style' => 'width: 20%;']
            ],
            //'trabajadoracargo_id',
            [
            'attribute' => 'trabajadoracargo_id',
            'value' => 'trabajador.Trabajadorfps',
            'format' => 'text',
            'filter' => Select2::widget([
                        'model' => $searchModel,
                        'attribute' => 'trabajadoracargo_id',
                        'data' => ArrayHelper::map(Trabajador::find()->asArray()->all(),'id', function($model, $defaultValue) {
                        return $model['dimprofesion'].' '.$model['primernombre'].' '.$model['primerapellido'];}),
                        'options' =>
                            ['placeholder' => 'Seleccione el Trabajador'],
                        'pluginOptions' => [ 'allowClear' => true ],
                ]),
            ],
            // 'referencia_id',
            // 'parroquia_id',
            'descripcion',
            // 'fecharecibido',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

            [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{update} {delete} {view} {gestionactividad}',
            'buttons' => [
                'gestionactividad' => function($url, $model){

                                    return Html::a('<span class="glyphicon glyphicon-search"></span>',
                                        yii\helpers\Url::to(['//site/tablaactividad', 'actividad' => $model->id, ]),
                                        [
                                            'title' => 'Ver Gestion Actividad',
                                        ]
                                        );
                                    }
            ],
            ],
        ],
    ]); ?>

    <?php
    /* *** Prueba para imprimir desde un model Search *** */

    /*
    $models = $dataProvider->getModels();

    foreach ($models as $value) {
        echo "<hr>";
        echo $value->descripcion;
        echo "<br>";
    }
    */
    ?>
</div>
