<?php
use miloschuman\highcharts\SeriesDataHelper;
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;


$estatus1= Yii::$app->db->createCommand("select e1.nombre from lugar l1 join parroquias p3 on l1.parroquia_id = p3.id join municipios m2 on p3.municipio_id = m2.id join estados e1 on m2.estado_id = e1.id group by e1.nombre")->queryAll();

$k=0;
for ($j = 0; $j < count($estatus1); $j++)
    {
        $sql="select count(*) from lugar l1 join parroquias p3 on l1.parroquia_id = p3.id join municipios m2 on p3.municipio_id = m2.id join estados e1 on m2.estado_id = e1.id where e1.nombre = '". $estatus1[$j]['nombre']."'";
        $valoresdata1[$k]['name']= $estatus1[$j]['nombre'];
        $valoresdata1[$k]['y']= Yii::$app->db->createCommand($sql)->queryscalar();// Su valor;
        $valoresdata1[$k]['drilldown']= $estatus1[$j]['nombre'];

    $k=$k + 1;

}

print_r($valoresdata1);


echo Highcharts::widget([

    'scripts' => [
        'modules/column',
        'modules/drilldown',
        'modules/exporting',
        'themes/default',

    ],

    'options' => [

            'title' => ['text' => 'REPORTE POR ESTADOS'],
            'chart' => [
                    'type' => 'column',
                    'height' => 500,
            ],
            'xAxis' => [
                'type' => 'category',
                'title' => ['text' => 'Eje X'],
            ],
            'yAxis' => [
                    'title' => ['text' => 'Eje Y'],
            ],

            'legend' => [
                'enable' => false,
            ],


            'plotOptions' => [
                'series' => [
                    'borderWidth' => 0,
                    'dataLabels' => [
                        'enabled' => true,
                        'format' => '{point.y}'
                    ],
                ],
            ],



            'series' => [[
                    'name' => 'Casos',
                    'colorByPoint' => true,
                    'data' => new SeriesDataHelper($valoresdata1,['name','y:int','drilldown']),

                    ]
            ],



],

]);
