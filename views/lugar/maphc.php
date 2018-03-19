<?php
use miloschuman\highcharts\Highmaps;
use yii\web\JsExpression;


 // To use Highcharts Map Collection, we must register those files separately.
 // The 'depends' option ensures that the main Highmaps script gets loaded first.
$this->registerJsFile('https://code.highcharts.com/mapdata/countries/ve/ve-all.js', [
    'depends' => 'miloschuman\highcharts\HighchartsAsset'
]);
?>
<center>
<?php
echo Highmaps::widget([
    'options' => [
        'chart' => [
            'map' => 'countries/ve/ve-all',
            'width' => 1000,
            'height' => 500
        ],
        'title' => [
            'text' => 'Reporte de Hospitales',
        ],
        'mapNavigation' => [
            'enabled' => true,
        ],
        'tooltip' => [
            'headerFormat' => 'Lugar: ',
            'pointFormat' => '<b>{point.name}</b><br>Lat: {point.lat}, Lon: {point.lon}',
        ],
        'series' => [
            [
                // Use the gb-all map with no data as a basemap
                'name' => 'Basemap',
                'borderColor' => '#A0A0A0',
                'nullColor' => 'rgba(200, 200, 200, 0.3)',
                'showInLegend' => false
                ],
            [
                'name' => 'Separators',
                'type' => 'mapline',
                'nullColor' => '#707070',
                'showInLegend' => false,
                'enableMouseTracking' => false
            ],
            [
                // Specify points using lat/lon
                'type' => 'mappoint',
                'name' => 'Lugares',
                'color' => '#000000',
                'data' => $data,
            ]
        ]
    ]
]);

?>
</center>
<!--OJO TRATAR DE DESCARGAR ESTO POR UN ASSET PARA QUE NO HAGA LA PETICIÓN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.3.6/proj4.js"></script>
