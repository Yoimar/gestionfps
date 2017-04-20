<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gestions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gestion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Gestion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'programaevento_id',
            'solicitud_id',
            'convenio_id',
            'estatus3_id',
            // 'militar_solicitante:boolean',
            // 'rango_solicitante_id',
            // 'militar_beneficiario:boolean',
            // 'rango_beneficiario_id',
            // 'afrodescendiente',
            // 'indigena',
            // 'sexodiversidad',
            // 'trabajador_id',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',
            // 'tipodecontacto_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
