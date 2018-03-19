<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Lugar */

$this->title = 'Reporte de Lugares, Tipo, Clasificacion, y Ubicación';
$this->params['breadcrumbs'][] = ['label' => 'Lugares', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lugar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formreportes', [
        'model' => $model,
    ]) ?>

</div>
