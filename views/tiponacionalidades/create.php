<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoNacionalidades */

$this->title = 'Create Tipo Nacionalidades';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Nacionalidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-nacionalidades-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
