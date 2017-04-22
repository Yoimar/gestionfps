<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Solicitudes */

$this->title = $model->num_solicitud;
$this->params['breadcrumbs'][] = ['label' => 'Solicitudes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
<div class="solicitudes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'table table-bordered table-hover', 'style'=>'margin-left: auto; margin-right: auto;'],
        'attributes' => [
            'id',
            'descripcion',
            'persona_beneficiario_id',
            'persona_solicitante_id',
            'area_id',
            'referente_id',
            'recepcion_id',
            'organismo_id',
            'ind_mismo_benef:boolean',
            'ind_inmediata:boolean',
            'ind_beneficiario_menor:boolean',
            'actividad',
            'referencia',
            'referencia_externa',
            'accion_tomada',
            'necesidad',
            'tipo_proc',
            'num_proc',
            'facturas',
            'observaciones',
            'moneda',
            'estatus',
            'usuario_asignacion_id',
            'usuario_autorizacion_id',
            'fecha_asignacion',
            'fecha_aceptacion',
            'fecha_aprobacion',
            'fecha_cierre',
            'tipo_vivienda_id',
            'tenencia_id',
            'departamento_id',
            'memo_id',
            'informe_social:ntext',
            'total_ingresos',
            //'beneficiario_json:ntext',
            //'solicitante_json:ntext',
            'num_solicitud',
            'version',
            'created_at',
            'updated_at',
        ],
    ]) ?>
</div>
</div>
