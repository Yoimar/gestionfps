<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Lugar */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Lugares', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lugar-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="col-md-6">



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre',
            'centro_clasificacion_id',
            'google_place_gps',
            'nombre_slug',
            'parroquia_id',
            'direccion',
            'telefono1',
            'telefono2',
            'telefono3',
            'notas:ntext',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
        ],
    ]) ?>

    </div>

    <div class="col-md-6">

<?php
    if ($gps!==false)
    {
        $coord = new LatLng([
            'lat' => $gps->lat,
            'lng' => $gps->lng
        ]);
        $map = new Map([
            'center' => $coord,
            'zoom' => 14,
            'width'=>300,
            'height'=>300,
        ]);
        $marker = new Marker([
            'position' => $coord,
            'title' => $model->name,
        ]);
        // Add marker to the map
        $map->addOverlay($marker);
        echo $map->display();
    }
    else
    {
        echo 'No location coordinates for this place could be found.';
    }
?>


    </div>


</div>
