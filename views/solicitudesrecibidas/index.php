<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SolicitudesRecibidasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Solicitudes Recibidas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitudes-recibidas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Solicitudes Recibidas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'programaevento_id',
            'area_id',
            'cantidad',
            'created_by',
            // 'updated_at',
            // 'created_at',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
