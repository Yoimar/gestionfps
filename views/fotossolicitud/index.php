<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\alert\AlertBlock;
use kartik\growl\Growl;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FotossolicitudSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Carga de Fotos de las Solicitudes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fotossolicitud-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Fotossolicitud', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'solicitud_id',
            'descripcion',
            'foto',
            'ind_reporte:boolean',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<center>
<div class="col-lg-12 col-md-12">

     <div>
         <?php
            echo AlertBlock::widget([
                    'useSessionFlash' => true,
                    'type' => AlertBlock::TYPE_GROWL,
                    'delay' => 0,
                    'alertSettings' => [
                        'success' => ['type' => Growl::TYPE_SUCCESS, 'pluginOptions' => ['placement' => ['from' => 'top', 'align' => 'center']]],
                        'danger' => ['type' => Growl::TYPE_DANGER, 'pluginOptions' => ['placement' => ['from' => 'top', 'align' => 'center']]],
                        'warning' => ['type' => Growl::TYPE_WARNING, 'pluginOptions' => ['placement' => ['from' => 'top', 'align' => 'center']]],
                        'info' => ['type' => Growl::TYPE_INFO, 'pluginOptions' => ['placement' => ['from' => 'top', 'align' => 'center']]]
                        ],
                     ])
         ?>
        </div>
</div>
</center>
