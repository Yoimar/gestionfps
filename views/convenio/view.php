<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Convenio */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Convenios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="convenio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre',
            'dimnombre',
            'tipoconvenio_id',
            'estado_id',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
        ],
    ]) ?>

</div>
