<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Fotossolicitud */

$this->title = 'Update Fotossolicitud: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Fotossolicituds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fotossolicitud-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
