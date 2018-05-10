<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Trabajador */

$this->title = "Trabajador: $model->dimprofesion $model->primernombre $model->primerapellido";
$this->params['breadcrumbs'][] = ['label' => 'Trabajadores Registrados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trabajador-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Está seguro de que desea eliminar este trabajador?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="row">
        <div class="col-md-6 col-lg-6">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ci',
            'primernombre',
            'segundonombre',
            'primerapellido',
            'segundoapellido',
            'dimprofesion',
            'profesion',
        ],
    ]) ?>
</div>
<div class="col-md-6 col-lg-6">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user.username',
            'users.nombre',
            'telfextension',
            'telfpersonal',
            'telfpersonal2',
            'telfcasa',
        ],
    ]) ?>
</div>
</div>

</div>
