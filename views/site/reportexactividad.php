<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Programaevento;
use app\models\Trabajador;
use app\models\Estados;
use app\models\Parroquias;
use app\models\Municipios;
use app\models\Origen; 
use app\models\Autoridad;
use app\models\Cargo;


/* @var $this yii\web\View */

$this->title = "Reporte General";

$stylecabecera = 'style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 0.9em; background-color: #585858; color: white;"';

$styleceldas = '"text-align:center; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;"';

$tablasconjoin = ' gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id '
			    .' join estatus2 e2 on e3.estatus2_id = e2.id '
				.' join estatus1 e1 on e2.estatus1_id = e1.id '
				.' join programaevento pe1 on pe1.id = g1.programaevento_id '
				.' join referencia r1 on r1.id = pe1.referencia_id '
				.' join parroquias pa1 on pe1.parroquia_id = pa1.id '
				.' join municipios mu1 on pa1.municipio_id = mu1.id '
				.' join solicitudes s1 on s1.id = g1.solicitud_id ';

$tablasconjoinpresupuesto = ' gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id '
						   	.' join estatus2 e2 on e3.estatus2_id = e2.id '
						   	.' join estatus1 e1 on e2.estatus1_id = e1.id '
						   	.' join solicitudes s1 on s1.id = g1.solicitud_id '
							.' join programaevento pe1 on pe1.id = g1.programaevento_id '
							.' join referencia r1 on r1.id = pe1.referencia_id '
							.' join parroquias pa1 on pe1.parroquia_id = pa1.id '
							.' join municipios mu1 on pa1.municipio_id = mu1.id '
						   	.' join presupuestos p1 on p1.solicitud_id = s1.id ';


$actividadessql = Programaevento::find()
				->select([
					'programaevento.id as id',
					'programaevento.descripcion as descripcion',
				])
				->joinWith('origen', true, 'LEFT JOIN')
				->joinWith('referencia', true, 'LEFT JOIN')
				->joinWith('gestions', true, 'LEFT JOIN')
				->joinWith('estado', true, 'LEFT JOIN')
				->andFilterWhere([
		            'extract(year from programaevento.fechaprograma)' => $model->ano,
		            'extract(month from programaevento.fechaprograma)' => $model->mes,
		            'origen.id' => $model->origen,
		            'referencia.autoridad_id' => $model->personalidad,
		            'referencia.cargo_id' => $model->cargo,
		            'estados.id' => $model->estado,
		            'programaevento.trabajadoracargo_id' => $model->trabajador,

		        ])
		        ->all();


$filtro = "";
$filtrogrande = "";
$titulo = "";

if (!empty($model->ano)){
	$filtro .= ' and extract(year from pe1.fechaprograma) = '.$model->ano; 
	$filtrogrande = ($filtrogrande=="")?" where extract(year from pe1.fechaprograma) = $model->ano":" and extract(year from pe1.fechaprograma) = $model->ano";
	$titulo .= " - Año: ".$model->ano;
}

if (!empty($model->mes)){
	$filtro .= ' and extract(month from pe1.fechaprograma) = '.$model->mes; 
	$filtrogrande = ($filtrogrande=="")?" where extract(month from pe1.fechaprograma) = $model->mes":" and extract(month from pe1.fechaprograma) = $model->mes";
	$titulo .= " - Mes: ".$model->mes;
}

if (!empty($model->origen)){
	$filtro .= ' and pe1.origenid = '.$model->origen; 
	$filtrogrande = ($filtrogrande=="")?" where pe1.origenid = $model->origen ":" and pe1.origenid = $model->origen ";
	$titulo .= " - Origen: ".Origen::findOne($model->origen)->nombre;
}

if (!empty($model->personalidad)){
	$filtro .= ' and r1.autoridad_id = '.$model->personalidad; 
	$filtrogrande = ($filtrogrande=="")?" where r1.autoridad_id = $model->personalidad ":" and r1.autoridad_id = $model->personalidad ";
	$titulo .= " - Personalidad: ".Autoridad::findOne($model->personalidad)->nombrecompleto;
}

if (!empty($model->cargo)){
	$filtro .= ' and pe1.origenid = '.$model->cargo; 
	$filtrogrande = ($filtrogrande=="")?" where r1.cargo_id = $model->cargo ":" and r1.cargo_id = $model->cargo ";
	$titulo .= " - Cargo: ".Cargo::findOne($model->cargo)->nombrecompleto;
}

if (!empty($model->estado)){
	$filtro .= ' and mu1.estado_id = '.$model->estado; 
	$filtrogrande = ($filtrogrande=="")?" where mu1.estado_id = $model->estado ":" and mu1.estado_id = $model->estado ";
	$titulo .= " - Estado: ". Estados::findOne($model->estado)->nombre;
}

if (!empty($model->trabajador)){
	$filtro .= ' and pe1.trabajadoracargo_id = '.$model->trabajador; 
	$filtrogrande = ($filtrogrande=="")?" where pe1.trabajadoracargo_id = $model->trabajador ":" and pe1.trabajadoracargo_id = $model->trabajador ";
	$titulo .= " - Trabajador: ".Trabajador::findOne($model->trabajador)->Trabajadorfps;
}
?>






</div>
<div class="row container-fluid" style="font-size: 1em;" >
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header">
				<h3 style="padding-top: 0; margin-top: 0; "> Reporte por Actividad <?= $titulo ?> </h3>
			</div>
<div class="box-body">
	<div class="row">
		<div class="col-xs-12">
			<div>
				<table class="table table-bordered table-hover table-striped table-condensed">
				<thead>
				    <tr>
				        <th <?= $stylecabecera ?> width="300" nowrap>Actividad y/o Evento</th>
				        <th <?= $stylecabecera ?>>Casos</th>
				        <th <?= $stylecabecera ?>>Casos Resue</th>
				        <th <?= $stylecabecera ?> width="150" nowrap>Monto Resuelto<br><small>(Bs.)</small></th>
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
				        <th <?= $stylecabecera ?> width="150" nowrap>Monto Económico<br><small>(Bs.)</small></th>
				        <th <?= $stylecabecera ?>>P/APR Sal</th>
				        <th <?= $stylecabecera ?> width="150" nowrap>Monto Salud<br><small>(Bs.)</small></th>
				    </tr>
				</thead>
				<tbody>
					<?php foreach ($actividadessql as $actividad): ?>
						<tr>
							    <td style="font-size: 0.9em;"><?= Html::a($actividad->descripcion, ['site/tablaactividad', 'actividad' => $actividad->id], ['target'=>'_blank']) ?></td>
								<td style="text-align:center; vertical-align:middle;" class="info"><p  style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin." where pe1.id = $actividad->id " )->queryscalar();?></p></td>
								<td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 2 and e2.id <> 15 and pe1.id = $actividad->id ")->queryscalar();?></p></td>
								<td style="text-align:right; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->formatter->asDecimal(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where  e1.id = 2 and pe1.id = $actividad->id  ")->queryscalar(),2);?></p></td>
								<td style="text-align:center; vertical-align:middle;" class="info"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 2 and e2.id = 15 and pe1.id = $actividad->id")->queryscalar();?></p></td>
								<td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 4 and pe1.id = $actividad->id ")->queryscalar();?></p></td>
								<td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 3 and pe1.id = $actividad->id ")->queryscalar();?></p></td>
								<td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 1 and pe1.id = $actividad->id ")->queryscalar();?></p></td>
								<td style="text-align:center; vertical-align:middle;" class="info"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 14 and pe1.id = $actividad->id ")->queryscalar();?></p></td>
								<td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 9 and pe1.id = $actividad->id ")->queryscalar();?></p></td>
								<td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 1 and pe1.id = $actividad->id ")->queryscalar();?></p></td>
								<td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 2 and pe1.id = $actividad->id ")->queryscalar();?></p></td>
								<td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 7 and pe1.id = $actividad->id ")->queryscalar();?></p></td>
				                <td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 3 and pe1.id = $actividad->id ")->queryscalar();?></p></td>
								<td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e3.id = 11 and pe1.id = $actividad->id " )->queryscalar();?></p></td>
								<td style="text-align:right; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->formatter->asDecimal(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where  e3.id = 11 and pe1.id = $actividad->id ")->queryscalar(),2);?></p></td>
								<td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e3.id = 10 and pe1.id = $actividad->id ")->queryscalar();?></p></td>
								<td style="text-align:right; vertical-align:middle;"><p style="margin: 0; "><?= Yii::$app->formatter->asDecimal(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where  e3.id = 10 and pe1.id = $actividad->id ")->queryscalar(),2);?></p></td>
						</tr>
					<?php endforeach; ?>
				    	<tr>
				                <td style="vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger">Total</td>
								<td style=<?= $styleceldas?> class="danger totaltabla"><p  style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin. " $filtrogrande ")->queryscalar();?></p></td>
								<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 2 and e2.id <> 15 $filtro")->queryscalar();?></p></td>
								<td style="text-align:right; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->formatter->asDecimal(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where  e3.id = 11 $filtro ")->queryscalar(),2);?></p></td>
								<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 2 and e2.id = 15 $filtro ")->queryscalar();?></p></td>
								<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 4 $filtro ")->queryscalar();?></p></td>
								<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 3 $filtro ")->queryscalar();?></p></td>
								<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 1 $filtro ")->queryscalar();?></p></td>
								<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 14  $filtro ")->queryscalar();?></p></td>
								<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 9  $filtro ")->queryscalar();?></p></td>
								<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 1 $filtro ")->queryscalar();?></p></td>
								<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 2 $filtro ")->queryscalar();?></p></td>
								<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 7 $filtro ")->queryscalar();?></p></td>
				                <td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 3 $filtro ")->queryscalar();?></p></td>
								<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e3.id = 11 $filtro ")->queryscalar();?></p></td>
								<td style="text-align:right; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->formatter->asDecimal(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where  e3.id = 11 $filtro ")->queryscalar(),2);?></p></td>
								<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e3.id = 10 $filtro ")->queryscalar();?></p></td>
				                <td style="text-align:right; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->formatter->asDecimal(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where  e3.id = 10 $filtro ")->queryscalar(),2);?></p></td>
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