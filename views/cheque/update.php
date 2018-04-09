<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cheque */

$this->title = 'Update Cheque: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Cheques', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cheque, 'url' => ['view', 'id' => $model->cheque]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cheque-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
