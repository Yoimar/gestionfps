<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Autoridad */

$this->title = 'Create Autoridad';
$this->params['breadcrumbs'][] = ['label' => 'Autoridads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="autoridad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
