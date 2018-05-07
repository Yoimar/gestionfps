<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use miloschuman\highcharts\SeriesDataHelper;
use app\models\Solicitudes;

/* @var $this yii\web\View */
$this->title = 'Cuadro de Mando';

$stylecabecera = 'style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;"';

$styleceldas = 'style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;"';

$tablasconjoin = ' gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id '
			    .' join estatus2 e2 on e3.estatus2_id = e2.id '
				.' join estatus1 e1 on e2.estatus1_id = e1.id '
				.' join solicitudes s1 on s1.id = g1.solicitud_id ';
$tablasconsolicitudes = ' solicitudes s1 ';

$tablasconjoinpresupuesto = ' gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id '
						   .' join estatus2 e2 on e3.estatus2_id = e2.id '
						   .' join estatus1 e1 on e2.estatus1_id = e1.id '
						   .' join solicitudes s1 on s1.id = g1.solicitud_id '
						   .' join presupuestos p1 on p1.solicitud_id = s1.id ';

$sqlforgestion = ' gestion g1 join solicitudes s1 on s1.id = g1.solicitud_id full outer join users u1 on s1.usuario_asignacion_id = u1.id join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id ';
$sqlforingreso = ' solicitudes s1 ';

$anos = array(
	($model->ano-1),
	$model->ano,
	"Total");

$meses = array(
	(date("m")-1),
	+(date("m")),
	"Total");
$mesnombre = array(
	'1' => "Enero",
	'2' => "Febrero",
	'3' => "Marzo",
	'4' => "Abril",
	'5' => "Mayo",
	'6' => "Junio",
	'7' => "Julio",
	'8' => "Agosto",
	'9' => "Septiembre",
	'10' => "Octubre",
	'11' => "Noviembre",
	'12' => "Diciembre",
	"Total");
$estructura = array(
	'0201',
	'0202',
	'0203',
	'0204',
	"Total");
$partida = array(
	'407010201',
	'407010401',
	'407010201',
	'407010401',
	"Total");
?>

<div class="row" style="font-size: 1em;" >
	<div class="col-lg-12">
		<div class="box">
<div class="box-header">
	<h3>
		<?= $this->title ?> - Año <?= $model->ano ?>
        <small><p id="reloj" name="reloj" style="float:right; padding-top: 10px;"></p></small>
	</h3>
</div>
<div class="box-body">
	<div class="row">
		<div class="col-xs-12">
			<div>
				<table class="table table-bordered table-hover table-striped table-condensed">
<thead>
    <tr>
        <th <?= $stylecabecera ?>>Año</th>
        <th <?= $stylecabecera ?>>Ingres.</th>
        <th <?= $stylecabecera ?>>Casos</th>
        <th <?= $stylecabecera ?>>Casos Pendi</th>
        <th <?= $stylecabecera ?>>P/APR Eco</th>
        <th <?= $stylecabecera ?> width="200" nowrap>Monto Económico</th>
        <th <?= $stylecabecera ?>>P/APR Sal</th>
        <th <?= $stylecabecera ?> width="200" nowrap>Monto Salud</th>
    </tr>
</thead>
<tbody>
	<?php for ($i = 0; $i < 2; $i ++) : ?>
    <?php
    if (is_numeric($anos[$i])){
        $filtroano = $anos[$i];
    } else {
        $filtroano = "";
    }
    ?>

		<tr style="vertical-align:middle;">
			<td style="margin: 0; vertical-align:middle; text-align:center;"><?= $anos[$i];?></td>
                            <td class="danger" style="text-align:center; vertical-align:middle;"><p  style="margin: 0; vertical-align:middle; text-align:center;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforingreso."  where extract(year from s1.created_at) = ".$filtroano)->queryscalar();?></p></td>
				<td style="text-align:center; vertical-align:middle;" class="info"><p  style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where   extract(year from s1.created_at) = ".$filtroano)->queryscalar();?></p></td>
				<td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 1 and extract(year from s1.created_at) = ".$filtroano)->queryscalar();?></p></td>
				<td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e3.id = 11 and extract(year from s1.created_at) = ".$filtroano)->queryscalar();?></p></td>
				<td style="text-align:right; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->formatter->asCurrency(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where  e3.id = 11 and extract(year from s1.created_at) = ".$filtroano)->queryscalar());?></p></td>
				<td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e3.id = 10 and extract(year from s1.created_at) = ".$filtroano)->queryscalar();?></p></td>
				<td style="text-align:right; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->formatter->asCurrency(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where  e3.id = 10 and extract(year from s1.created_at) = ".$filtroano)->queryscalar());?></p></td>

		</tr>
	<?php endfor; ?>
                <tr style="vertical-align:middle;">
    <?php
        $filtroano = " (extract(year from s1.created_at) = ".($model->ano-1)." or extract(year from s1.created_at) = ".$model->ano.")";
    ?>


                    <td style="vertical-align:middle; text-align:center; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger">Total</td>
                    <td <?= $styleceldas ?>><p  style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  " . $tablasconsolicitudes . " where ".$filtroano)->queryscalar(); ?></p></td>
                    <td <?= $styleceldas ?> class="danger totaltabla"><p  style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from " . $tablasconjoin . "  where  " .$filtroano)->queryscalar(); ?></p></td>
                    <td <?= $styleceldas ?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from " . $tablasconjoin . "  where  e1.id = 1 and " .$filtroano)->queryscalar(); ?></p></td>
                    <td <?= $styleceldas ?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from " . $tablasconjoin . "  where  e3.id = 11 and " .$filtroano)->queryscalar(); ?></p></td>
                    <td style="text-align:right; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->formatter->asCurrency(Yii::$app->db->createCommand("select sum(p1.montoapr) from " . $tablasconjoinpresupuesto . " where  e3.id = 11 and " .$filtroano)->queryscalar()); ?></p></td>
                    <td <?= $styleceldas ?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from " . $tablasconjoin . "  where  e3.id = 10 and " .$filtroano)->queryscalar(); ?></p></td>
                    <td style="text-align:right; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->formatter->asCurrency(Yii::$app->db->createCommand("select sum(p1.montoapr) from " . $tablasconjoinpresupuesto . " where  e3.id = 10 and " .$filtroano)->queryscalar()); ?></p></td>
                </tr>
</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
		</div>
	</div>
</div>

<!-- Para cuadro de meses-->

<div class="row" style="font-size: 1em;" >
	<div class="col-lg-12">
		<div class="box">
<div class="box-header">
	<h3>
		<?= $this->title ?> - Ultimos Meses <?= $model->ano ?>
	</h3>
</div>
<div class="box-body">
	<div class="row">
		<div class="col-xs-12">
			<div>
				<table class="table table-bordered table-hover table-striped table-condensed">
<thead>
    <tr>
        <th <?= $stylecabecera ?>>Mes</th>
        <th <?= $stylecabecera ?>>Ingres.</th>
        <th <?= $stylecabecera ?>>Casos</th>
        <th <?= $stylecabecera ?>>Casos Pendi</th>
        <th <?= $stylecabecera ?>>P/APR Eco</th>
        <th <?= $stylecabecera ?> width="200" nowrap>Monto Económico</th>
        <th <?= $stylecabecera ?>>P/APR Sal</th>
        <th <?= $stylecabecera ?> width="200" nowrap>Monto Salud</th>
    </tr>
</thead>
<tbody>
	<?php for ($i = 0; $i < 2; $i ++) : ?>
    <?php
    if (is_numeric($meses[$i])){
        $filtroano = $meses[$i];
    } else {
        $filtroano = "";
    }
    ?>

		<tr style="vertical-align:middle;">
			<td style="margin: 0; vertical-align:middle; text-align:center;"><?= $mesnombre[$meses[$i]];?></td>
                            <td class="danger" style="text-align:center; vertical-align:middle;"><p  style="margin: 0; vertical-align:middle; text-align:center;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforingreso."  where extract(year from s1.created_at) = ".$model->ano." and extract(month from s1.created_at) = ".$filtroano)->queryscalar();?></p></td>
				<td style="text-align:center; vertical-align:middle;" class="info"><p  style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where   extract(year from s1.created_at) = ".$model->ano." and extract(month from s1.created_at) = ".$filtroano)->queryscalar();?></p></td>
				<td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 1 and extract(year from s1.created_at) = ".$model->ano." and extract(month from s1.created_at) = ".$filtroano)->queryscalar();?></p></td>
				<td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e3.id = 11 and extract(year from s1.created_at) = ".$model->ano." and extract(month from s1.created_at) = ".$filtroano)->queryscalar();?></p></td>
				<td style="text-align:right; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->formatter->asCurrency(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where  e3.id = 11 and extract(year from s1.created_at) = ".$model->ano." and extract(month from s1.created_at) = ".$filtroano)->queryscalar());?></p></td>
				<td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e3.id = 10 and extract(year from s1.created_at) = ".$model->ano." and extract(month from s1.created_at) = ".$filtroano)->queryscalar();?></p></td>
				<td style="text-align:right; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->formatter->asCurrency(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where  e3.id = 10 and extract(year from s1.created_at) = ".$model->ano." and extract(month from s1.created_at) = ".$filtroano)->queryscalar());?></p></td>

		</tr>
	<?php endfor; ?>
                <tr style="vertical-align:middle;">
    <?php
        $filtroano = " extract(year from s1.created_at) = ".($model->ano)." and (extract(month from s1.created_at) = ".(date('m')-1)." or extract(month from s1.created_at) = ".(date('m')-0).")";
    ?>


                    <td style="vertical-align:middle; text-align:center; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger">Total</td>
                    <td <?= $styleceldas ?>><p  style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  " . $tablasconsolicitudes . " where ".$filtroano)->queryscalar(); ?></p></td>
                    <td <?= $styleceldas ?> class="danger totaltabla"><p  style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from " . $tablasconjoin . "  where  " .$filtroano)->queryscalar(); ?></p></td>
                    <td <?= $styleceldas ?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from " . $tablasconjoin . "  where  e1.id = 1 and " .$filtroano)->queryscalar(); ?></p></td>
                    <td <?= $styleceldas ?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from " . $tablasconjoin . "  where  e3.id = 11 and " .$filtroano)->queryscalar(); ?></p></td>
                    <td style="text-align:right; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->formatter->asCurrency(Yii::$app->db->createCommand("select sum(p1.montoapr) from " . $tablasconjoinpresupuesto . " where  e3.id = 11 and " .$filtroano)->queryscalar()); ?></p></td>
                    <td <?= $styleceldas ?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from " . $tablasconjoin . "  where  e3.id = 10 and " .$filtroano)->queryscalar(); ?></p></td>
                    <td style="text-align:right; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->formatter->asCurrency(Yii::$app->db->createCommand("select sum(p1.montoapr) from " . $tablasconjoinpresupuesto . " where  e3.id = 10 and " .$filtroano)->queryscalar()); ?></p></td>
                </tr>
</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
		</div>
	</div>
</div>

<div class="row" style="font-size: 1em;" >
	<div class="col-lg-12">
		<div class="box">
<div class="box-header">
	<h3>
		Gestión Administrativa <?= $model->ano ?>
	</h3>
</div>
<div class="box-body">
	<div class="row">
		<div class="col-lg-12">
			<div>
<?php

$estatus3= Yii::$app->db->createCommand("select e3.nombre from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id where e2.id = 18 group by e3.nombre")->queryAll();

$k=0;
for ($j = 0; $j < count($estatus3); $j++)
    {
        $sql="select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id where e3.nombre = '". $estatus3[$j]['nombre']."'";
        $valoresdata1[$k]['name']= $estatus3[$j]['nombre'];
        $valoresdata1[$k]['y']= Yii::$app->db->createCommand($sql)->queryscalar();// Su valor;
        $valoresdata1[$k]['drilldown']= $estatus3[$j]['nombre'];

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

            'title' => ['text' => 'ESTATUS DE LOS CASOS EN ADMINISTRACIÓN'],
            'chart' => [
                    'type' => 'column',
                    'height' => 300,
            ],
            'xAxis' => [
                'type' => 'category',
                //'title' => ['text' => 'Eje X'],
            ],
            'yAxis' => [
                    'title' => ['text' => ''],
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

?>
			</div>
		</div>
	</div>
</div>
		</div>
	</div>
</div>
<div class="row" style="font-size: 1em;" >
	<div class="col-lg-12">
		<div class="box">
<div class="box-header">
	<h3>
		Disponibilidad Presupuestaria
	</h3>
</div>
<div class="box-body">
	<div class="row">
		<div class="col-xs-12">
			<div>
				<table class="table table-bordered table-hover table-striped table-condensed">
<thead>
    <tr>
        <th <?= $stylecabecera ?>>Accion</th>
        <th <?= $stylecabecera ?>>Partida</th>
        <th <?= $stylecabecera ?>>Programado</th>
        <th <?= $stylecabecera ?>>Ejecutado</th>
        <th <?= $stylecabecera ?>>Disponible</th>
    </tr>
</thead>
<tbody>
	<?php
	$programadototal = 0;
	$ejecutadototal = 0;
	$disponibletotal = 0;
	for ($i = 0; $i < 4; $i ++) : ?>

		<?php
		/*** ***/
$sql = "SELECT CASE SUM(monto) WHEN NULL  THEN  0
ELSE SUM(monto)
END monto
FROM  spg_dt_cmp PCT, spg_operaciones O
WHERE PCT.operacion=O.operacion ";


$asignado[$i] = Yii::$app->dbsigesp->createCommand(
	$sql."and O.asignar=1
	and PCT.spg_cuenta like '%".$partida[$i]."%'
	and PCT.codestpro3 like '%".$estructura[$i]."%';"
	)->queryscalar();

$aumento[$i] = Yii::$app->dbsigesp->createCommand(
	$sql."and O.aumento=1
	and PCT.spg_cuenta like '%".$partida[$i]."%'
	and PCT.codestpro3 like '%".$estructura[$i]."%'"
	)->queryscalar();

$disminucion[$i] = Yii::$app->dbsigesp->createCommand(
	$sql."and O.disminucion=1
	and PCT.spg_cuenta like '%".$partida[$i]."%'
	and PCT.codestpro3 like '%".$estructura[$i]."%';"
	)->queryscalar();

$programado[$i] = $asignado[$i]+$aumento[$i]-$disminucion[$i];

$precomprometido[$i] = Yii::$app->dbsigesp->createCommand(
	$sql."and O.precomprometer=1
	and PCT.spg_cuenta like '%".$partida[$i]."%'
	and PCT.codestpro3 like '%".$estructura[$i]."%';"
	)->queryscalar();

$comprometido[$i] = Yii::$app->dbsigesp->createCommand(
	$sql."and O.comprometer=1
	and PCT.spg_cuenta like '%".$partida[$i]."%'
	and PCT.codestpro3 like '%".$estructura[$i]."%';"
	)->queryscalar();

$ejecutado[$i] = $precomprometido[$i] + $comprometido[$i];

$disponible[$i] = $programado[$i] - $ejecutado[$i];

$programadototal = $programadototal + $programado[$i];
$ejecutadototal = $ejecutadototal + $ejecutado[$i];
$disponibletotal = $disponibletotal + $disponible[$i];
?>

    <tr style="vertical-align:middle;">
            <td style="margin: 0; vertical-align:middle; text-align:center;"><?= $estructura[$i]; ?></td>
            <td style="text-align:center; vertical-align:middle;"><?= $partida[$i] ?></td>
            <td style="text-align:right; vertical-align:middle;"><?= Yii::$app->formatter->asCurrency($programado[$i]); ?></td>
            <td style="text-align:right; vertical-align:middle;"><?= Yii::$app->formatter->asCurrency($ejecutado[$i]); ?></td>
            <td style="text-align:right; vertical-align:middle;" class="info"><?= Yii::$app->formatter->asCurrency($disponible[$i]); ?></td>
        </tr>
	<?php endfor; ?>
        <tr style="vertical-align:middle;">
            <td colspan="2" style="vertical-align:middle; text-align:center; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger">Total</td>
            <td style="vertical-align:middle; text-align:right; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger totaltabla"><?= Yii::$app->formatter->asCurrency( $programadototal);?></td>
            <td style="vertical-align:middle; text-align:right; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger"><?= Yii::$app->formatter->asCurrency( $ejecutadototal);?></td>
            <td style="vertical-align:middle; text-align:right; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger"><?= Yii::$app->formatter->asCurrency( $disponibletotal);?></td>
        </tr>
</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
		</div>
	</div>
</div>
<div class="row" style="font-size: 1em;" >
	<div class="col-lg-12">
		<div class="box">
<div class="box-header">
	<h3>
		Cheques impresos en la Semana
	</h3>
</div>
<div class="box-body">
	<div class="row">
		<div class="col-lg-12">
			<div>
<?php


$f=date("Y-m-d");
for( $i = 7; $i > -1; $i-- ){
$fechas [] = date("Y-m-d", strtotime("$f   -$i day"));
}

$k=0;
for ($j = 0; $j < count($fechas); $j++)
    {
        $sql="select count(*) from cheque c1 where c1.date_cheque = '". $fechas[$j]."'";
        $valoresdata1[$k]['name']= $fechas[$j];
        $valoresdata1[$k]['y']= Yii::$app->db->createCommand($sql)->queryscalar();// Su valor;
        $valoresdata1[$k]['drilldown']= $fechas[$j];

    $k=$k + 1;

}

echo Highcharts::widget([

    'scripts' => [
        'modules/column',
        'modules/exporting',
        'themes/default',

    ],

    'options' => [

            'title' => ['text' => 'CHEQUES IMPRESOS EN LA SEMANA'],
            'chart' => [
                    'type' => 'column',
                    'height' => 300,
            ],
            'xAxis' => [
                'type' => 'category',
                //'title' => ['text' => 'Eje X'],
            ],
            'yAxis' => [
                    'title' => ['text' => ''],
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
                    'name' => 'Cheques',
                    'colorByPoint' => true,
                    'data' => new SeriesDataHelper($valoresdata1,['name','y:int','drilldown']),

                    ]
            ],



],

]);

?>
			</div>
		</div>
	</div>
</div>
		</div>
	</div>
</div>

<div class="row" style="font-size: 1em;" >
	<div class="col-lg-12">
		<div class="box">
<div class="box-header">
	<h3>
		Disponibilidad Financiera
	</h3>
</div>
<div class="box-body">
	<div class="row">
		<div class="col-xs-12">
			<div>
				<table class="table table-bordered table-hover table-striped table-condensed">
<thead>
    <tr>
        <th <?= $stylecabecera ?>>Cuenta</th>
        <th <?= $stylecabecera ?>>Denominación</th>
        <th <?= $stylecabecera ?>>Disponible</th>
    </tr>
</thead>
<tbody>
	<?php
	$programadototal = 0;
	$ejecutadototal = 0;
	$disponibletotal = 0;
	for ($i = 0; $i < 1; $i ++) : ?>

		<?php
		/*** ***/
$sql = "SELECT SUM(monto-monret) as monto
FROM scb_movbco
WHERE codban='008'
AND ctaban= '01020552210000060008' ";


$debito[$i] = Yii::$app->dbsigesp->createCommand(
	$sql." AND codope in ('CH', 'ND', 'RE')
	AND estmov = 'A';"
	)->queryscalar();

$debitoant[$i] = Yii::$app->dbsigesp->createCommand(
	$sql." AND codope in ('CH', 'ND', 'RE')
	AND estmov <> 'A';"
	)->queryscalar();

$credito[$i] = Yii::$app->dbsigesp->createCommand(
	$sql." AND codope in ('DP', 'NC')
	AND estmov = 'A';"
	)->queryscalar();

$creditoant[$i] = Yii::$app->dbsigesp->createCommand(
	$sql." AND codope in ('DP', 'ND')
	AND estmov <> 'A';"
	)->queryscalar();
$disponible[$i] = $debito[$i] - $debitoant[$i] - $credito[$i] + $creditoant[$i];
$disponibletotal = $disponibletotal + $disponible[$i];
?>

    <tr style="vertical-align:middle;">
            <td style="margin: 0; vertical-align:middle; text-align:center;"><?= $debito[$i]; ?></td>
            <td style="text-align:center; vertical-align:middle;"></td>
            <td style="text-align:right; vertical-align:middle;" class="info"><?= Yii::$app->formatter->asCurrency($disponible[$i]); ?></td>
        </tr>
	<?php endfor; ?>
        <tr style="vertical-align:middle;">
            <td colspan="2" style="vertical-align:middle; text-align:center; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger">Total</td>
            <td style="vertical-align:middle; text-align:right; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger"><?= Yii::$app->formatter->asCurrency( $disponibletotal);?></td>
        </tr>
</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
		</div>
	</div>
</div>
