<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Centrotipo */

$this->title = 'Crear Tipo de Centro';
$this->params['breadcrumbs'][] = ['label' => 'Tipo de Centro', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="centrotipo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
