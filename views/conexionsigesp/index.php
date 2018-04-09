<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ConexionsigespSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Conexionsigesps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conexionsigesp-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Conexionsigesp', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_presupuesto',
            'rif',
            'req',
            'codestpre',
            //'cuenta',
            //'date',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            //'estatus_sigesp',
            //'date_compromiso',
            //'compromiso_by',
            //'numrecdoc',
            //'date_regdocorpa',
            //'regdocorpa_by',
            //'date_aprdocorpa',
            //'aprdocorpa_by',
            //'orpa',
            //'date_orpa',
            //'orpa_by',
            //'date_aprorpa',
            //'aprorpa_by',
            //'date_causado',
            //'causado_by',
            //'date_progpago',
            //'progpago_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
