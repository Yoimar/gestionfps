<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Requerimientos */

$this->title = 'Create Requerimientos';
$this->params['breadcrumbs'][] = ['label' => 'Requerimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="requerimientos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
