<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Personas */

$this->title = $model->nombre . ' ' . $model->apellido  ;
?>
<div class="personas-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_formajax', [
        'model' => $model,
    ]) ?>

</div>
