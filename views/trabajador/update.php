<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Trabajador */

$this->title = "Actualizar Trabajador: $model->dimprofesion $model->primernombre $model->primerapellido";
$this->params['breadcrumbs'][] = ['label' => 'Trabajadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "$model->dimprofesion $model->primernombre $model->primerapellido", 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="trabajador-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
