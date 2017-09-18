<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RpcbeneficiarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rpcbeneficiarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rpcbeneficiario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rpcbeneficiario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'codemp',
            'ced_bene',
            'codpai',
            'codest',
            'codmun',
            // 'codpar',
            // 'codtipcta',
            // 'rifben',
            // 'nombene',
            // 'apebene',
            // 'dirbene:ntext',
            // 'telbene',
            // 'celbene',
            // 'email:email',
            // 'sc_cuenta',
            // 'codbansig',
            // 'codban',
            // 'ctaban',
            // 'foto:ntext',
            // 'fecregben',
            // 'nacben',
            // 'numpasben',
            // 'tipconben',
            // 'tipcuebanben',
            // 'sc_cuentarecdoc',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
