<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Casascomerciales */

$this->title = 'Create Casascomerciales';
$this->params['breadcrumbs'][] = ['label' => 'Casascomerciales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="casascomerciales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
