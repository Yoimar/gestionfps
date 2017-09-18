<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */

$this->title = 'Reporte General';
$this->params['breadcrumbs'][] = 'Reportes';
$this->params['breadcrumbs'][] = $this->title;

$mesespanish = ArrayHelper::map([
            ['id' => '1', 'Mesactividad' => 'Enero'],
            ['id' => '2', 'Mesactividad' => 'Febrero'],
            ['id' => '3', 'Mesactividad' => 'Marzo'],
            ['id' => '4', 'Mesactividad' => 'Abril'],
            ['id' => '5', 'Mesactividad' => 'Mayo'],
            ['id' => '6', 'Mesactividad' => 'Junio'],
            ['id' => '7', 'Mesactividad' => 'Julio'],
            ['id' => '8', 'Mesactividad' => 'Agosto'],
            ['id' => '9', 'Mesactividad' => 'Septiembre'],
            ['id' => '10', 'Mesactividad' => 'Octubre'],
            ['id' => '11', 'Mesactividad' => 'Noviembre'],
            ['id' => '12', 'Mesactividad' => 'Diciembre']
            ], 'id', 'Mesactividad');

?>

<pre><?php print_r($mesespanish); echo $mesespanish['2'];?></pre>
