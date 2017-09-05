<?php
$consulta = Yii::$app->db->createCommand("select * from crosstab (
'select u1.nombre, s1.estatus, count(*) from solicitudes s1 full outer join users u1 on s1.usuario_asignacion_id = u1.id where extract(year from s1.created_at)=2017 group by u1.nombre, s1.estatus order by u1.nombre, s1.estatus',
'select estatus from solicitudes group by estatus order by estatus'
)as
(Trabajador character varying(100), ACA character varying(3), ANU character varying(3), APR character varying(3), ART character varying(3), DEV character varying(3), EAA character varying(3), ELA character varying(3), ELD character varying(3),PPA character varying(3))")->queryAll();
?>

<pre> 
    
<?php 
$data = [[0, 0, 10], [0, 1, 19], [0, 2, 8], [0, 3, 24], [0, 4, 67], [1, 0, 92], [1, 1, 58], [1, 2, 78], [1, 3, 117], [1, 4, 48], [2, 0, 35], [2, 1, 15], [2, 2, 123], [2, 3, 64], [2, 4, 52], [3, 0, 72], [3, 1, 132], [3, 2, 114], [3, 3, 19], [3, 4, 16], [4, 0, 38], [4, 1, 5], [4, 2, 8], [4, 3, 117], [4, 4, 115], [5, 0, 88], [5, 1, 32], [5, 2, 12], [5, 3, 6], [5, 4, 120], [6, 0, 13], [6, 1, 44], [6, 2, 88], [6, 3, 98], [6, 4, 96], [7, 0, 31], [7, 1, 1], [7, 2, 82], [7, 3, 32], [7, 4, 30], [8, 0, 85], [8, 1, 97], [8, 2, 123], [8, 3, 64], [8, 4, 84], [9, 0, 47], [9, 1, 114], [9, 2, 31], [9, 3, 48], [9, 4, 91]];
$trabajadorescolumnas= Yii::$app->db->createCommand("select u1.nombre from solicitudes s1 full outer join users u1 on s1.usuario_asignacion_id = u1.id where extract(year from s1.created_at)=2017 group by u1.nombre order by u1.nombre")->queryAll();
$estatusfilas= Yii::$app->db->createCommand("select s1.estatus from solicitudes s1 full outer join users u1 on s1.usuario_asignacion_id = u1.id where extract(year from s1.created_at)=2017 group by s1.estatus order by s1.estatus")->queryAll();

$k=0;
for ($i = 0; $i < count($trabajadorescolumnas); $i++)
{
    
    for ($j = 0; $j < count($estatusfilas); $j++)
    {
        $sql="select count(*) from solicitudes s1 full outer join users u1 on s1.usuario_asignacion_id = u1.id where extract(year from s1.created_at)=2017 and u1.nombre = '". $trabajadorescolumnas[$i]['nombre'] ."' and s1.estatus = '". $estatusfilas[$j]['estatus']."'";
        $valores[$k][0]= $i;
        $valores[$k][1]= $j;
        $valores[$k][2]= Yii::$app->db->createCommand($sql)->queryscalar();// Su valor
        
    $k=$k + 1;    
        
    }
    
    
}   
//print_r($estatusfilas);
//print_r($trabajadorescolumnas);
print_r($data);
print_r($valores);


?>
</pre>

