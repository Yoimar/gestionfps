<?php

use yii\helpers;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Gestión';
?>
<div class="site-index">

    <center><?= Html::img('@web/img/logo_fps2.jpg', ['alt' => 'Logo Fundación', 'width' => '40%']); ?></center>
    <div class="jumbotron">
        <h1>Fundación Pueblo Soberano</h1>
        <h2>Gestión</h2>
    </div>
    
    <center>
    <?= Html::a('<span class="glyphicon glyphicon-ok-sign"></span>Aprobar Caso por SIGESP', ['sepsolicitud/ubica'], ['class' => 'btn btn-primary']) ?>
</div>
