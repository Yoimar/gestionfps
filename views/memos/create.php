<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Memos */

$this->title = 'Create Memos';
$this->params['breadcrumbs'][] = ['label' => 'Memos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="memos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
