<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Estatus2 */

$this->title = 'Create Estatus2';
$this->params['breadcrumbs'][] = ['label' => 'Estatus2s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estatus2-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
