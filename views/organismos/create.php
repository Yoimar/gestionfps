<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Organismos */

$this->title = 'Create Organismos';
$this->params['breadcrumbs'][] = ['label' => 'Organismos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organismos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
