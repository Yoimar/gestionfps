<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Estatus1;

/* @var $this yii\web\View */
/* @var $model app\models\Estatus2 */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Estatus Nivel 2', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estatus2-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Esta Seguro que desea Eliminar este Estatus de Nivel 2?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre',
            'dim',
            [
                'attribute' => 'estatus1_id',
                'value' => Estatus1::findOne($model->estatus1_id)->nombre,
            ],
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
        ],
    ]) ?>

</div>
