<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sepsolicitud */

$this->title = 'Update Sepsolicitud: ' . $model->codemp;
$this->params['breadcrumbs'][] = ['label' => 'Sepsolicituds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codemp, 'url' => ['view', 'codemp' => $model->codemp, 'numsol' => $model->numsol]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sepsolicitud-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
