<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Programaevento */

$this->title = 'Actualizar Actividad: ' . $model->descripcion;
$this->params['breadcrumbs'][] = ['label' => 'Lista de Actividades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Detalle de la Actividad', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="programaevento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
