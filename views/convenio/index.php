<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use app\models\Tipoconvenio;
use yii\helpers\ArrayHelper;
use app\models\Estados;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ConvenioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Convenios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="convenio-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nombre',
            'dimnombre',
            //'tipoconvenio_id',
            [
            'attribute' => 'tipoconvenio_id',
            'value' => 'tipoconvenio.nombre',
            'format' => 'text',
            'filter' => Select2::widget([
                        'model' => $searchModel,
                        'attribute' => 'tipoconvenio_id',
                        'data' => ArrayHelper::map(Tipoconvenio::find()->orderBy('nombre')->all(), 'id', 'nombre'),
                        'options' =>
                            ['placeholder' => 'Seleccione el Tipo de Convenio'],
                        'pluginOptions' => [ 'allowClear' => true ],
                ]),
            ],
            [
            'attribute' => 'estado_id',
            'value' => 'estados.nombre',
            'format' => 'text',
            'filter' => Select2::widget([
                        'model' => $searchModel,
                        'attribute' => 'estado_id',
                        'data' => ArrayHelper::map(Estados::find()->orderBy('nombre')->all(), 'id', 'nombre'),
                        'options' =>
                            ['placeholder' => 'Seleccione el Estado de Convenio'],
                        'pluginOptions' => [ 'allowClear' => true ],
                ]),
            ],
            //'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
