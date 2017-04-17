<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoNacionalidades */

$this->title = 'Update Tipo Nacionalidades: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Nacionalidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipo-nacionalidades-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
