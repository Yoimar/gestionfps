<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SepsolicitudSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sepsolicituds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sepsolicitud-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sepsolicitud', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'codemp',
            'numsol',
            'codtipsol',
            'codfuefin',
            'fecregsol',
            // 'estsol',
            // 'consol:ntext',
            // 'monto',
            // 'monbasinm',
            // 'montotcar',
            // 'tipo_destino',
            // 'cod_pro',
            // 'ced_bene',
            // 'coduniadm',
            // 'codestpro1',
            // 'codestpro2',
            // 'codestpro3',
            // 'codestpro4',
            // 'codestpro5',
            // 'estcla',
            // 'estapro',
            // 'fecaprsep',
            // 'codaprusu',
            // 'numpolcon',
            // 'fechaconta',
            // 'fechaanula',
            // 'nombenalt',
            // 'tipsepbie',
            // 'codusu',
            // 'numdocori',
            // 'conanusep:ntext',
            // 'feccieinv',
            // 'codcencos',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
