<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Programaevento;
use app\models\Trabajador;
use app\models\Estados;
use app\models\Parroquias;
use app\models\Municipios;


/* @var $this yii\web\View */

$this->title = "Reporte General";

$stylecabecera = 'style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;"';

$styleceldas = '"text-align:center; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;"';

$tablasconjoin = ' gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id '
			    .' join estatus2 e2 on e3.estatus2_id = e2.id '
				.' join estatus1 e1 on e2.estatus1_id = e1.id '
				.' join programaevento pe1 on pe1.id = g1.programaevento_id '
				.' join referencia r1 on r1.id = pe1.referencia_id '
				.' join solicitudes s1 on s1.id = g1.solicitud_id ';

$tablasconjoinpresupuesto = ' gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id '
						   	.' join estatus2 e2 on e3.estatus2_id = e2.id '
						   	.' join estatus1 e1 on e2.estatus1_id = e1.id '
						   	.' join solicitudes s1 on s1.id = g1.solicitud_id '
							.' join programaevento pe1 on pe1.id = g1.programaevento_id '
							.' join referencia r1 on r1.id = pe1.referencia_id '
						   	.' join presupuestos p1 on p1.solicitud_id = s1.id ';

$filtroano = ' extract(year from pe1.fechaprograma) = '. $model->ano.' and ';
$filtromes = 'extract(month from pe1.fechaprograma) = '. $model->mes.' and ';
$filtroorigen = 'extract(month from pe1.fechaprograma) = '. $model->mes.' and ';
$filtropersonalidad = 'extract(month from pe1.fechaprograma) = '. $model->mes.' and ';
$filtrocargo = 'extract(month from pe1.fechaprograma) = '. $model->mes.' and ';
$filtroestado = 'extract(month from pe1.fechaprograma) = '. $model->mes.' and ';
$filtroteniente = 'extract(month from pe1.fechaprograma) = '. $model->mes.' and ';

$filtro = "";

if (!empty($model->ano)){
	$filtro = " where ".$filtroano;
}
//Me traigo todas las actividades
$actividades= Yii::$app->db->createCommand("select pe1.id, pe1.descripcion from programaevento pe1 "
                    ." join referencia r1 on r1.id = pe1.referencia_id "
                    .' join gestion g1 on pe1.id = g1.programaevento_id '
                    . $filtro
                    ."group by pe1.id, pe1.descripcion order by pe1.id")->queryAll();

//Convierto todos las actividades en un array pd. se que hay otra forma pero no me acuerdo Tiene que ver con el asArray()
foreach ($actividades as $val) {

    $actividad[]=$val['id'];
    $descripcionactividad[]=$val['descripcion'];

}

?>
</div>
<div class="row container-fluid" style="font-size: 1em;" >
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header">
				Reporte por Actividad
			</div>
<div class="box-body">
	<div class="row">
		<div class="col-xs-12">
			<div>
				<table class="table table-bordered table-hover table-striped table-condensed">
				<thead>
				    <tr>
				        <th <?= $stylecabecera ?> width="250" nowrap>Actividad y/o Evento</th>
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
					<?php for ($i = 0; $i < count($actividad); $i ++) : ?>
						<tr>
							    <td><?= $descripcionactividad[$i];?></td>
								<td style="text-align:center" class="info"><p  style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin )->queryscalar();?></p></td>
								<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 2 and e2.id <> 15 ")->queryscalar();?></p></td>
								<td style="text-align:right"><p style="margin: 0;"><?= Yii::$app->formatter->asDecimal(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where  e3.id = 11  ")->queryscalar(),2);?></p></td>
								<td style="text-align:center" class="info"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 2 and e2.id = 15")->queryscalar();?></p></td>
								<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 4  ")->queryscalar();?></p></td>
								<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 3  ")->queryscalar();?></p></td>
								<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 1  ")->queryscalar();?></p></td>
								<td style="text-align:center" class="info"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 14")->queryscalar();?></p></td>
								<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 9  ")->queryscalar();?></p></td>
								<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 1  ")->queryscalar();?></p></td>
								<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 2  ")->queryscalar();?></p></td>
								<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 7  ")->queryscalar();?></p></td>
				                <td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 3  ")->queryscalar();?></p></td>
								<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e3.id = 11 " )->queryscalar();?></p></td>
								<td style="text-align:right"><p style="margin: 0;"><?= Yii::$app->formatter->asDecimal(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where  e3.id = 11  ")->queryscalar(),2);?></p></td>
								<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e3.id = 10  ")->queryscalar();?></p></td>
								<td style="text-align:right"><p style="margin: 0;"><?= Yii::$app->formatter->asDecimal(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where  e3.id = 10  ")->queryscalar(),2);?></p></td>
						</tr>
					<?php endfor; ?>
				    	<tr>
				                <td style="vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger">Total</td>
								<td style=<?= $styleceldas?> class="danger totaltabla"><p  style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin)->queryscalar();?></p></td>
								<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 2 and e2.id <> 15 ")->queryscalar();?></p></td>
								<td style="text-align:right; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->formatter->asCurrency(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where  e3.id = 11 ")->queryscalar());?></p></td>
								<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 2 and e2.id = 15 ")->queryscalar();?></p></td>
								<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 4 ")->queryscalar();?></p></td>
								<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 3 ")->queryscalar();?></p></td>
								<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 1 ")->queryscalar();?></p></td>
								<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 14 ")->queryscalar();?></p></td>
								<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 9  ")->queryscalar();?></p></td>
								<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 1 ")->queryscalar();?></p></td>
								<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 2 ")->queryscalar();?></p></td>
								<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 7 ")->queryscalar();?></p></td>
				                <td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 3 ")->queryscalar();?></p></td>
								<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e3.id = 11 ")->queryscalar();?></p></td>
								<td style="text-align:right; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->formatter->asCurrency(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where  e3.id = 11 ")->queryscalar());?></p></td>
								<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e3.id = 10 ")->queryscalar();?></p></td>
				                <td style="text-align:right; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->formatter->asCurrency(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where  e3.id = 10  ")->queryscalar());?></p></td>
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