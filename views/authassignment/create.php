<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Authassignment */

$this->title = 'Create Authassignment';
$this->params['breadcrumbs'][] = ['label' => 'Authassignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authassignment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
