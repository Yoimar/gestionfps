<?php 
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use miloschuman\highcharts\SeriesDataHelper;
use app\models\Solicitudes;

$estatus2= Yii::$app->db->createCommand("select e2.nombre from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id group by e2.nombre")->queryAll();

$k=0;
for ($j = 0; $j < count($estatus2); $j++)
    {
        $sql="select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id where e2.nombre = '". $estatus2[$j]['nombre']."'";
        $valoresdata1[$k]['name']= $estatus2[$j]['nombre'];
        $valoresdata1[$k]['y']= Yii::$app->db->createCommand($sql)->queryscalar();// Su valor;
        $valoresdata1[$k]['drilldown']= $estatus2[$j]['nombre'];
        
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
                    'data' => new SeriesDataHelper($valoresdata1,['name','y:int','drilldown']),
                   
                    ]
            ],
           
        

],

]);

