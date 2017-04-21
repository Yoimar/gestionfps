<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Rangosmilitares */

$this->title = 'Registrar Rango Militar';
$this->params['breadcrumbs'][] = ['label' => 'Rangos Militares', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rangosmilitares-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
