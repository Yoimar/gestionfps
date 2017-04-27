<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Bitacoras */

$this->title = 'Create Bitacoras';
$this->params['breadcrumbs'][] = ['label' => 'Bitacoras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bitacoras-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
