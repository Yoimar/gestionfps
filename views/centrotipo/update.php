<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Centrotipo */

$this->title = 'Actualizar Tipo de Centro: '.$model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Tipo de Centro', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="centrotipo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
