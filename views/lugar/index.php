<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use app\models\Centroclasificacion;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LugarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lugares y Hospitales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lugar-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<p>
        <?= Html::a('Crear Lugar', ['create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Crear Lugar con Ubicación actual', ['creargeo'], ['class' => 'btn btn-primary']) ?>
</p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nombre',
            //'centro_clasificacion_id',
            'lat',
            'lng',
            [
            'attribute' => 'centro_clasificacion_id',
            'value' => 'centroclasificacion.nombre',
            'format' => 'text',
            'filter' => Select2::widget([
                        'model' => $searchModel,
                        'attribute' => 'centro_clasificacion_id',
                        'data' => ArrayHelper::map(Centroclasificacion::find()->orderBy('nombre')->all(), 'id', 'nombre'),
                        'options' =>
                            ['placeholder' => 'Seleccione el Cenetro de Clasificación'],
                        'pluginOptions' => [ 'allowClear' => true ],
                ]),
            ],
            //'nombre_slug',
            //'parroquia_id',
            //'direccion',
            //'telefono1',
            //'telefono2',
            //'telefono3',
            //'notas:ntext',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
