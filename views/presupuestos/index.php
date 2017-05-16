<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PresupuestosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Presupuestos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presupuestos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Presupuestos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'solicitud_id',
            'requerimiento_id',
            'proceso_id',
            'documento_id',
            // 'moneda',
            // 'beneficiario_id',
            // 'cantidad',
            // 'monto',
            // 'montoapr',
            // 'estatus_doc',
            // 'cheque',
            // 'version',
            // 'created_at',
            // 'updated_at',
            // 'numop',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
