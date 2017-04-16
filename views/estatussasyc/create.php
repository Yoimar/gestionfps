<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Estatussasyc */

$this->title = 'Create Estatussasyc';
$this->params['breadcrumbs'][] = ['label' => 'Estatussasycs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estatussasyc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
