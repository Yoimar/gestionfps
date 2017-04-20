<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rangosmilitares */

$this->title = 'Update Rangosmilitares: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rangosmilitares', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rangosmilitares-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
