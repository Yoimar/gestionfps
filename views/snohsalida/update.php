<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Snohsalida */

$this->title = 'Update Snohsalida: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Snohsalidas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codemp, 'url' => ['view', 'codemp' => $model->codemp, 'codnom' => $model->codnom, 'codper' => $model->codper, 'anocur' => $model->anocur, 'codperi' => $model->codperi, 'codconc' => $model->codconc, 'tipsal' => $model->tipsal]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="snohsalida-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
