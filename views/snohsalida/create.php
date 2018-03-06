<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Snohsalida */

$this->title = 'Create Snohsalida';
$this->params['breadcrumbs'][] = ['label' => 'Snohsalidas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="snohsalida-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
