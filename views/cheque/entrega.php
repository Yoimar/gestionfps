<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cheque */

$this->title = 'Create Cheque';
$this->params['breadcrumbs'][] = ['label' => 'Cheques', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cheque-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formentrega', [
        'model' => $model,
    ]) ?>

</div>
