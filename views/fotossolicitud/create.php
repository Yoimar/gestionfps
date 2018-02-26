<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Fotossolicitud */

$this->title = 'Create Fotossolicitud';
$this->params['breadcrumbs'][] = ['label' => 'Fotossolicituds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fotossolicitud-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
