<?php

use yii\helpers;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Gestión';
?>
<div class="site-index">

    <center><?= Html::img('@web/img/logo_fps2.jpg', ['alt' => 'Logo Fundación', 'width' => '40%']); ?></center>
    <center>
        <h3>Fundación Pueblo Soberano</h3>
        <h6>Gestión</h6>
    <?= Html::a('<span class="glyphicon glyphicon-ok-sign"></span>Aprobar Caso por SIGESP', ['sepsolicitud/ubica'], ['class' => 'btn btn-primary']) ?>
</center>
</div>
