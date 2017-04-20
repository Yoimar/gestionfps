<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use app\models\Departamentos;
use yii\helpers\ArrayHelper;
use yii\grid\DataColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios del Sasyc';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'email:email',
            //'password',
            'nombre',
            //'activated:boolean',
            [
             'attribute' => 'activated',
             'label'=>'Activo',
             'format'=>'boolean',
             'value' => function($model, $key, $index, $column) { return $model->activated == 0 ? 'No' : 'Sí';},
             'filter' => Select2::widget([
                        'model' => $searchModel,
                        'attribute' => 'activated',
                        'data' => [0 => 'No', 1=>'Si'],
                        'options' => 
                            ['placeholder' => '¿Activo?'],
                        'pluginOptions' => [ 'allowClear' => true ],
                ]),
            ],
            
            // 'activation_code',
            // 'activated_at',
            // 'last_login',
            // 'persist_code',
            // 'reset_password_code',
            // 'version',
            // 'created_at',
            // 'updated_at',
            //'departamento_id',
            [
            'attribute' => 'departamento_id',
            'value' => 'departamentos.nombre',
            'format' => 'text',
            'filter' => Select2::widget([
                        'model' => $searchModel,
                        'attribute' => 'departamento_id',
                        'data' => ArrayHelper::map(Departamentos::find()->orderBy('nombre')->all(), 'id', 'nombre'),
                        'options' => 
                            ['placeholder' => 'Seleccione el Departamento'],
                        'pluginOptions' => [ 'allowClear' => true ],
                ]),
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
