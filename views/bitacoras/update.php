<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bitacoras */

$this->title = 'Update Bitacoras: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bitacoras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bitacoras-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
