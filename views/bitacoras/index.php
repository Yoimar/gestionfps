<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BitacorasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bitacoras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bitacoras-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bitacoras', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'solicitud_id',
            'fecha',
            'nota',
            'usuario_id',
            // 'ind_activo:boolean',
            // 'ind_alarma:boolean',
            // 'ind_atendida:boolean',
            // 'version',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
