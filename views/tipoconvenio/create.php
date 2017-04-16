<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoConvenio */

$this->title = 'Create Tipo Convenio';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Convenios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-convenio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
