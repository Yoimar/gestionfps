<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Programaevento;
use app\models\Solicitudes;
use app\models\Convenio;
use app\models\Estatus3;
use app\models\Tipodecontacto;
use app\models\Trabajador;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gestiones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gestion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Gestión', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'programaevento_id',
            [
            'attribute' => 'programaevento_id',
            'value' => 'programaevento.descripcion',
            'format' => 'text',
            'filter' => Select2::widget([
                        'model' => $searchModel,
                        'attribute' => 'programaevento_id',
                        'data' => ArrayHelper::map(Programaevento::find()->orderBy('created_at DESC')->all(), 'id', 'descripcion'),
                        'options' => 
                            ['placeholder' => 'Seleccione Programa Evento'],
                        'pluginOptions' => [ 'allowClear' => true ],
                ]),
            ],
            // 'solicitud_id',
            [
            'attribute' => 'solicitud_id',
            'value' => 'solicitud.num_solicitud',
            'format' => 'text',
            ],
            //'convenio_id',
            [
            'attribute' => 'convenio_id',
            'value' => 'convenio.nombre',
            'format' => 'text',
            'filter' => Select2::widget([
                        'model' => $searchModel,
                        'attribute' => 'convenio_id',
                        'data' => ArrayHelper::map(Convenio::find()->orderBy('nombre')->all(), 'id', 'nombre'),
                        'options' => 
                            ['placeholder' => 'Seleccione Convenio'],
                        'pluginOptions' => [ 'allowClear' => true ],
                ]),
            ],
            //'estatus3_id',
            [
            'attribute' => 'estatus3_id',
            'value' => 'estatus3.nombre',
            'format' => 'text',
            'filter' => Select2::widget([
                        'model' => $searchModel,
                        'attribute' => 'estatus3_id',
                        'data' => ArrayHelper::map(Estatus3::find()->orderBy('nombre')->all(), 'id', 'nombre'),
                        'options' => 
                            ['placeholder' => 'Seleccione Estatus 3'],
                        'pluginOptions' => [ 'allowClear' => true ],
                ]),
            ],
            //'tipodecontacto_id',
            [
            'attribute' => 'tipodecontacto_id',
            'value' => 'tipodecontacto.nombre',
            'format' => 'text',
            'filter' => Select2::widget([
                        'model' => $searchModel,
                        'attribute' => 'tipodecontacto_id',
                        'data' => ArrayHelper::map(Tipodecontacto::find()->orderBy('nombre')->all(), 'id', 'nombre'),
                        'options' => 
                            ['placeholder' => 'Seleccione el Tipo de Contacto'],
                        'pluginOptions' => [ 'allowClear' => true ],
                ]),
            ],
            // 'militar_solicitante:boolean',
            // 'rango_solicitante_id',
            // 'militar_beneficiario:boolean',
            // 'rango_beneficiario_id',
            // 'afrodescendiente',
            // 'indigena',
            // 'sexodiversidad',
            // 'trabajador_id',
            [
            'attribute' => 'trabajador_id',
            'value' => 'trabajador.Trabajadorfps',
            'format' => 'text',
            'filter' => Select2::widget([
                        'model' => $searchModel,
                        'attribute' => 'trabajador_id',
                        'data' => ArrayHelper::map(Trabajador::find()->asArray()->all(),'id', function($model, $defaultValue) {
                        return $model['dimprofesion'].' '.$model['primernombre'].' '.$model['primerapellido'];}),
                        'options' => 
                            ['placeholder' => 'Seleccione el Trabajador'],
                        'pluginOptions' => [ 'allowClear' => true ],
                ]),
            ],
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',
            // 'tipodecontacto_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
