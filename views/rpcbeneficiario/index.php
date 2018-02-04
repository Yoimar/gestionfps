<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RpcbeneficiarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Beneficiarios - Casa Comercial "SIGESP"';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rpcbeneficiario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Beneficiario Sigesp - Casa Comercial', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'codemp',
            'ced_bene',
            //'codpai',
            //'codest',
            //'codmun',
            // 'codpar',
            // 'codtipcta',
            // 'rifben',
            'nombene',
            'apebene',
            // 'dirbene',
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
