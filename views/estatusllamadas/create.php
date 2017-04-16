<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EstatusLlamadas */

$this->title = 'Create Estatus Llamadas';
$this->params['breadcrumbs'][] = ['label' => 'Estatus Llamadas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estatus-llamadas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
