<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Estatus2 */

$this->title = 'Crear Estatus Nivel 2';
$this->params['breadcrumbs'][] = ['label' => 'Estatus Nivel 2', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estatus2-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
