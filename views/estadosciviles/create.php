<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EstadosCiviles */

$this->title = 'Create Estados Civiles';
$this->params['breadcrumbs'][] = ['label' => 'Estados Civiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estados-civiles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
