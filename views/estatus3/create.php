<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Estatus3 */

$this->title = 'Create Estatus3';
$this->params['breadcrumbs'][] = ['label' => 'Estatus3s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estatus3-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
