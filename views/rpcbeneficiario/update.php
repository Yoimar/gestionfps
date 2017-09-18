<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rpcbeneficiario */

$this->title = 'Update Rpcbeneficiario: ' . $model->codemp;
$this->params['breadcrumbs'][] = ['label' => 'Rpcbeneficiarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codemp, 'url' => ['view', 'codemp' => $model->codemp, 'ced_bene' => $model->ced_bene]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rpcbeneficiario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
