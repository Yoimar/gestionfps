<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProgramaeventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Programaeventos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="programaevento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Programaevento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'origenid',
            'nprograma',
            'fechaprograma',
            'trabajadoracargo_id',
            // 'referencia_id',
            // 'parroquia_id',
            // 'descripcion',
            // 'fecharecibido',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
