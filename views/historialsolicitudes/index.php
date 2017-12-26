<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HistorialsolicitudesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Historialsolicitudes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historialsolicitudes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Historialsolicitudes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'solicitud_id',
            'estatus3_id',
            'created_at',
            'created_by',
            // 'updated_at',
            // 'updated_by',
            // 'gestion_id',
            // 'estatus2_id',
            // 'estatus1_id',
            // 'memogestion_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
