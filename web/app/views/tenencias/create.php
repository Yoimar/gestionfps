<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tenencias */

$this->title = 'Create Tenencias';
$this->params['breadcrumbs'][] = ['label' => 'Tenencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tenencias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
