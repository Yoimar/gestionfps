<?php
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use miloschuman\highcharts\SeriesDataHelper;
use app\models\Solicitudes;

$estatus2= Yii::$app->db->createCommand("select e2.nombre from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id where e1.id = 1 group by e2.nombre")->queryAll();

$k=0;
for ($j = 0; $j < count($estatus2); $j++)
    {
        $sql="select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id where e2.nombre = '". $estatus2[$j]['nombre']."'";
        $valoresdata2[$k]['name']= $estatus2[$j]['nombre'];
        $valoresdata2[$k]['y']= (int)Yii::$app->db->createCommand($sql)->queryscalar();// Su valor;
        $valoresdata2[$k]["drilldown"]= $estatus2[$j]['nombre'];

    $k=$k + 1;

}

$estatus2= Yii::$app->db->createCommand("select e2.nombre from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id where e1.id = 1 group by e2.nombre")->queryAll();

$k=0;
for ($j = 0; $j < count($estatus2); $j++)
    {

        $valoresdata1[$k]['name']= $estatus2[$j]['nombre'];
        $valoresdata1[$k]['id']= $estatus2[$j]['nombre'];
        $estatus3= Yii::$app->db->createCommand("select e3.nombre from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id where e1.id = 1 and e2.nombre = '". $estatus2[$j]['nombre']."' group by e3.nombre")->queryAll();
        $kf=0;
        for ($jf = 0; $jf < count($estatus3); $jf++)
            {
                $sql="select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id where e1.id = 1 and e3.nombre = '". $estatus3[$jf]['nombre']."'";
                $valoresdata1[$k]['data'][$kf][0]= $estatus3[$jf]['nombre'];
                $valoresdata1[$k]['data'][$kf][1]= Yii::$app->db->createCommand($sql)->queryscalar();// Su valor;

            $kf=$kf + 1;

        }


    $k=$k + 1;

}

echo Highcharts::widget([

    'scripts' => [
        'modules/column',
        'modules/drilldown',
        'modules/exporting',
        'themes/default',

    ],

    'options' => [

            'title' => ['text' => 'REPORTE CASOS BIENESTAR SOCIAL'],
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
                    'data' => $valoresdata2,

                    ]
            ],
            "drilldown" => [
                'series' => $valoresdata1,

            ],

],

]);


?>
