<?php
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use miloschuman\highcharts\SeriesDataHelper;
use app\models\Solicitudes;

$ano = 2018;


$trabajadorescolumnas= Yii::$app->db->createCommand("select u1.nombre from solicitudes s1 full outer join users u1 on s1.usuario_asignacion_id = u1.id join recepciones r1 on r1.id = s1.recepcion_id join estatussasyc e1 on e1.id = s1.estatus where extract(year from s1.created_at)=".$ano." group by u1.nombre order by u1.nombre")->queryAll();
$estatus= Yii::$app->db->createCommand("select e1.estatus, e1.id from solicitudes s1 full outer join users u1 on s1.usuario_asignacion_id = u1.id join recepciones r1 on r1.id = s1.recepcion_id join estatussasyc e1 on e1.id = s1.estatus where extract(year from s1.created_at)=".$ano." group by e1.estatus, e1.id order by e1.id")->queryAll();
$estatusfilas= Yii::$app->db->createCommand("select s1.estatus from solicitudes s1 full outer join users u1 on s1.usuario_asignacion_id = u1.id join recepciones r1 on r1.id = s1.recepcion_id where extract(year from s1.created_at)=".$ano." group by s1.estatus order by s1.estatus")->queryAll();
foreach ($trabajadorescolumnas as $val) {
    if ($val['nombre']==null){
        $coso[]="Sin Usuario";
    }else{
        $coso[]=$val['nombre'];
    }
 }

 foreach ($estatus as $val) {
    if ($val['estatus']==null){
        $estx[]="Sin Usuario";
    }else{
        $estx[]=$val['estatus'];
    }
 }

$k=0;
for ($i = 0; $i < count($trabajadorescolumnas); $i++)
{

    if ($i + 1 < count($trabajadorescolumnas) ){
        for ($j = 0; $j < count($estatusfilas); $j++)
    {
        $sql="select count(*) from solicitudes s1 full outer join users u1 on s1.usuario_asignacion_id = u1.id join recepciones r1 on r1.id = s1.recepcion_id join estatussasyc e1 on e1.id = s1.estatus where extract(year from s1.created_at)=".$ano." and u1.nombre = '". $trabajadorescolumnas[$i]['nombre'] ."' and s1.estatus = '". $estatusfilas[$j]['estatus']."'";
        $valores[$k][0]= $i;
        $valores[$k][1]= $j;
        $valores[$k][2]= Yii::$app->db->createCommand($sql)->queryscalar();// Su valor

    $k=$k + 1;

    }
    }else{

    for ($j = 0; $j < count($estatusfilas); $j++)
    {
        $sql="select count(*) from solicitudes s1 full outer join users u1 on s1.usuario_asignacion_id = u1.id join recepciones r1 on r1.id = s1.recepcion_id join estatussasyc e1 on e1.id = s1.estatus where extract(year from s1.created_at)=".$ano." and u1.nombre is NULL and s1.estatus = '". $estatusfilas[$j]['estatus']."'";
        $valores[$k][0]= $i;
        $valores[$k][1]= $j;
        $valores[$k][2]= Yii::$app->db->createCommand($sql)->queryscalar();// Su valor

    $k=$k + 1;

    }

    }


}

echo Highcharts::widget([

    'scripts' => [
        'modules/heatmap',
        'modules/exporting',
        'themes/dark-unica'
    ],

    'options' => [

            'title' => ['text' => 'REPORTE GENERAL POR TRABAJADOR SOCIAL AÑO '.$ano],
            'chart' => [
                    'type' => 'heatmap',
                    'height' => 800,
            ],
            'xAxis' => [
                    'categories' => $estx,
                    'title' => ['text' => 'Estatus'],
            ],
            'yAxis' => [
                    'categories' =>$coso,
                    'title' => ['text' => 'Trabajadores Sociales'],
            ],

            'colorAxis' =>[
                 'minColor' => '#FFFFFF',
                 'maxColor' => new JsExpression("Highcharts.getOptions().colors[0]"),

            ],

            'legend' => [
                'align' => 'right',
                'layout' => 'vertical',
                'margin' => 0,
                'verticalAlign' => 'top',
                'y' => 25,
                'symbolHeight' => 700
            ],
            'tooltip' => [
                'formatter' => new JsExpression("function () {
                    return '<b>' + this.series.yAxis.categories[this.point.y] + '</b> tiene <br><b>' + this.point.value + '</b> casos en el estatus <br><b>' + this.series.xAxis.categories[this.point.x] + '</b>';
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
                    'data' => new SeriesDataHelper($valores,['1:int','0:int','2:int']),
                    'color' => '#000000',
                    'dataLabels' => [
                            'enabled' => true,
                            'color' => '#000000'

                        ]
                    ]
            ]
    ]

]);

?>
