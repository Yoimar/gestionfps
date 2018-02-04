<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Authassignment */

$this->title = 'Actualizar Perfil: ' . $model->usuariogestion->username;
$this->params['breadcrumbs'][] = ['label' => 'Perfiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->usuariogestion->username, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="authassignment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
