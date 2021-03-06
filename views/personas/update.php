<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Personas */

$this->title = 'Actualizar: ' . $model->nombre . ' ' . $model->apellido ;
$this->params['breadcrumbs'][] = ['label' => 'Personas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="personas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
