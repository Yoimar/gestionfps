<?php
use miloschuman\highcharts\Highmaps;
use yii\web\JsExpression;


 // To use Highcharts Map Collection, we must register those files separately.
 // The 'depends' option ensures that the main Highmaps script gets loaded first.
$this->registerJsFile('https://code.highcharts.com/mapdata/countries/ve/ve-all.js', [
    'depends' => 'miloschuman\highcharts\HighchartsAsset'
]);

echo Highmaps::widget([
    'options' => [
        'title' => [
            'text' => 'Highmaps basic demo',
        ],
        'mapNavigation' => [
            'enabled' => true,
            'buttonOptions' => [
                'verticalAlign' => 'bottom',
            ]
        ],
        'colorAxis' => [
            'min' => 0,
        ],
        'series' => [
            [
                'data' => [
                    ['hc-key' => 've-dp', 'value' => 10],
                    ['hc-key' => 've-ne', 'value' => 1],
                    ['hc-key' => 've-su', 'value' => 2],
                ],
                'mapData' => new JsExpression('Highcharts.maps["countries/ve/ve-all"]'),
                'joinBy' => 'hc-key',
                'name' => 'Random data',
                'states' => [
                    'hover' => [
                        'color' => '#BADA55',
                    ]
                ],
                'dataLabels' => [
                    'enabled' => true,
                    'format' => '{point.name}',
                ]
            ]
        ]
    ]
]);

?>
