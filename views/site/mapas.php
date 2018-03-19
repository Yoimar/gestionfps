<?php

use dosamigos\google\maps\Map;
use dosamigos\google\maps\LatLng;

use dosamigos\google\maps\layers\BicyclingLayer;

use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\overlays\Polygon;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\PolylineOptions;

use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\services\DirectionsClient;
use dosamigos\google\maps\services\DirectionsRequest;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsWayPoint;

use yii\helpers\Html;

?>


<center>
<?php


$coord = new LatLng(['lat' => 10.4543807, 'lng' =>-66.9134839]);
// lets use the directions renderer
$map = new Map([
    'center' => $coord,
    'zoom' => 8,
]);


// Lets add a marker now'@bower' => '@vendor/yidas/yii2-bower-asset/bower'
//$marker = new Marker([
//    'position' => $coord,
//    'title' => 'My Home Town',
//]);


//// Provide a shared InfoWindow to the marker
//$marker->attachInfoWindow(
//    new InfoWindow([
//        'content' => '<p>This is my super cool content</p>'
//    ])
//);
//
//// Add marker to the map
//$map->addOverlay($marker);


// Lets show the BicyclingLayer :)
//$bikeLayer = new BicyclingLayer(['map' => $map->getName()]);

// Append its resulting script
$map->appendScript($map->getJs());

// Display the map -finally :)
echo $map->display();

?>

        <?= Html::button('<span class="glyphicon glyphicon-ok-sign"></span>Localizarme',  ['class' => 'btn btn-primary', 'id' => 'localizarme']) ?>

</center>

<?php

$this->registerJs(<<<JS

$('#localizarme').on('click', function() {

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert( "La Geolocalizacion no es soportada por el navegador" );
    }


    function showPosition(position) {
        var pos = {
             lat: position.coords.latitude,
             lng: position.coords.longitude
        };

        var mapOptions = {"center":pos,"zoom":15};
        var container = document.getElementById('gmap0-map-canvas');
        container.style.width = '512px';
        container.style.height = '512px';
        var gmap0 = new google.maps.Map(container, mapOptions);
        var infoWindow = new google.maps.InfoWindow({map: gmap0});

        infoWindow.setPosition(pos);
        infoWindow.setContent('<br><div><p>Tu ubicación</p></div><br>');
        var marker = new google.maps.Marker({
            position: pos,
            map: gmap0,
            title:"Estas aqui.!"
        });
    }


})

JS

);

?>
<!--

SQL de la Tabla Lugar

CREATE TABLE lugar
(
  id serial NOT NULL,
  nombre character varying(200) NOT NULL,
  centro_clasificacion_id integer NOT NULL,
  lat float NOT NULL,
  lng float NOT NULL,
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
      REFERENCES centro_clasificacion (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT created_by_id_lugar FOREIGN KEY (created_by)
      REFERENCES "user" (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT parroquia_id FOREIGN KEY (parroquia_id)
      REFERENCES parroquias (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT updated_by_id_lugar FOREIGN KEY (updated_by)
      REFERENCES "user" (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT nombre_slug_unique UNIQUE (nombre_slug)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE lugar
  OWNER TO postgres;


-->
