<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Memosgestion */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Memosgestions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="memosgestion-view">

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
            'dirorigen',
            'unidadorigen',
            'trabajadororigen',
            'estatus1origen',
            'estatus2origen',
            'estatus3origen',
            'dirfinal',
            'unidadfinal',
            'trabajadorfinal',
            'estatus1final',
            'estatus2final',
            'estatus3final',
            'fechamemo',
            'asunto',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
        ],
    ]) ?>

</div>
