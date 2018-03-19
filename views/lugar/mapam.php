<?php


$chartConfiguration = [
    'type' => "map",
    'theme' => "light",
    'dataProvider' => [
        "map" => "venezuelaHigh",
        "zoomLevel" => 2,
        "zoomLongitude" => -66,
        "zoomLatitude" => 10,
        "images" => [
            [
                'latitude' => 10.516326,
                'longitude' => -66.9549314,
                'imageURL' => "https://www.amcharts.com/images/weather/weather-rain.png",
                'width' => 32,
                'height' => 32,
                'label' => "Madrid: +22C"
            ],
        //Fin del Images
        ]
        // Fin del Chart del data Chart
    ],

    'imagesSettings' => [
        'labelRollOverColor' => "#000",
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
