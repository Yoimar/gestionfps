<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Llamada */

$this->title = 'Create Llamada';
$this->params['breadcrumbs'][] = ['label' => 'Llamadas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="llamada-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
