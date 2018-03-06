<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SnohsalidaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Snohsalidas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="snohsalida-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Snohsalida', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'codemp',
            'codnom',
            'codper',
            'anocur',
            'codperi',
            //'codconc',
            //'tipsal',
            //'valsal',
            //'monacusal',
            //'salsal',
            //'priquisal',
            //'segquisal',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
