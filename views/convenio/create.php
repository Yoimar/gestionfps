<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Convenio */

$this->title = 'Crear Convenio';
$this->params['breadcrumbs'][] = ['label' => 'Convenios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="convenio-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
