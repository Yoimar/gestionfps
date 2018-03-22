<?php
use yii\helpers\ArrayHelper;

foreach ($data as $elindice => $elarray) {

    foreach ($elarray as $key => $value) {
        $elarray['zoomLevel'] = 20;
        $elarray['width'] = 15;
        $elarray['height'] = 15;
        $elarray['imageURL'] = "https://www.amcharts.com/images/weather/weather-rain.png";
    }
    $ammapdata[$elindice]=$elarray;
}

$chartConfiguration = [
    'type' => "map",
    'theme' => "light",
    'dataProvider' => [
        "map" => "venezuelaHigh",
        "zoomLevel" => 1,
        "zoomLongitude" => -66,
        "zoomLatitude" => 6.5,
        "images" => $ammapdata,
    ],

    'imagesSettings' => [
        'labelRollOverColor' => "#FFFFFF",
        'labelPosition' => "bottom"
    ],

    'areasSettings' => [
        'rollOverOutlineColor' => "#FFFFFF",
        'rollOverColor' => "#CC0000",
        'alpha' => 0.8
    ],

    'export' => [
        'enabled' => true
    ]
  // Fin del char de Configuracion
];

echo mitrm\amcharts\amMap::widget([
    'chartConfiguration' => $chartConfiguration,
    'options' => ['id' => 'chart_id'],
    'width' => '100%',
    'language' => 'es',
]);

?>
