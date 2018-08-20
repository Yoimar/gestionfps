<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Codbancos */

$this->title = 'Update Codbancos: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Codbancos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codigo, 'url' => ['view', 'id' => $model->codigo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="codbancos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
