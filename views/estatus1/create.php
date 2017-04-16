<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Estatus1 */

$this->title = 'Create Estatus1';
$this->params['breadcrumbs'][] = ['label' => 'Estatus1s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estatus1-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
