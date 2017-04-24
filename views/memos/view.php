<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Memos */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Memos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="memos-view">

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
            'fecha',
            'numero',
            'asunto',
            'origen_id',
            'destino_id',
            'usuario_id',
            'version',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>