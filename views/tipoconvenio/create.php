<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tipoconvenio */

$this->title = 'Crear Tipo de Convenio';
$this->params['breadcrumbs'][] = ['label' => 'Tipo de Convenios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipoconvenio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
