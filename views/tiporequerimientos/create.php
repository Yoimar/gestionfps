<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tiporequerimientos */

$this->title = 'Create Tiporequerimientos';
$this->params['breadcrumbs'][] = ['label' => 'Tiporequerimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tiporequerimientos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
