<?php

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\services\DirectionsWayPoint;
use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\services\DirectionsRequest;
use dosamigos\google\maps\overlays\Polygon;
use dosamigos\google\maps\layers\BicyclingLayer;

$coord = new LatLng(['lat' => 10.5162329, 'lng' => -66.9114637]);
// lets use the directions renderer
$map = new Map([
    'center' => $coord,
    'zoom' => 14,
]);



// Lets add a marker now'@bower' => '@vendor/yidas/yii2-bower-asset/bower'
$marker = new Marker([
    'position' => $coord,
    'title' => 'My Home Town',
]);


// Provide a shared InfoWindow to the marker
$marker->attachInfoWindow(
    new InfoWindow([
        'content' => '<p>This is my super cool content</p>'
    ])
);

// Add marker to the map
$map->addOverlay($marker);


// Lets show the BicyclingLayer :)
$bikeLayer = new BicyclingLayer(['map' => $map->getName()]);

// Append its resulting script
$map->appendScript($bikeLayer->getJs());

// Display the map -finally :)
echo $map->display();

?>

<!--
SQL de Array

-- Table: public.lugar

-- DROP TABLE public.lugar;

CREATE TABLE public.lugar
(
  id serial,
  nombre character varying(200) NOT NULL,
  centro_clasificacion_id integer NOT NULL,
  lat  NOT NULL,
  log  NOT NULL,
  nombre_slug character varying,
  parroquia_id integer NOT NULL,
  direccion character varying(500),
  telefono1 character varying(12),
  telefono2 character varying(12),
  telefono3 character varying(12),
  notas text,
  created_at timestamp without time zone,
  created_by integer,
  updated_at time without time zone,
  updated_by integer,
  CONSTRAINT id_lugar PRIMARY KEY (id),
  CONSTRAINT centro_clasificacion_id FOREIGN KEY (centro_clasificacion_id)
      REFERENCES public.centro_clasificacion (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT created_by_id_lugar FOREIGN KEY (created_by)
      REFERENCES public."user" (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT parroquia_id FOREIGN KEY (parroquia_id)
      REFERENCES public.parroquias (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT updated_by_id_lugar FOREIGN KEY (updated_by)
      REFERENCES public."user" (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT nombre_slug_unique UNIQUE (nombre_slug)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.lugar
  OWNER TO postgres;


-->
