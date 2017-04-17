<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Programaevento */

$this->title = 'Create Programaevento';
$this->params['breadcrumbs'][] = ['label' => 'Programaeventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="programaevento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
