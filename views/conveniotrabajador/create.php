<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ConvenioTrabajador */

$this->title = 'Create Convenio Trabajador';
$this->params['breadcrumbs'][] = ['label' => 'Convenio Trabajadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="convenio-trabajador-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
