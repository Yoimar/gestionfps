<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Lugar */

$this->title = 'Create Lugar';
$this->params['breadcrumbs'][] = ['label' => 'Lugars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lugar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
