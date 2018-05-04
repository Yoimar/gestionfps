<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//Me traigo todos los trabajadores
$trabajadorescolumnas= Yii::$app->db->createCommand("select u1.nombre from solicitudes s1 "
                    ."full outer join users u1 on s1.usuario_asignacion_id = u1.id "
                    ."where extract(year from s1.created_at) = ". $model->ano
                    ."group by u1.nombre order by u1.nombre")->queryAll();
//Convierto todos los trabajadores en un array pd. se que hay otra forma pero no me acuerdo Tiene que ver con el asArray()
foreach ($trabajadorescolumnas as $val) {
    if ($val['nombre']==null){
        $trabajadores[]=null;
    }else{
        $trabajadores[]=$val['nombre'];
    }
 }

$stylecabecera = '"text-align:center; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;"';

$tablasforsql = 'gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id join solicitudes s1 on s1.id = g1.solicitud_id ';
$tablasforsqlingreso = 'solicitudes s1 ';
$sqlforgestion = ' gestion g1 join solicitudes s1 on s1.id = g1.solicitud_id full outer join users u1 on s1.usuario_asignacion_id = u1.id join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id ';
$sqlforingreso = ' solicitudes s1 full outer join users u1 on s1.usuario_asignacion_id = u1.id ';

?>
<div class="row" style="font-size: 1em;" >
	<div class="col-lg-12">
		<div class="box">
<div class="box-header">
	<h3>
		Parte de Casos Por Trabajador - Año  <?= $model->ano ?>
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
        <th style="vertical-align:middle; font-weight: bold; font-size: 1.2em; background-color: #585858; color: white;" width="200" nowrap>Trabajador</th>
		<th style=<?= $stylecabecera ?>>Ingres.</th>
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
			<td class="danger"><p  style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforingreso."  where u1.nombre ".$filtrotrabajador." and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
			<td class="info"><p  style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforgestion."  where u1.nombre ".$filtrotrabajador." and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
			<td><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforgestion."  where u1.nombre ".$filtrotrabajador." and e1.id = 2 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
			<td><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforgestion."  where u1.nombre ".$filtrotrabajador." and e1.id = 4 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
			<td><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforgestion."  where u1.nombre ".$filtrotrabajador." and e1.id = 3 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
			<td><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforgestion."  where u1.nombre ".$filtrotrabajador." and e1.id = 1 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
			<td><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforgestion."  where u1.nombre ".$filtrotrabajador." and e2.nombre = 'Sin Comunicación' and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
			<td><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforgestion."  where u1.nombre ".$filtrotrabajador." and e2.nombre = 'Por Llamar' and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
			<td><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforgestion."  where u1.nombre ".$filtrotrabajador." and e2.nombre = 'Por Recaudos' and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
			<td><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforgestion."  where u1.nombre ".$filtrotrabajador." and e2.nombre = 'Por Convenio' and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
            <td><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforgestion."  where u1.nombre ".$filtrotrabajador." and e2.nombre = 'Por Consulta' and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
			<td><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforgestion."  where u1.nombre ".$filtrotrabajador." and e3.nombre = 'Ecónomico' and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
			<td><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforgestion."  where u1.nombre ".$filtrotrabajador." and e3.nombre = 'Salud' and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
			<td><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$sqlforgestion."  where u1.nombre ".$filtrotrabajador." and e2.nombre = 'EN ADMINISTRACIÓN' and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>

	</tr>
<?php endfor; ?>
    <tr style="text-align:center; vertical-align:middle; font-weight: bold; background-color: #585858; color: white;">
            <td style="text-align:left; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger">Total</td>
			<td style="font-size: 1em; background-color: #585858; color: white;" class="danger totaltabla"><p  style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$tablasforsqlingreso." where extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
			<td style="font-size: 1em; background-color: #585858; color: white;" class="danger totaltabla"><p  style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$tablasforsql." where extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
			<td style="font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$tablasforsql."  where e1.id = 2 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
			<td style="font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$tablasforsql."  where e1.id = 4 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
			<td style="font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$tablasforsql."  where e1.id = 3 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
			<td style="font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$tablasforsql."  where e1.id = 1 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
			<td style="font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$tablasforsql."  where e2.id = 9 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
			<td style="font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$tablasforsql."  where e2.id = 1 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
			<td style="font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$tablasforsql."  where e2.id = 2 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
			<td style="font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$tablasforsql."  where e2.id = 7 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
            <td style="font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$tablasforsql."  where e2.id = 3 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
			<td style="font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$tablasforsql."  where e3.id = 11 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
			<td style="font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$tablasforsql."  where e3.id = 10 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
			<td style="font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from  ".$tablasforsql."  where e2.id = 18 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>

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
