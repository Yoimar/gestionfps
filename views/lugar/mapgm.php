<?php
use dosamigos\google\maps\Map;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\Marker;

    $coord = new LatLng([
        'lat' => $model->lat,
        'lng' => $model->lng
    ]);
    $map = new Map([
        'center' => $coord,
        'zoom' => 16,
        'width'=>500,
        'height'=>400,
    ]);
    $marker = new Marker([
        'position' => $coord,
        'title' => $model->nombre,
    ]);
    // Add marker to the map
    $map->addOverlay($marker);
    echo $map->display();

?>
