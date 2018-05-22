<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Gestion */

$this->title = 'Actualizar Gestión: ' . $model->solicitud->num_solicitud;
?>
<div class="gestion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formajax', [
        'model' => $model,
    ]) ?>

</div>
