<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use app\models\User;
use app\models\Users;
use app\models\Trabajador;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TrabajadorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trabajadores de la FPS';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trabajador-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Registrar Trabajador', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'user_id',
            
            [
            'attribute' => 'user_id',
            'label' => 'Usuario Gestion FPS',
            'value' => 'user.username',
            'format' => 'text',
            'filter' => Select2::widget([
                        'model' => $searchModel,
                        'attribute' => 'user_id',
                        'data' => ArrayHelper::map(User::find()->orderBy('username')->all(), 'id', 'username'),
                        'options' => 
                            ['placeholder' => 'Usuario Gestion FPS'],
                        'pluginOptions' => [ 'allowClear' => true ],
                ]),
            ],
            
            
            //'users_id',
            
            [
            'attribute' => 'users_id',
            'label' => 'Usuario del SASYC',
            'value' => 'users.nombre',
            'format' => 'text',
            'filter' => Select2::widget([
                        'model' => $searchModel,
                        'attribute' => 'users_id',
                        'data' => ArrayHelper::map(Users::find()->where(['activated' => 'TRUE'])->orderBy('nombre')->all(), 'id', 'nombre'),
                        'options' => 
                            ['placeholder' => 'Usuario del SASYC'],
                        'pluginOptions' => [ 'allowClear' => true ],
                ]),
            ],
            [
                'attribute' => 'Trabajadorfps',
                'label' => 'Trabajador FPS',
                'value' => 'Trabajadorfps',
                'format' => 'text',
                'filter' => Select2::widget([
                        'model' => $searchModel,
                        'attribute' => 'trabajadorfps',
                        'data' => ArrayHelper::map(Trabajador::find()->asArray()->all(),'id', function($model, $defaultValue) {
                        return $model['dimprofesion'].' '.$model['primernombre'].' '.$model['primerapellido'];}),
                        'options' => 
                            ['placeholder' => 'Trabajador FPS'],
                        'pluginOptions' => [ 'allowClear' => true ],
                ]),
            ],
            //'dimprofesion',
            //'primernombre',
            //'segundonombre',
            //'primerapellido',
            // 'segundoapellido',
            // 'ci',
            // 'telfextension',
            // 'telfpersonal',
            // 'telfpersonal2',
            // 'telfcasa',
           
            // 'profesion',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
