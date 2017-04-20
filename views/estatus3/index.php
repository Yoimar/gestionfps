<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use app\models\Estatus2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Estatus3Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estatus3s';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estatus3-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Estatus3', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nombre',
            'dim',
            
            [
            'attribute' => 'estatus2_id',
            'value' => 'estatus2.nombre',
            'format' => 'text',
            'filter' => Select2::widget([
                        'model' => $searchModel,
                        'attribute' => 'estatus2_id',
                        'data' => ArrayHelper::map(Estatus2::find()->orderBy('nombre')->all(), 'id', 'nombre'),
                        'options' => 
                            ['placeholder' => 'Seleccione el Estatus 2'],
                        'pluginOptions' => [ 'allowClear' => true ],
                ]),
            ],
            
            //'estatus2_id',
            //'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
