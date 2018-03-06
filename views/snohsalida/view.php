<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Snohsalida */

$this->title = $model->codemp;
$this->params['breadcrumbs'][] = ['label' => 'Snohsalidas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="snohsalida-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'codemp' => $model->codemp, 'codnom' => $model->codnom, 'codper' => $model->codper, 'anocur' => $model->anocur, 'codperi' => $model->codperi, 'codconc' => $model->codconc, 'tipsal' => $model->tipsal], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'codemp' => $model->codemp, 'codnom' => $model->codnom, 'codper' => $model->codper, 'anocur' => $model->anocur, 'codperi' => $model->codperi, 'codconc' => $model->codconc, 'tipsal' => $model->tipsal], [
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
            'codemp',
            'codnom',
            'codper',
            'anocur',
            'codperi',
            'codconc',
            'tipsal',
            'valsal',
            'monacusal',
            'salsal',
            'priquisal',
            'segquisal',
        ],
    ]) ?>

</div>
