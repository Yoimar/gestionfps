</div>
<?php 
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use miloschuman\highcharts\SeriesDataHelper;
use app\models\Solicitudes;




 
 
$trabajadorescolumnas= Yii::$app->db->createCommand("select u1.nombre from solicitudes s1 full outer join users u1 on s1.usuario_asignacion_id = u1.id where extract(year from s1.created_at)=2017 group by u1.nombre order by u1.nombre")->queryAll();
$estatusfilas= Yii::$app->db->createCommand("select s1.estatus from solicitudes s1 full outer join users u1 on s1.usuario_asignacion_id = u1.id where extract(year from s1.created_at)=2017 group by s1.estatus order by s1.estatus")->queryAll();
foreach ($trabajadorescolumnas as $val) {
        $coso[]=$val['nombre'];
 }

$k=0;
for ($i = 0; $i < count($trabajadorescolumnas); $i++)
{
    
    if ($i + 1 < count($trabajadorescolumnas) ){
        for ($j = 0; $j < count($estatusfilas); $j++)
    {
        $sql="select count(*) from solicitudes s1 full outer join users u1 on s1.usuario_asignacion_id = u1.id where extract(year from s1.created_at)=2017 and u1.nombre = '". $trabajadorescolumnas[$i]['nombre'] ."' and s1.estatus = '". $estatusfilas[$j]['estatus']."'";
        $valores[$k][0]= $i;
        $valores[$k][1]= $j;
        $valores[$k][2]= Yii::$app->db->createCommand($sql)->queryscalar();// Su valor
        $valores[$k][3]= '#0B0B61';
        
    $k=$k + 1;    
        
    }
    }else{
    
    for ($j = 0; $j < count($estatusfilas); $j++)
    {
        $sql="select count(*) from solicitudes s1 full outer join users u1 on s1.usuario_asignacion_id = u1.id where extract(year from s1.created_at)=2017 and u1.nombre is NULL and s1.estatus = '". $estatusfilas[$j]['estatus']."'";
        $valores[$k][0]= $i;
        $valores[$k][1]= $j;
        $valores[$k][2]= Yii::$app->db->createCommand($sql)->queryscalar();// Su valor
        $valores[$k][3]= '#0B0B61';
        
    $k=$k + 1;    
        
    }
    
    }
    
    
}   

echo Highcharts::widget([
       
    'scripts' => [
        'modules/heatmap',
        'modules/exporting',
        'themes/default'
    ],

    'options' => [

            'title' => ['text' => 'Casos Atencion al Soberano'],
            'chart' => [
                    'type' => 'heatmap'
            ],
            'xAxis' => [
                    'categories' =>$coso,
            ],
            'yAxis' => [
                    'categories' => ['ACA', 'ANU', 'APR', 'ART', 'DEV', 'EAA', 'ELA', 'ELD', 'PPA'],
            ],

            'colorAxis' =>[
                 'minColor' => '#FFFFFF',
                 'maxColor' => '#000000',

            ],
        
            'legend' => [
                'align' => 'right',
                'layout' => 'vertical',
                'margin' => 0,
                'verticalAlign' => 'top',
                'y' => 25,
                'symbolHeight' => 280
            ],
            'tooltip' => [
                'formatter' => new JsExpression("function () {
                    return '<b>' + this.series.xAxis.categories[this.point.x] + '</b> tiene <br><b>' + this.point.value + '</b> casos en el estatus <br><b>' + this.series.yAxis.categories[this.point.y] + '</b>';
                    }"),
            ],
        
         
            'plotOptions' => [
                'series' => [
                    'color'=> '#000000',
                    'colorByPoint' => false],
                'area' => [
                    'fillColor' => '#ffffff'
                ],
            ],
        
      

            'series' => [[
                    'name' => 'Casos',
                    'borderWidth' => 2,
                    'data' => new SeriesDataHelper($valores,['0:int','1:int','2:int']),
                    'color' => '#000000', 
                    'dataLabels' => [
                            'enabled' => true,
                            'color' => '#000000'
                        
                        ]
                    ]
            ]
    ]

]);