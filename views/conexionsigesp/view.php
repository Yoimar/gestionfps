<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Conexionsigesp */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Conexionsigesps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conexionsigesp-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id_presupuesto',
            'rif',
            'req',
            'codestpre',
            'cuenta',
            'date',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'estatus_sigesp',
            'date_compromiso',
            'compromiso_by',
            'numrecdoc',
            'date_regdocorpa',
            'regdocorpa_by',
            'date_aprdocorpa',
            'aprdocorpa_by',
            'orpa',
            'date_orpa',
            'orpa_by',
            'date_aprorpa',
            'aprorpa_by',
            'date_causado',
            'causado_by',
            'date_progpago',
            'progpago_by',
        ],
    ]) ?>

</div>
