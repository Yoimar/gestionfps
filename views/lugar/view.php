<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\Marker;

/* @var $this yii\web\View */
/* @var $model app\models\Lugar */

$this->title = $model->nombre_slug;
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
                'confirm' => 'Está seguro de que desea borrar este item?',
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
            [
            'attribute' => 'centroclasificacion.nombre',
            'value' => $model->centroclasificacion->nombre,
            'format' => 'text',
            ],
            //'centroclasificacion.nombre',
            'parroquia.nombre',
            'direccion',
            'telefono1',
            'telefono2',
            'telefono3',
            'notas:ntext',
        ],
    ]) ?>

</div>

<div class="col-md-6">
<?php
  if ($model->lat!==false) {
      $coord = new LatLng(['lat' => $model->lat, 'lng' => $model->lng]);
      $map = new Map([
        'center' => $coord,
        'zoom' => 16,
        'width'=>400,
        'height'=>400,
    ]);
      $marker = new Marker([
        'position' => $coord,
        'title' => $model->nombre,
    ]);
      // Add marker to the map
      $map->addOverlay($marker);
      echo $map->display();
  } else {
      echo 'No location coordinates for this place could be found.';
  }
?>

</div> <!-- end second col -->

<!-- Fin del div class lugar-view-->
</div>
