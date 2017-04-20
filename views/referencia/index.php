<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use app\models\Autoridad;
use app\models\Cargo;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReferenciaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Referencia - (Autoridad + Cargo)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="referencia-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Referencia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
            'attribute' => 'autoridad_id',
            'value' => 'autoridad.nombredim',
            'format' => 'text',
            'filter' => Select2::widget([
                        'model' => $searchModel,
                        'attribute' => 'autoridad_id',
                        'data' => ArrayHelper::map(Autoridad::find()->orderBy('nombredim')->all(), 'id', 'nombredim'),
                        'options' => 
                            ['placeholder' => 'Seleccione el Nombre de la Autoridad'],
                        'pluginOptions' => [ 'allowClear' => true ],
                ]),
            ],
            [
            'attribute' => 'cargo_id',
            'value' => 'cargo.nombredim',
            'format' => 'text',
            'filter' => Select2::widget([
                        'model' => $searchModel,
                        'attribute' => 'cargo_id',
                        'data' => ArrayHelper::map(Cargo::find()->orderBy('nombredim')->all(), 'id', 'nombredim'),
                        'options' => 
                            ['placeholder' => 'Seleccione el Cargo'],
                        'pluginOptions' => [ 'allowClear' => true ],
                ]),
            ],
            //'created_at',
            //'created_by',
            // 'updated_by',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
