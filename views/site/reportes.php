<?php
use yii\data\ActiveDataProvider;
use kartik\grid\GridView;

    //Imprimo la Informacion del Gridview
    echo GridView::widget([
        'dataProvider' => $solicitudes,
        'columns' => $pruebas, 
        'showPageSummary' => true,
    ]);
echo "<pre>";
print_r($pruebas);
echo "</pre>";
?>
