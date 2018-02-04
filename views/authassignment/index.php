<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use app\models\User;
use yii\helpers\ArrayHelper;
use app\models\Authitem;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthassignmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Perfiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authassignment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Perfil', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'item_name',
             [
            'attribute' => 'item_name',
            'label' => 'Perfil de usuario',
            'value' => 'item_name',
            'format' => 'text',
            'filter' => Select2::widget([
                        'model' => $searchModel,
                        'attribute' => 'item_name',
                        'data' => ArrayHelper::map(Authitem::find()->where(['type' => 1])->orderBy('name')->all(), 'name', 'name'),
                        'options' => 
                            ['placeholder' => 'Usuario Gestion FPS'],
                        'pluginOptions' => [ 'allowClear' => true ],
                ]),
            ],
            //'user_id',
             [
            'attribute' => 'user_id',
            'label' => 'Usuario Gestion FPS',
            'value' => 'usuariogestion.username',
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
            //'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
