<?php
use yii\helpers\ArrayHelper;

foreach ($data as $elindice => $elarray) {

    foreach ($elarray as $key => $value) {
        $elarray['zoomLevel'] = 20;
        $elarray['width'] = 30;
        $elarray['height'] = 30;
        $elarray['imageURL'] = Yii::getAlias('@web').'/img/MarkerMapHospital2.png';
    }
    $ammapdata[$elindice]=$elarray;
}

$chartConfiguration = [
    'type' => "map",
    'theme' => "light",
    'dataProvider' => [
        "map" => "venezuelaHigh",
        "projection" => "winkel3",
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
        'rollOverColor' => "#CCCCCC",
        'alpha' => 0.8
    ],

    'export' => [
        'enabled' => true,
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
