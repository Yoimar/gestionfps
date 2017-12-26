<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Historialsolicitudes */

$this->title = 'Create Historialsolicitudes';
$this->params['breadcrumbs'][] = ['label' => 'Historialsolicitudes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historialsolicitudes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
