<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LlamadaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Llamadas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="llamada-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Llamada', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'estatusllamada_id',
            'fechallamada',
            'observacion',
            'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',
            // 'solicitud_id',
            // 'numsolicitud_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
