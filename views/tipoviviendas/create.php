<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoViviendas */

$this->title = 'Create Tipo Viviendas';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Viviendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-viviendas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
