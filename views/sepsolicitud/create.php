<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Sepsolicitud */

$this->title = 'Create Sepsolicitud';
$this->params['breadcrumbs'][] = ['label' => 'Sepsolicituds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sepsolicitud-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
