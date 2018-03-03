<?php
use yii\data\ActiveDataProvider;
use app\models\solicitudes;
use yii\grid\GridView;
use yii\db\Query;

    $query = new Query;
    $columna = ["usuario_asignacion_id", "estatus", "count(*) as Total"];
    $sql = $query
            ->select($columna)
            ->from('solicitudes')
            ->where(['extract(year from created_at)' => 2018])
            ->groupBy([$columna[0], $columna[1]])
            ->orderBy($columna[0]);













    $solicitudes = new ActiveDataProvider([
        'query' => $sql,
    ]);

    //Imprimo la Informacion del Gridview
    echo GridView::widget([
        'dataProvider' => $solicitudes,
    ]);


echo "select usuario_asignacion_id, estatus, count(*) from solicitudes where extract(year from created_at)=2018 group by usuario_asignacion_id, estatus order by usuario_asignacion_id, estatus";

/***

Página para consulta
http://www.innoforma.com/Blog/Software/Sql-Server/Creacion-de-informes-de-referencias-cruzadas-El-Operador-PIVOT

***/

?>
