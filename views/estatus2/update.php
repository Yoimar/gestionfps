<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Estatus2 */

$this->title = 'Actualizar Estatus Nivel 2 ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Estatus Nivel 2', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="estatus2-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
