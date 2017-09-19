<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Instruccion */

$this->title = 'Crear Instrucción';
$this->params['breadcrumbs'][] = ['label' => 'Instruccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instruccion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
