<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstatussasycSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estatussasycs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estatussasyc-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Estatussasyc', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'estatus',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
