<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

?>


<div class="row">
    <?= Html::img("@web/img/logo_fps.jpg", ["alt" => "Logo Fundación", "width" => "80 px", "class" => "pull-left"]) ?>
    <?= Html::img("@web/img/despacho.png", ["alt" => "Logo Fundación", "width" => "350 px", "class" => "pull-right"]) ?>
</div>
<h1 class="display-3">
    <?= "La solicitud con el numero  ".$consulta[0]['ndonacion']." del Sistema de la Fundación Pueblo Soberano tiene los Siguientes Presupuestos:<br>"; ?>
</h1>


<?php 

echo $consulta[0]['solicitud'];
echo "<br>";
echo $consulta[0]['solicitante'];
echo "<br>";
echo $consulta[0]['beneficiario'];
echo "<br>";
echo $consulta[0]['requerimiento'];
echo "<br>";
echo $consulta[0]['tipoayuda'];
echo "<br>";
echo $consulta[0]['area'];
echo "<br>";
echo $consulta[0]['necesidad'];
echo "<br>";
echo $consulta[0]['descripcion'];


?>


<?php 
$index = $numero;
Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'montoapr',
//           'rif',
//            'req',
//            'codestpre',
            // 'cuenta',
            // 'date',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

//            [
//                'class' => 'yii\grid\ActionColumn',
//                'template' => '{inserta}',
//                'buttons' => [
//                    'inserta' => function($url, $model) {
//                        return Html::a(
//                                '<span class="glyphicon glyphicon-ok-sign"></span>SIGESP', 
//                                $url, 
//                                [
//                                    'title' => 'Enviar A SIGESP',
//                                ]
//                        );
//                    },    
//                ], 
//                'urlCreator' => function($action, $model, $key, $index){
//                        if ($action == 'inserta') {
//                            return \yii\helpers\Url::to(['sepsolicitud/inserta', 'id' => $key, 'numero' => $model->solicitud_id]);
//                        }
//                }
//            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
<center>
<?= Html::a('<span class="glyphicon glyphicon-ok-sign"></span>SIGESP', ['sepsolicitud/inserta', 'numero' => $numero], ['class' => 'btn btn-primary']) ?>
<?= Html::a('Imprimir', ['sepsolicitud/imprimir', 'numero' => $numero], ['class' => 'btn btn-success']) ?>
</center>
<div class="row"><table class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="border: solid 2px black; text-align:justify; margin: 0px; padding: 2px; font-size:12px;">
<tr><td class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="border: solid 2px black; margin: 0px; padding: 2px; font-size:12px; background:#d8d8d8;">
<strong>6- Presentado por: Dirección de Bienestar Social</strong></td>
<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="border: solid 2px black; margin: 0px; padding: 2px; font-size:12px; background:#d8d8d8;">
<strong>7- Revisado por: Unidad de Presupuesto</strong></td>
<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="border: solid 2px black; margin: 0px; padding: 2px; font-size:12px; background:#d8d8d8;">
<strong>8- Aprobado por: Unidad de Contabilidad</strong></td></tr><tr>
<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="border: solid 2px black; margin: 0px; padding: 2px; font-size:12px;">
<br><br>________________________________<br>Cap. Rafael Ramón Tesorero Rodriguez</td>
<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="border: solid 2px black; margin: 0px; padding: 2px; font-size:12px;">
<br><br>________________________________<br>Lic. Lourdes Freites</td>
<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="border: solid 2px black; margin: 0px; padding: 2px; font-size:12px;">
<br><br>________________________________<br>Lic. Miley Carrillo</td></tr><tr>
<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border: solid 2px black; text-align:justify; margin: 0px; padding: 2px; font-size:12px;">
<strong>Fecha:</strong></td>
<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border: solid 2px black; text-align:justify; margin: 0px; padding: 2px; font-size:12px;">
<strong>Fecha:</strong></td>
<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border: solid 2px black; text-align:justify; margin: 0px; padding: 2px; font-size:12px;">
<strong>Fecha:</strong></td></tr></table></div><div class="row">
<table class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="border: solid 2px black; text-align:justify; margin: 0px; padding: 2px; font-size:12px;">
<tr><td class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="border: solid 2px black; margin: 0px; padding: 2px; font-size:12px; background:#d8d8d8;">
<strong>9- Aprobado por: Director de Administración y Finanzas</strong>
</td><td class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="border: solid 2px black; margin: 0px; padding: 2px; font-size:12px; background:#d8d8d8;">
<strong>10- Revisado por: Coordinador General</strong>
</td><td class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="border: solid 2px black; margin: 0px; padding: 2px; font-size:12px; background:#d8d8d8;">
<strong>11- Aprobado por: Presidente</strong></td></tr><tr>
<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="border: solid 2px black; margin: 0px; padding: 2px; font-size:12px;">
<br><br>________________________________<br>1er.TTe Miguel S. Castillo Pérez</td>
<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="border: solid 2px black; margin: 0px; padding: 2px; font-size:12px;">
<br><br>________________________________<br>Cap. Rafael Ramón Tesorero Rodriguez</td>
<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="border: solid 2px black; margin: 0px; padding: 2px; font-size:12px;">
<br><br>________________________________<br>My. José Holberg Zambrano González</td></tr><tr>
<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border: solid 2px black; text-align:justify; margin: 0px; padding: 2px; font-size:12px;">
<strong>Fecha:</strong></td>
<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border: solid 2px black; text-align:justify; margin: 0px; padding: 2px; font-size:12px;">
<strong>Fecha:</strong></td>
<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border: solid 2px black; text-align:justify; margin: 0px; padding: 2px; font-size:12px;">
<strong>Fecha:</strong></td></tr></table></div>

