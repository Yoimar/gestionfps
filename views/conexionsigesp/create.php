<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Conexionsigesp */

$this->title = 'Create Conexionsigesp';
$this->params['breadcrumbs'][] = ['label' => 'Conexionsigesps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conexionsigesp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
