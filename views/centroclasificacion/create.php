<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Centroclasificacion */

$this->title = 'Crear Clasificacion del Centro';
$this->params['breadcrumbs'][] = ['label' => 'Clasificacion del Centro', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="centroclasificacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
