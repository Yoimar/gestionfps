<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Memosgestion */

$this->title = 'Update Memosgestion: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Memosgestions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="memosgestion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
