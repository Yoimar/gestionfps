<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\select2\Select2;
use app\models\User;
use yii\helpers\ArrayHelper;
use app\models\Authitem;
use yii\widgets\Pjax;

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

    <?php Pjax::begin(['id' => 'permisos', 'timeout' => false, 'enablePushState' => false,]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id' => 'permisos',
        'pjax'               => true,
        'pjaxSettings'       => [
            'options' => [
                'enablePushState' => false,
            ]
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

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
            [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{resetpassword} {update} {view}',
            'buttons' => [
            'resetpassword' => function($url, $model){
                                return Html::a('<span class="glyphicon glyphicon-repeat"></span>',
                                    //yii\helpers\Url::to(['site/resetpassword', 'id' => $model->user_id, ]),
                                    $url,
                                    [
                                        'title' => 'Resetear Password',
                                        //'data-pjax' => 'w0',
                                        'data-toggle-active' => $model->user_id,

                                    ]
                                    );
                                },

            
                ],
            ],
           
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>

<?php
$this->registerJs("

/**
     * Active toggle
**/
    $(document).on('click', '[data-toggle-active]', function(e){

        e.preventDefault();

        var id = $(this).data('toggle-active');
        $.ajax({
            url: 'resetpassword?id='+id,
            type: 'POST',
            success: function(result) {
                
                if (result == 1)
                {
                    alert('Contraseña Cambiada exitoxamente la clave es 123456');
                    $.pjax.reload({container:'#permisos'});

                } else {
                    
                }
            }
        });

    });

    ");
?>

