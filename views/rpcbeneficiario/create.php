<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Rpcbeneficiario */

$this->title = 'Create Rpcbeneficiario';
$this->params['breadcrumbs'][] = ['label' => 'Rpcbeneficiarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rpcbeneficiario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
