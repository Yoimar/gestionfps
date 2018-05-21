<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Gestion */

$this->title = 'Actualizar Gestión: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Gestiones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gestion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formajax', [
        'model' => $model,
    ]) ?>

</div>
