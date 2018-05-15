<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Programaevento */

$this->title = $model->descripcion;
$this->params['breadcrumbs'][] = ['label' => 'Lista de Actividades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="programaevento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de que desea eliminar esta Actividad?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="row">
        <div class="col-lg-6 col-md-6">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'origen.nombre',
            'nprograma',
            'fechaprograma:datetime',
            'trabajador.Trabajadorfps',
            'referencia.nombre',
            'parroquia.estado.nombre',
            //'descripcion',
            //'fecharecibido',
            //'created_at:datetime',
            //[
            //    'label' => 'Creado Por:',
            //    'attribute' => "creadoprogramapor.Trabajadorfps",
            //],
            //'updated_at:datetime',
            //[
            //    'label' => 'Actualizado Por:',
            //    'attribute' => "actualizadoprogramapor.Trabajadorfps",
            //],
        ],
    ]) ?>

        </div>
        <div class="col-lg-6 col-md-6">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'origen.nombre',
            //'nprograma',
            //'fechaprograma',
            //'trabajador.Trabajadorfps',
            //'referencia.nombre',
            //'parroquia.estado.nombre',
            //'descripcion',
            'fecharecibido:datetime',
            'created_at:datetime',
            [
                'label' => 'Creado Por:',
                'attribute' => "creadoprogramapor.Trabajadorfps",
            ],
            'updated_at:datetime',
            [
                'label' => 'Actualizado Por:',
                'attribute' => "actualizadoprogramapor.Trabajadorfps",
            ],
        ],
    ]) ?>
        </div>
    </div>

</div>
