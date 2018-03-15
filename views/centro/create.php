<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Centro */

$this->title = 'Crear Centro';
$this->params['breadcrumbs'][] = ['label' => 'Centros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="centro-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
