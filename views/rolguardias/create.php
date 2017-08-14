<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Rolguardias */

$this->title = 'Create Rolguardias';
$this->params['breadcrumbs'][] = ['label' => 'Rolguardias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rolguardias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
