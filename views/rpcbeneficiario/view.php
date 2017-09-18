<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Rpcbeneficiario */

$this->title = $model->codemp;
$this->params['breadcrumbs'][] = ['label' => 'Rpcbeneficiarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rpcbeneficiario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'codemp' => $model->codemp, 'ced_bene' => $model->ced_bene], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'codemp' => $model->codemp, 'ced_bene' => $model->ced_bene], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'codemp',
            'ced_bene',
            'codpai',
            'codest',
            'codmun',
            'codpar',
            'codtipcta',
            'rifben',
            'nombene',
            'apebene',
            'dirbene:ntext',
            'telbene',
            'celbene',
            'email:email',
            'sc_cuenta',
            'codbansig',
            'codban',
            'ctaban',
            'foto:ntext',
            'fecregben',
            'nacben',
            'numpasben',
            'tipconben',
            'tipcuebanben',
            'sc_cuentarecdoc',
        ],
    ]) ?>

</div>
