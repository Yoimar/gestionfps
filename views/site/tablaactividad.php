<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Programaevento;
use app\models\Trabajador;
use app\models\Estados;
use app\models\Parroquias;
use app\models\Municipios;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Estatus1;
use app\models\Estatus2;
use app\models\Estatus3;


$modelactividad = Programaevento::findOne($model->actividad);
$modeltrabajador = Trabajador::findOne($modelactividad->trabajadoracargo_id);

if (isset($modelactividad->parroquia_id)) {
    $parroquia = Parroquias::findOne($modelactividad->parroquia_id);
    $municipio = Municipios::findOne($parroquia->municipio_id);
	$estado = Estados::findOne($municipio->estado_id);
}
/* @var $this yii\web\View */

$this->title = "Reporte General";

$stylecabecera = 'style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;"';

$styleceldas = '"text-align:center; vertical-align:middle; font-weight: bold; font-size: 1.1em; background-color: #585858; color: white;"';

$tablasconjoin = ' gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id '
			    .' join estatus2 e2 on e3.estatus2_id = e2.id '
				.' join estatus1 e1 on e2.estatus1_id = e1.id '
				.' join solicitudes s1 on s1.id = g1.solicitud_id ';

$tablasconjoinpresupuesto = ' gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id '
						   .' join estatus2 e2 on e3.estatus2_id = e2.id '
						   .' join estatus1 e1 on e2.estatus1_id = e1.id '
						   .' join solicitudes s1 on s1.id = g1.solicitud_id '
						   .' join presupuestos p1 on p1.solicitud_id = s1.id ';

?>
<div class="row" style="font-size: 1em;" >
	<div class="col-lg-12">
		<div class="box">
<div class="box-header">
	<center>
	<h3>
		<?= $modelactividad->descripcion ?>
	</h3>

	<div class="col-lg-4">
	<h5>
		Personal a Cargo de la Actividad: <?= isset($modeltrabajador->Trabajadorfps)?$modeltrabajador->Trabajadorfps:""; ?>
	</h5>
	</div>

	<div class="col-lg-4">
	<h5>
		Fecha de la Actividad: <?= Yii::$app->formatter->asDate($modelactividad->fechaprograma,"php:d/m/Y") ?>
	</h5>
	</div>

	<div class="col-lg-4">
	<h5>
		Estado: <?= isset($estado->nombre)?$estado->nombre:"" ?>
	</h5>
	</div>
	</center>
</div>
<div class="box-body">
	<div class="row">
		<div class="col-xs-12">
			<div>
				<table class="table table-bordered table-hover table-striped table-condensed">
<thead>
    <tr>
        <!-- <th <?= $stylecabecera ?>></th> -->
        <th <?= $stylecabecera ?>>Casos</th>
        <th <?= $stylecabecera ?>>Casos Resue</th>
        <th <?= $stylecabecera ?>>Casos ArtRe</th>
        <th <?= $stylecabecera ?>>Casos Artic</th>
        <th <?= $stylecabecera ?>>Casos Anula</th>
        <th <?= $stylecabecera ?>>Casos Pendi</th>
        <th <?= $stylecabecera ?>>Art Tram</th>
        <th <?= $stylecabecera ?>>Sin Comun</th>
        <th <?= $stylecabecera ?>>Por Llama</th>
        <th <?= $stylecabecera ?>>Por Recau</th>
        <th <?= $stylecabecera ?>>Por Conve</th>
        <th <?= $stylecabecera ?>>Por Conso</th>
        <th <?= $stylecabecera ?>>P/APR Eco</th>
        <th <?= $stylecabecera ?> width="200" nowrap>Monto Económico</th>
        <th <?= $stylecabecera ?>>P/APR Sal</th>
        <th <?= $stylecabecera ?> width="200" nowrap>Monto Salud</th>
    </tr>
</thead>
<tbody>
		<tr>
			<!-- <td></td> -->
				<td style="text-align:center" class="info"><p  style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  g1.programaevento_id = ".$model->actividad )->queryscalar();?></p></td>
				<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 2 and e2.id <> 15 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
				<td style="text-align:center" class="info"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 2 and e2.id = 15 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
				<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 4 and g1.programaevento_id = ".$model->actividad )->queryscalar();?></p></td>
				<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 3 and g1.programaevento_id = ".$model->actividad )->queryscalar();?></p></td>
				<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 1 and g1.programaevento_id = ".$model->actividad )->queryscalar();?></p></td>
				<td style="text-align:center" class="info"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 14 and g1.programaevento_id = ".$model->actividad )->queryscalar();?></p></td>
				<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 9 and g1.programaevento_id = ".$model->actividad )->queryscalar();?></p></td>
				<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 1 and g1.programaevento_id = ".$model->actividad )->queryscalar();?></p></td>
				<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 2 and g1.programaevento_id = ".$model->actividad )->queryscalar();?></p></td>
				<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 7 and g1.programaevento_id = ".$model->actividad )->queryscalar();?></p></td>
                                                                <td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 3 and g1.programaevento_id = ".$model->actividad )->queryscalar();?></p></td>
				<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e3.id = 11 and g1.programaevento_id = ".$model->actividad )->queryscalar();?></p></td>
				<td style="text-align:right"><p style="margin: 0;"><?= Yii::$app->formatter->asCurrency(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where  e3.id = 11 and g1.programaevento_id = ".$model->actividad )->queryscalar());?></p></td>
				<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e3.id = 10 and g1.programaevento_id = ".$model->actividad )->queryscalar();?></p></td>
				<td style="text-align:right"><p style="margin: 0;"><?= Yii::$app->formatter->asCurrency(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where  e3.id = 10 and g1.programaevento_id = ".$model->actividad )->queryscalar());?></p></td>
		</tr>
		<!--
    	<tr>
                <td style="vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger">Total</td>
				<td style=<?= $styleceldas?> class="danger totaltabla"><p  style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 2 and e2.id <> 15 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 2 and e2.id = 15 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 4 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 3 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 1 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 14 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 9 and g1.programaevento_id = ".$model->actividad )->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 1 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 2 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 7 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
                <td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 3 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e3.id = 11 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
				<td style="text-align:right; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->formatter->asCurrency(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where  e3.id = 11 and g1.programaevento_id = ".$model->actividad )->queryscalar());?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e3.id = 10 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
                <td style="text-align:right; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->formatter->asCurrency(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where  e3.id = 10 and g1.programaevento_id = ".$model->actividad )->queryscalar());?></p></td>
		</tr>
	-->
</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
		</div>
	</div>
</div>

<?php

$trabajadorescolumnas= Yii::$app->db->createCommand("select u1.nombre from solicitudes s1 "
                    ."full outer join users u1 on s1.usuario_asignacion_id = u1.id "
                    ."join gestion g1 on s1.id = g1.solicitud_id "
                    ."where g1.programaevento_id = ".$model->actividad
                    ."group by u1.nombre order by u1.nombre")->queryAll();
//Convierto todos los trabajadores en un array pd. se que hay otra forma pero no me acuerdo Tiene que ver con el asArray()
foreach ($trabajadorescolumnas as $val) {
    if ($val['nombre']==null){
        $trabajadores[]=null;
    }else{
        $trabajadores[]=$val['nombre'];
    }
 }
//Si los trabajadores estan vacios le coloco null para ver que carga
 if (empty($trabajadores)){
     $trabajadores[]=null;
 }

$stylecabecera = '"text-align:center; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;"';

$tablasforsql = 'gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id ';
$sqlforgestion = ' gestion g1 join solicitudes s1 on s1.id = g1.solicitud_id full outer join users u1 on s1.usuario_asignacion_id = u1.id join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id ';

?>
<div class="row" style="font-size: 1em;" >
	<div class="col-lg-12">
		<div class="box">
<div class="box-header">
	<h3>
		Casos por Trabajador Social
	</h3>
</div>
<div class="box-body">
	<div class="row">
		<div class="col-xs-12">
			<div>
				<table class="table table-bordered table-hover table-striped table-condensed">
<thead>
<tr>
        <th style="vertical-align:middle; font-weight: bold; font-size: 1.2em; background-color: #585858; color: white;" width="200" nowrap>Trabajador</th>
		<th style=<?= $stylecabecera ?>>Casos</th>
        <th style=<?= $stylecabecera ?>>Casos Resue</th>
		<th style=<?= $stylecabecera ?>>Casos Artic</th>
		<th style=<?= $stylecabecera ?>>Casos Anula</th>
		<th style=<?= $stylecabecera ?>>Casos Pendi</th>
		<th style=<?= $stylecabecera ?>>Sin Comun</th>
		<th style=<?= $stylecabecera ?>>Por Llama</th>
        <th style=<?= $stylecabecera ?>>Por Recau</th>
        <th style=<?= $stylecabecera ?>>Por Conve</th>
        <th style=<?= $stylecabecera ?>>Por Conso</th>
		<th style=<?= $stylecabecera ?>>P/APR Eco</th>
		<th style=<?= $stylecabecera ?>>P/APR Sal</th>
        <th style=<?= $stylecabecera ?>>En Admin</th>

	</tr>
</thead>

<tbody>
<?php for ($i = 0; $i < count($trabajadores); $i ++) : ?>
	<tr style="text-align:center">
		<td style="text-align:left"><?= $trabajadores[$i];?></td>
            <?php
            if ($trabajadores[$i] == null) {
                $filtrotrabajador = " is null ";
            }else{
                $filtrotrabajador = " = '". $trabajadores[$i] ."'";
            }
            ?>
			<td class="info"><p  style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforgestion."  where u1.nombre ".$filtrotrabajador." and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
			<td><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforgestion."  where u1.nombre ".$filtrotrabajador." and e1.id = 2 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
			<td><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforgestion."  where u1.nombre ".$filtrotrabajador." and e1.id = 4 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
			<td><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforgestion."  where u1.nombre ".$filtrotrabajador." and e1.id = 3 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
			<td><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforgestion."  where u1.nombre ".$filtrotrabajador." and e1.id = 1 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
			<td><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforgestion."  where u1.nombre ".$filtrotrabajador." and e2.nombre = 'Sin Comunicación' and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
			<td><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforgestion."  where u1.nombre ".$filtrotrabajador." and e2.nombre = 'Por Llamar' and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
			<td><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforgestion."  where u1.nombre ".$filtrotrabajador." and e2.nombre = 'Por Recaudos' and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
			<td><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforgestion."  where u1.nombre ".$filtrotrabajador." and e2.nombre = 'Por Convenio' and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
            <td><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforgestion."  where u1.nombre ".$filtrotrabajador." and e2.nombre = 'Por Consulta' and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
			<td><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforgestion."  where u1.nombre ".$filtrotrabajador." and e3.nombre = 'Ecónomico' and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
			<td><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforgestion."  where u1.nombre ".$filtrotrabajador." and e3.nombre = 'Salud' and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
			<td><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforgestion."  where u1.nombre ".$filtrotrabajador." and e2.nombre = 'EN ADMINISTRACIÓN' and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>

	</tr>
<?php endfor; ?>
    <tr style="text-align:center; vertical-align:middle; font-weight: bold; background-color: #585858; color: white;">
            <td style="text-align:left; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger">Total</td>
			<td style="font-size: 1em; background-color: #585858; color: white;" class="danger totaltabla"><p  style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$tablasforsql." where g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
			<td style="font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$tablasforsql."  where e1.id = 2 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
			<td style="font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$tablasforsql."  where e1.id = 4 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
			<td style="font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$tablasforsql."  where e1.id = 3 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
			<td style="font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$tablasforsql."  where e1.id = 1 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
			<td style="font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$tablasforsql."  where e2.id = 9 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
			<td style="font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$tablasforsql."  where e2.id = 1 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
			<td style="font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$tablasforsql."  where e2.id = 2 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
			<td style="font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$tablasforsql."  where e2.id = 7 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
            <td style="font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$tablasforsql."  where e2.id = 3 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
			<td style="font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$tablasforsql."  where e3.id = 11 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
			<td style="font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$tablasforsql."  where e3.id = 10 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>
			<td style="font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$tablasforsql."  where e2.id = 18 and g1.programaevento_id = ".$model->actividad)->queryscalar();?></p></td>

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
<?php 

$defaultExportConfig = [
    GridView::HTML => [
        'label' => 'HTML',
        'iconOptions' => ['class' => 'text-info'],
        'showHeader' => true,
        'showPageSummary' => true,
        'showFooter' => true,
        'showCaption' => true,
        'filename' => 'grid-export',
        'alertMsg' => 'The HTML export file will be generated for download.',
        'options' => ['title' => 'Hyper Text Markup Language'],
        'mime' => 'text/html',
        'config' => [
            'cssFile' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'
        ]
    ],
    GridView::CSV => [
        'label' => 'CSV',
        'iconOptions' => ['class' => 'text-primary'],
        'showHeader' => true,
        'showPageSummary' => true,
        'showFooter' => true,
        'showCaption' => true,
        'filename' => 'grid-export',
        'alertMsg' => 'The CSV export file will be generated for download.',
        'options' => ['title' => 'Comma Separated Values'],
        'mime' => 'application/csv',
        'config' => [
            'colDelimiter' => ",",
            'rowDelimiter' => "\r\n",
        ]
    ],
    GridView::TEXT => [
        'label' => 'Text',
        'iconOptions' => ['class' => 'text-muted'],
        'showHeader' => true,
        'showPageSummary' => true,
        'showFooter' => true,
        'showCaption' => true,
        'filename' => 'grid-export',
        'alertMsg' => 'The TEXT export file will be generated for download.',
        'options' => ['title' => 'Tab Delimited Text'],
        'mime' => 'text/plain',
        'config' => [
            'colDelimiter' => "\t",
            'rowDelimiter' => "\r\n",
        ]
    ],
    GridView::EXCEL => [
        'label' => 'Excel',
        'iconOptions' => ['class' => 'text-success'],
        'showHeader' => true,
        'showPageSummary' => true,
        'showFooter' => true,
        'showCaption' => true,
        'filename' => 'Gestiones',
        'alertMsg' => 'The EXCEL export file will be generated for download.',
        'options' => ['title' => 'Microsoft Excel 95+'],
        'mime' => 'application/vnd.ms-excel',
        'config' => [
            'worksheet' => 'ExportWorksheet',
            'cssFile' => ''
        ]
    ],
    GridView::PDF => [
        'label' => 'PDF',
        'iconOptions' => ['class' => 'text-danger'],
        'showHeader' => true,
        'showPageSummary' => true,
        'showFooter' => true,
        'showCaption' => true,
        'filename' => 'Gestiones',
        'alertMsg' => 'El Reporte de Gestiones será generado',
        'options' => ['title' => 'Portable Document Format'],
        'mime' => 'application/pdf',
        'config' => [
            'mode' => 'c',
            'format' => 'Letter',
            'destination' => 'I',
            'orientation' => 'L',
            'marginTop' => 35,
            'marginBottom' => 20,
            'cssInline' => '.kv-wrap{padding:20px;}' .
                '.kv-align-center{text-align:center;}' .
                '.kv-align-left{text-align:left;}' .
                '.kv-align-right{text-align:right;}' .
                '.kv-align-top{vertical-align:top!important;}' .
                '.kv-align-bottom{vertical-align:bottom!important;}' .
                '.kv-align-middle{vertical-align:middle!important;}' .
                '.kv-page-summary{border-top:4px double #ddd;font-weight: bold;}' .
                '.kv-table-footer{border-top:4px double #ddd;font-weight: bold;}' .
                '.kv-table-caption{font-size:0.5em;padding:0px;border:1px solid #ddd;border-bottom:none;}',
            'methods' => [
                'SetHeader'=>[''
                    .'<div class="row">'
                    .Html::img("@web/img/logo_fps.jpg", ["alt" => "Logo Fundación", "width" => "120", "class" => "pull-left"])
                    .Html::img("@web/img/despacho.png", ["alt" => "Despacho", "width" => "350", "style" =>"margin-top: 10px; margin-bottom: 10px;", "class" => "pull-right"])
                    . '<center class="text-center col-xs-12 col-sm-12 col-md-12 col-lg-12" style = "margin-top: 30px; margin-bottom: 0px;"><h2 style = "padding-top: 20px; margin-bottom: 0px;">Relación de Casos</h2></center>'
                    .'</div>'
                    . ''],
                'SetFooter'=>['{PAGENO}'],
            ],
            'options' => [
                'title' => $this->title,
                'subject' => 'PDF export generated by kartik-v/yii2-grid extension',
                'keywords' => 'krajee, grid, export, yii2-grid, pdf',
            ],
            'contentBefore'=>'',
            'contentAfter'=>''
        ]
    ],
    GridView::JSON => [
        'label' => 'JSON',
        'iconOptions' => ['class' => 'text-warning'],
        'showHeader' => true,
        'showPageSummary' => true,
        'showFooter' => true,
        'showCaption' => true,
        'filename' => 'grid-export',
        'alertMsg' => 'The JSON export file will be generated for download.',
        'options' => ['title' => 'JavaScript Object Notation'],
        'mime' => 'application/json',
        'config' => [
            'colHeads' => [],
            'slugColHeads' => false,
            'jsonReplacer' => null,
            'indentSpace' => 4
        ]
    ],
];

?>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'showPageSummary' => true,
        'exportConfig' => $defaultExportConfig,
        'panel' => [
	        'type' => GridView::TYPE_PRIMARY,
	        'heading' => 'Reporte de Solicitudes',
    	],
        'toolbar' =>  [
	        '{export}',
	        '{toggleData}',
	    ],
       	'export' => [
        	'fontAwesome' => true
    	],
        'pjax' => true, 
        'tableOptions' => ['class' => 'text-center',],
        //'layout' => "{items}\n{pager}",

        'options' => ['class' => 'text-center primary', 'style' => 'margin: 0px; padding: 2px;  font-size:12px; '],
        'headerRowOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:12px; background: #FFFFFF; '],
        'captionOptions' => ['class' => 'text-center', 'style' => 'color: black; margin: 0px; padding: 2px; font-size:16px;'],
        'footerRowOptions'=> ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  background: #FFFFFF;'],
        'rowOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; '],

        'columns' => [
            [
                'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:11px;'],
                'class'=>'kartik\grid\SerialColumn',
                'width'=>'10px',
                'hAlign'=>'center',
                'vAlign'=>'middle',
                'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:12px; '],
            ],
            [
            'attribute' => 'solicitud_id',
            'value' => 'solicitud.num_solicitud',
            'format' => 'text',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            ],

            [
            'attribute' => 'estatus1_id',
            'value' => 'estatus1_id',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            'format' => 'text',
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Estatus1::find()->orderBy('nombre')->all(), 'nombre', 'nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Estatus 1?'],
            ],
            [
            'attribute' => 'estatus2_id',
            'value' => 'estatus2_id',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            'format' => 'text',
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Estatus2::find()->orderBy('nombre')->all(), 'id', 'nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Estatus 2?'],
            ],
            [
            'attribute' => 'estatus3_id',
            'value' => 'estatus3.nombre',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            'format' => 'text',
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Estatus3::find()->orderBy('nombre')->all(), 'id', 'nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Estatus 3?'],
            ],
            /*
            [
            'attribute' => 'solicitante',
            'value' => 'solicitante',
            'format' => 'text',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            
            ],
            [
            'attribute' => 'cisolicitante',
            'value' => 'cisolicitante',
            'format' => 'text',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            
            ], */
            [
            'attribute' => 'beneficiario',
            'value' => 'beneficiario',
            'format' => 'text',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            ],
            [
            'attribute' => 'cibeneficiario',
            'value' => 'cibeneficiario',
            'format' => 'text',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            ],
            [
            'attribute' => 'tratamiento',
            'value' => 'tratamiento',
            'format' => 'text',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(app\models\Requerimientos::find()->orderBy('nombre')->all(), 'nombre', 'nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Tratamiento?'],
            ],

            [
            'class'=>'kartik\grid\BooleanColumn',
            'attribute' => 'nino',
            'vAlign'=>'middle',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            
            ],

            [
            'attribute' => 'trabajadorsocial',
            'value' => 'trabajadorsocial',
            'format' => 'text',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(app\models\Users::find()->where(['activated' => 'TRUE'])->orderBy('nombre')->all(), 'nombre', 'nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'¿Trabajador Social?'],
            ],

            [
            'attribute' => 'empresaoinstitucion',
            'value' => 'empresaoinstitucion',
            'vAlign'=>'middle',
            'hAlign'=>'center',
            'format' => 'text',
            ],
            
            [
            'headerOptions' => ['class' => 'text-center'],
            'attribute' => 'monto',
            'value' => 'monto',
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'100px',
            'format' => ['decimal', 2],
            'pageSummary'=>true,
            
            ],


        ],
        'responsive'=>true,
        'condensed'=>true,
        'bordered'=>true,



    ]); ?>

<br>
