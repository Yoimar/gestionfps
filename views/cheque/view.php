<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cheque */

$this->title = $model->cheque;
$this->params['breadcrumbs'][] = ['label' => 'Cheques', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cheque-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->cheque], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->cheque], [
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
            'cheque',
            'id_presupuesto',
            'estatus_cheque',
            'date_cheque',
            'cheque_by',
            'date_enviofirma',
            'date_enviocaja',
            'date_reccaja',
            'date_entregado',
            'entregado_by',
            'retirado_personaid',
            'responsable_by',
            'imagenentrega_id',
            'date_anulado',
            'motivo_anulado',
            'anulado_by',
            'date_archivo',
            'archivo_by',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
        ],
    ]) ?>

</div>
