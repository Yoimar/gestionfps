<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Codbancos */

$this->title = 'Create Codbancos';
$this->params['breadcrumbs'][] = ['label' => 'Codbancos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="codbancos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
