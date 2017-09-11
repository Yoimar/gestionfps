<?php 
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use miloschuman\highcharts\SeriesDataHelper;
use app\models\Solicitudes;

$estatus3= Yii::$app->db->createCommand("select e3.nombre from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id group by e3.nombre")->queryAll();

$k=0;
for ($j = 0; $j < count($estatus3); $j++)
    {
        $sql="select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id where e3.nombre = '". $estatus3[$j]['nombre']."'";
        $valoresdata1[$k]['name']= $estatus3[$j]['nombre'];
        $valoresdata1[$k]['y']= Yii::$app->db->createCommand($sql)->queryscalar();// Su valor;
        $valoresdata1[$k]['drilldown']= $estatus3[$j]['nombre'];
        
    $k=$k + 1;    
           
}

//$k=0;
//for ($j = 0; $j < count($estatus1); $j++)
//    {
//        $sql="select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id where e1.nombre = '". $estatus1[$j]['nombre']."'";
//        $valoresdata2[$k]['name']= $estatus1[$j]['nombre'];
//        $valoresdata2[$k]['id']= $estatus1[$j]['nombre'];//Yii::$app->db->createCommand($sql)->queryscalar();// Su valor;
//        $l=0;
//        $estatus2 = Yii::$app->db->createCommand("select e2.nombre from estatus2 e2 join estatus1 e1 on e2.estatus1_id = e1.id where e1.nombre = '". $estatus1[$j]['nombre']."'")->queryAll();
//        for ($i = 0; $i < count($estatus2); $i++)
//        {
//            $sql="select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id where e1.nombre = '". $estatus1[$j]['nombre']."' and e2.nombre = '". $estatus2[$i]['nombre']."'";
//            $valoresdata2[$k]['data'][$l]['name']= $estatus2[$i]['nombre'];
//            $valoresdata2[$k]['data'][$l]['y']= 1*Yii::$app->db->createCommand($sql)->queryscalar();// Su valor;
//            $valoresdata2[$k]['data'][$l]['drilldown']= $estatus2[$i]['nombre'];
//        $l=$l+1;
//        }
//        
//    $k=$k + 1;    
//           
//}
//
//$estatus2 = Yii::$app->db->createCommand("select e2.nombre from estatus2 e2 join estatus1 e1 on e2.estatus1_id = e1.id")->queryAll();
//
//for ($j = 0; $j < count($estatus2); $j++)
//    {
//        $sql="select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id where e2.nombre = '". $estatus2[$j]['nombre']."'";
//        $valoresdata2[$k]['name']= $estatus2[$j]['nombre'];
//        $valoresdata2[$k]['id']=  $estatus2[$j]['nombre'];//1*Yii::$app->db->createCommand($sql)->queryscalar();// Su valor;
//        $l=0;
//        $estatus3 = Yii::$app->db->createCommand("select e3.nombre from estatus3 e3 join estatus2 e2 on e3.estatus2_id = e2.id where e2.nombre = '". $estatus2[$j]['nombre']."'")->queryAll();
//        for ($i = 0; $i < count($estatus3); $i++)
//        {
//            $sql="select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id where e2.nombre = '". $estatus2[$j]['nombre']."' and e3.nombre = '". $estatus3[$i]['nombre']."'";
//            $valoresdata2[$k]['data'][$l]['name']= "'".$estatus3[$i]['nombre']."'";
//            $valoresdata2[$k]['data'][$l]['y']= Yii::$app->db->createCommand($sql)->queryscalar();// Su valor;
//            //$valoresdata2[$k]['data'][$l]['drilldown']= $estatus3[$i]['nombre'];
//        $l=$l+1;
//        }
//        
//    $k=$k + 1;    
//           
//}
//$pruebancha = new SeriesDataHelper($valoresdata2,['name','id']);

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
                    'data' => new SeriesDataHelper($valoresdata1,['name','y:int','drilldown']),
                   
                    ]
            ],
           
        

],

]);

$estatus1= Yii::$app->db->createCommand("select nombre from estatus1")->queryAll();

//$coso = [[
//            'name' => 'Microsoft Internet Explorer',
//            'id' => 'Microsoft Internet Explorer',
//            'data' => [
//                [
//                    'v11.0',
//                    24.13
//                ],
//                [
//                    'v8.0',
//                    17.2
//                ],
//                [
//                    'v9.0',
//                    8.11
//                ],
//                [
//                    'v10.0',
//                    5.33
//                ],
//                [
//                    'v6.0',
//                    1.06
//                ],
//                [
//                    'v7.0',
//                    0.5
//                ]
//            ]
//        ], [
//            'name' => 'Chrome',
//            'id' => 'Chrome',
//            'data' => [
//                [
//                    'v40.0',
//                    5
//                ],
//                [
//                    'v41.0',
//                    4.32
//                ],
//                [
//                    'v42.0',
//                    3.68
//                ],
//                [
//                    'v39.0',
//                    2.96
//                ],
//                [
//                    'v36.0',
//                    2.53
//                ],
//                [
//                    'v43.0',
//                    1.45
//                ],
//                [
//                    'v31.0',
//                    1.24
//                ],
//                [
//                    'v35.0',
//                    0.85
//                ],
//                [
//                    'v38.0',
//                    0.6
//                ],
//                [
//                    'v32.0',
//                    0.55
//                ],
//                [
//                    'v37.0',
//                    0.38
//                ],
//                [
//                    'v33.0',
//                    0.19
//                ],
//                [
//                    'v34.0',
//                    0.14
//                ],
//                [
//                    'v30.0',
//                    0.14
//                ]
//            ]
//        ], [
//            'name' => 'Firefox',
//            'id' => 'Firefox',
//            'data' => [
//                [
//                    'v35',
//                    2.76
//                ],
//                [
//                    'v36',
//                    2.32
//                ],
//                [
//                    'v37',
//                    2.31
//                ],
//                [
//                    'v34',
//                    1.27
//                ],
//                [
//                    'v38',
//                    1.02
//                ],
//                [
//                    'v31',
//                    0.33
//                ],
//                [
//                    'v33',
//                    0.22
//                ],
//                [
//                    'v32',
//                    0.15
//                ]
//            ]
//        ], [
//            'name' => 'Safari',
//            'id' => 'Safari',
//            'data' => [
//                [
//                    'v8.0',
//                    2.56
//                ],
//                [
//                    'v7.1',
//                    0.77
//                ],
//                [
//                    'v5.1',
//                    0.42
//                ],
//                [
//                    'v5.0',
//                    0.3
//                ],
//                [
//                    'v6.1',
//                    0.29
//                ],
//                [
//                    'v7.0',
//                    0.26
//                ],
//                [
//                    'v6.2',
//                    0.17
//                ]
//            ]
//        ], [
//            'name' => 'Opera',
//            'id' => 'Opera',
//            'data' => [
//                [
//                    'v12.x',
//                    0.34
//                ],
//                [
//                    'v28',
//                    0.24
//                ],
//                [
//                    'v27',
//                    0.17
//                ],
//                [
//                    'v29',
//                    0.16
//                ]
//            ]
//        ]];
//
//
//
//
//
//$k=0;
//for ($j = 0; $j < count($estatus1); $j++)
//    {
//        $sql="select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id where e1.nombre = '". $estatus1[$j]['nombre']."'";
//        $valoresdata2[$k]['name']= $estatus1[$j]['nombre'];
//        $valoresdata2[$k]['id']= Yii::$app->db->createCommand($sql)->queryscalar();// Su valor;
//        $l=0;
//        $estatus2 = Yii::$app->db->createCommand("select e2.nombre from estatus2 e2 join estatus1 e1 on e2.estatus1_id = e1.id where e1.nombre = '". $estatus1[$j]['nombre']."'")->queryAll();
//        for ($i = 0; $i < count($estatus2); $i++)
//        {
//            $sql="select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id where e1.nombre = '". $estatus1[$j]['nombre']."' and e2.nombre = '". $estatus2[$i]['nombre']."'";
//            $valoresdata2[$k]['data'][$l]['name']= $estatus2[$i]['nombre'];
//            $valoresdata2[$k]['data'][$l]['y']= Yii::$app->db->createCommand($sql)->queryscalar();// Su valor;
//            $valoresdata2[$k]['data'][$l]['drilldown']= $estatus2[$i]['nombre'];
//        $l=$l+1;
//        }
//        
//    $k=$k + 1;    
//           
//}
//
//$estatus2 = Yii::$app->db->createCommand("select e2.nombre from estatus2 e2 join estatus1 e1 on e2.estatus1_id = e1.id")->queryAll();
//
//for ($j = 0; $j < count($estatus2); $j++)
//    {
//        $sql="select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id where e2.nombre = '". $estatus2[$j]['nombre']."'";
//        $valoresdata2[$k]['name']= $estatus2[$j]['nombre'];
//        $valoresdata2[$k]['id']= Yii::$app->db->createCommand($sql)->queryscalar();// Su valor;
//        $l=0;
//        $estatus3 = Yii::$app->db->createCommand("select e3.nombre from estatus3 e3 join estatus2 e2 on e3.estatus2_id = e2.id where e2.nombre = '". $estatus2[$j]['nombre']."'")->queryAll();
//        for ($i = 0; $i < count($estatus3); $i++)
//        {
//            $sql="select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id where e2.nombre = '". $estatus2[$j]['nombre']."' and e3.nombre = '". $estatus3[$i]['nombre']."'";
//            $valoresdata2[$k]['data'][$l]['name']= $estatus3[$i]['nombre'];
//            $valoresdata2[$k]['data'][$l]['y']= Yii::$app->db->createCommand($sql)->queryscalar();// Su valor;
//            //$valoresdata2[$k]['data'][$l]['drilldown']= $estatus3[$i]['nombre'];
//        $l=$l+1;
//        }
//        
//    $k=$k + 1;    
//           
//}



/*

$k=0;
for ($i = 0; $i < count($trabajadorescolumnas); $i++)
{
    
    if ($i + 1 < count($trabajadorescolumnas) ){
        for ($j = 0; $j < count($estatusfilas); $j++)
    {
        $sql="select count(*) from solicitudes s1 full outer join users u1 on s1.usuario_asignacion_id = u1.id join recepciones r1 on r1.id = s1.recepcion_id join estatussasyc e1 on e1.id = s1.estatus where extract(year from s1.created_at)=2017 and u1.nombre = '". $trabajadorescolumnas[$i]['nombre'] ."' and s1.estatus = '". $estatusfilas[$j]['estatus']."'";
        $valores[$k][0]= $i;
        $valores[$k][1]= $j;
        $valores[$k][2]= Yii::$app->db->createCommand($sql)->queryscalar();// Su valor
        
    $k=$k + 1;    
        
    }
    }else{
    
    for ($j = 0; $j < count($estatusfilas); $j++)
    {
        $sql="select count(*) from solicitudes s1 full outer join users u1 on s1.usuario_asignacion_id = u1.id join recepciones r1 on r1.id = s1.recepcion_id join estatussasyc e1 on e1.id = s1.estatus where extract(year from s1.created_at)=2017 and u1.nombre is NULL and s1.estatus = '". $estatusfilas[$j]['estatus']."'";
        $valores[$k][0]= $i;
        $valores[$k][1]= $j;
        $valores[$k][2]= Yii::$app->db->createCommand($sql)->queryscalar();// Su valor
        
    $k=$k + 1;    
        
    }
    
    }
    
    
} */


?>
