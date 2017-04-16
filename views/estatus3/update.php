<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Estatus3 */

$this->title = 'Update Estatus3: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Estatus3s', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estatus3-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
