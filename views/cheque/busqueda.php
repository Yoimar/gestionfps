<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ChequeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Busqueda de Caso para cheques';
$this->params['breadcrumbs'][] = ['label' => 'Reiniciar Busqueda', 'url' => ['busqueda']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cheque-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_searchbusqueda', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cheque', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'cheque',
            'id_presupuesto',
            'estatus_cheque',
            'date_cheque',
            'cheque_by',
            'date_enviofirma',
            'date_enviocaja',
            'date_reccaja',
            'date_entregado',
            'entregado_by',
            'retirado_personaid',
            'responsable_by',
            'imagenentrega_id',
            'date_anulado',
            'motivo_anulado',
            'anulado_by',
            'date_archivo',
            'archivo_by',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'beneficiario',
            'solicitante',
            'estado_beneficiario',
            'tipodeayuda',
            'tratamiento',
            'especialidad',
            'necesidad',
            'empresainstitucion',
            'recepcioninicial',
            'recepcionactual',
            'telefono',
            'orpa',
            'num_solicitud',
            'cibeneficiario',
            'cisolicitante',
            'anocheque',
            'mescheque',
            'monto',
            [
            'attribute' => 'rif',
            'value' => 'rif',
            'format' => 'text',
            'vAlign'=>'middle',
            'hAlign'=>'center',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
