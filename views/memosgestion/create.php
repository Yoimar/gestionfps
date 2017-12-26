<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Memosgestion */

$this->title = 'Create Memosgestion';
$this->params['breadcrumbs'][] = ['label' => 'Memosgestions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="memosgestion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
