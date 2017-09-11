<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'Reporte General';
$this->params['breadcrumbs'][] = 'Reportes';
$this->params['breadcrumbs'][] = $this->title;
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre","Total");


?>
<div class="row" style="font-size: 1em;" >
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header">
				<h3>
					Año 2017
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
                                                                            <th style="vertical-align:middle; font-weight: bold; font-size: 1.2em; background-color: #585858; color: white;">Mes</th>
										<th style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;">Casos</th>
                                                                                <th style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;">Casos Resue</th>
										<th style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;">Casos Artic</th>
										<th style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;">Casos Anula</th>
										<th style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;">Casos Pendi</th>
										<th style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;">Sin Comun</th>
										<th style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;">Por Llama</th>
                                                                                <th style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;">Por Recau</th>
                                                                                <th style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;">Por Conve</th>
                                                                                <th style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;">Por Conso</th>
										<th style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;">P/APR Eco</th>
										<th style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" width="200" nowrap>Monto Económico</th>
										<th style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;">P/APR Sal</th>
										<th style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" width="200" nowrap>Monto Salud</th>
									</tr>
								</thead>

								<tbody>
									<?php for ($i = 0; $i < 12; $i ++) : ?>
										<tr>
											<td><?= $meses[$i];?></td>
												<td style="text-align:center" class="info"><p  style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id where extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = 2017")->queryscalar();?></p></td>
												<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id where e1.nombre = 'Resuelto' and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = 2017")->queryscalar();?></p></td>
												<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id where e1.nombre = 'Articulado' and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = 2017")->queryscalar();?></p></td>
												<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id where e1.nombre = 'Anulado' and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = 2017")->queryscalar();?></p></td>
												<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id where e1.nombre = 'Pendiente' and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = 2017")->queryscalar();?></p></td>
												<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id where e2.nombre = 'Sin Comunicación' and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = 2017")->queryscalar();?></p></td>
												<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id where e2.nombre = 'Por Llamar' and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = 2017")->queryscalar();?></p></td>
												<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id where e2.nombre = 'Por Recaudos' and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = 2017")->queryscalar();?></p></td>
												<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id where e2.nombre = 'Por Convenio' and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = 2017")->queryscalar();?></p></td>
                                                                                                <td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id where e2.nombre = 'Por Consulta' and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = 2017")->queryscalar();?></p></td>
												<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id where e3.nombre = 'Ecónomico' and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = 2017")->queryscalar();?></p></td>
												<td style="text-align:right"><p style="margin: 0;"><?= Yii::$app->formatter->asCurrency(Yii::$app->db->createCommand("select sum(p1.montoapr) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id join presupuestos p1 on p1.solicitud_id = s1.id where e3.nombre = 'Ecónomico' and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = 2017")->queryscalar());?></p></td>
												<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id where e3.nombre = 'Salud' and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = 2017")->queryscalar();?></p></td>
												<td style="text-align:right"><p style="margin: 0;"><?= Yii::$app->formatter->asCurrency(Yii::$app->db->createCommand("select sum(p1.montoapr) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id join presupuestos p1 on p1.solicitud_id = s1.id where e3.nombre = 'Salud' and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = 2017")->queryscalar());?></p></td>
										</tr>
									<?php endfor; ?>
                                                                                <tr>
                                                                                    <td style="vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger">Total</td>
												<td style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1.1em; background-color: #585858; color: white;" class="danger totaltabla"><p  style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id where extract(year from s1.created_at) = 2017")->queryscalar();?></p></td>
												<td style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1.1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id where e1.nombre = 'Resuelto' and extract(year from s1.created_at) = 2017")->queryscalar();?></p></td>
												<td style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1.1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id where e1.nombre = 'Articulado' and extract(year from s1.created_at) = 2017")->queryscalar();?></p></td>
												<td style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1.1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id where e1.nombre = 'Anulado' and extract(year from s1.created_at) = 2017")->queryscalar();?></p></td>
												<td style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1.1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id where e1.nombre = 'Pendiente' and extract(year from s1.created_at) = 2017")->queryscalar();?></p></td>
												<td style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1.1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id where e2.nombre = 'Sin Comunicación' and extract(year from s1.created_at) = 2017")->queryscalar();?></p></td>
												<td style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1.1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id where e2.nombre = 'Por Llamar' and extract(year from s1.created_at) = 2017")->queryscalar();?></p></td>
												<td style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1.1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id where e2.nombre = 'Por Recaudos' and extract(year from s1.created_at) = 2017")->queryscalar();?></p></td>
												<td style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1.1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id where e2.nombre = 'Por Convenio' and extract(year from s1.created_at) = 2017")->queryscalar();?></p></td>
                                                                                                <td style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1.1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id where e2.nombre = 'Por Consulta' and extract(year from s1.created_at) = 2017")->queryscalar();?></p></td>
												<td style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1.1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id where e3.nombre = 'Ecónomico' and extract(year from s1.created_at) = 2017")->queryscalar();?></p></td>
												<td style="text-align:right; vertical-align:middle; font-weight: bold; font-size: 1.1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->formatter->asCurrency(Yii::$app->db->createCommand("select sum(p1.montoapr) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id join presupuestos p1 on p1.solicitud_id = s1.id where e3.nombre = 'Ecónomico' and extract(year from s1.created_at) = 2017")->queryscalar());?></p></td>
												<td style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1.1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id where e3.nombre = 'Salud' and extract(year from s1.created_at) = 2017")->queryscalar();?></p></td>
                                                                                                <td style="text-align:right; vertical-align:middle; font-weight: bold; font-size: 1.1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->formatter->asCurrency(Yii::$app->db->createCommand("select sum(p1.montoapr) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id join presupuestos p1 on p1.solicitud_id = s1.id where e3.nombre = 'Salud' and extract(year from s1.created_at) = 2017")->queryscalar());?></p></td>
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
