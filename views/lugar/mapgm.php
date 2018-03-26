<?php
use dosamigos\google\maps\Map;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\Marker;

$coordenadacentral = new LatLng([
    'lat' => $data['0']['lat'],
    'lng' => $data['0']['lng']
]);
$map = new Map([
    'center' => $coordenadacentral,
    'zoom' => 7,
    'width'=>1000,
    'height'=>400,
]);

foreach ($data as $elindice => $elarray) {

    foreach ($elarray as $key => $value) {

        $coord[$elindice] = new LatLng([
            'lat' => $elarray['lat'],
            'lng' => $elarray['lng']
        ]);
        $marker[$elindice] = new Marker([
            'position' => $coord[$elindice],
            'title' => $elarray['nombre'],
        ]);
        // Add marker to the map
        $map->addOverlay($marker[$elindice]);


    }

}


    echo $map->display();


?>
