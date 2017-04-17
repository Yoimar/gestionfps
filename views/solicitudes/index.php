<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SolicitudesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Solicitudes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitudes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Solicitudes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'descripcion',
            'persona_beneficiario_id',
            'persona_solicitante_id',
            'area_id',
            // 'referente_id',
            // 'recepcion_id',
            // 'organismo_id',
            // 'ind_mismo_benef:boolean',
            // 'ind_inmediata:boolean',
            // 'ind_beneficiario_menor:boolean',
            // 'actividad',
            // 'referencia',
            // 'referencia_externa',
            // 'accion_tomada',
            // 'necesidad',
            // 'tipo_proc',
            // 'num_proc',
            // 'facturas',
            // 'observaciones',
            // 'moneda',
            // 'estatus',
            // 'usuario_asignacion_id',
            // 'usuario_autorizacion_id',
            // 'fecha_asignacion',
            // 'fecha_aceptacion',
            // 'fecha_aprobacion',
            // 'fecha_cierre',
            // 'tipo_vivienda_id',
            // 'tenencia_id',
            // 'departamento_id',
            // 'memo_id',
            // 'informe_social:ntext',
            // 'total_ingresos',
            // 'beneficiario_json:ntext',
            // 'solicitante_json:ntext',
            // 'num_solicitud',
            // 'version',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
