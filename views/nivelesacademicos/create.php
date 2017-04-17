<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\NivelesAcademicos */

$this->title = 'Create Niveles Academicos';
$this->params['breadcrumbs'][] = ['label' => 'Niveles Academicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="niveles-academicos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
