<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MemosgestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Memosgestions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="memosgestion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Memosgestion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'dirorigen',
            'unidadorigen',
            'trabajadororigen',
            'estatus1origen',
            // 'estatus2origen',
            // 'estatus3origen',
            // 'dirfinal',
            // 'unidadfinal',
            // 'trabajadorfinal',
            // 'estatus1final',
            // 'estatus2final',
            // 'estatus3final',
            // 'fechamemo',
            // 'asunto',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
