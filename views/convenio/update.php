<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Convenio */

$this->title = 'Actualizar Convenio: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Convenios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="convenio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
