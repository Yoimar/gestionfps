<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Estatusllamadas */

$this->title = 'Create Estatusllamadas';
$this->params['breadcrumbs'][] = ['label' => 'Estatusllamadas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estatusllamadas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
